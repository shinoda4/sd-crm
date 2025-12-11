<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Deal;
use App\Models\PipelineStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $deals = Deal::with(['customer', 'stage', 'owner'])
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('stage', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('owner', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('deals.index', compact('deals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'customer_id' => 'required|exists:customers,id',
            'pipeline_stage_id' => 'required|exists:pipeline_stages,id',
            'amount' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        $validated['owner_id'] = auth()->id();

        $deal = Deal::create($validated);
        // 记录活动
        $deal->activities()->create([
            'user_id' => auth()->id(),
            'type' => 'create',
            'content' => '创建商机',
        ]);

        return redirect()->route('deals.show', $deal)
            ->with('success', '商机已创建');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $customers = Customer::orderBy('name', direction: "asc")->get();
        $stages = PipelineStage::orderBy('order', direction: "asc")->get();

        // 若从某客户页面发起，例如 /deals/create?customer_id=1
        $customerId = $request->customer_id ?? null;

        return view('deals.create', [
            'customers' => $customers, 'stages' => $stages, 'customerId' => $customerId
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Deal $deal)
    {
        $deal->load(['customer', 'stage', 'owner', 'activities.user']);

        return view('deals.show', compact('deal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deal $deal)
    {
        $deal->load(['customer', 'stage']);
        $customers = Customer::orderBy('name', direction: "asc")->get();
        $stages = PipelineStage::orderBy('order', direction: "asc")->get();

        Log::debug($deal);

        return view('deals.edit', compact('deal', 'customers', 'stages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deal $deal)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'customer_id' => 'required|exists:customers,id',
            'pipeline_stage_id' => 'required|exists:pipeline_stages,id',
            'amount' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        $deal->update($validated);

        // 活动日志
        $deal->activities()->create([
            'user_id' => auth()->id(),
            'type' => 'update',
            'content' => '更新商机信息',
        ]);

        return redirect()->route('deals.show', $deal)
            ->with('success', '商机已更新');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal)
    {
        $deal->delete();

        return redirect()->route('deals.index')
            ->with('success', '商机已删除');
    }

    /**
     * 用于 Kanban 拖拽更新 stage
     */
    public function updateStage(Request $request, Deal $deal)
    {
        $validated = $request->validate([
            'pipeline_stage_id' => 'required|exists:pipeline_stages,id',
        ]);

        $deal->pipeline_stage_id = $validated['pipeline_stage_id'];
        $deal->save();

        // 活动
        $deal->activities()->create([
            'user_id' => auth()->id(),
            'type' => 'update-stage',
            'content' => '移动到阶段：' . $deal->stage->name,
        ]);

        return response()->json(['success' => true]);
    }

    public function indexByCustomer(Customer $customer, Request $request)
    {
        $search = $request->input('search');
        $searchLower = strtolower($search);

        $deals = $customer->deals()
            ->with(['customer', 'owner', 'stage'])
            ->when($search, function($query) use ($search, $searchLower) {
                $query->where(function ($q) use ($search, $searchLower) {

                    // title 使用 LOWER
                    $q->whereRaw('LOWER(title) LIKE ?', ["%{$searchLower}%"]);

                    // amount 数字不用 LOWER，直接匹配
                    if (is_numeric($search)) {
                        $q->orWhere('amount', $search);
                    }
//                    else {
//                         如果你想模糊匹配数字，也可以 cast
//                        $q->orWhereRaw('CAST(amount AS TEXT) LIKE ?', ["%{$search}%"]);
//                    }

                    // customer.name
                    $q->orWhereHas('customer', function ($q) use ($searchLower) {
                        $q->whereRaw('LOWER(name) LIKE ?', ["%{$searchLower}%"]);
                    });

                    // owner.name
                    $q->orWhereHas('owner', function ($q) use ($searchLower) {
                        $q->whereRaw('LOWER(name) LIKE ?', ["%{$searchLower}%"]);
                    });

                    $q->orWhereHas('stage', function ($q) use ($searchLower) {
                        $q->whereRaw('LOWER(name) like ?', ["%{$searchLower}%"]);
                    });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('deals.index_by_customer', compact('customer', 'deals'));
    }


}
