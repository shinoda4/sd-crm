<?php
/*
 * Copyright (c) 2025 Shunde
 * All rights reserved.
 *
 * This source code is strictly confidential and proprietary.
 * The content of this file may not be disclosed to third parties, copied or
 * duplicated in any form, in whole or in part, without the prior written
 * permission of Shunde.
 *
 * Use of this source code is governed by the terms of the license agreement
 * contained in the LICENSE file found in the root directory of this source tree.
 * If no LICENSE file is found, use is strictly prohibited.
 */

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $customers = Customer::withCount('deals')
            ->when(auth()->user()->cannot('viewAny', Customer::class), function ($q) {
                $q->where('owner_id', auth()->id());
            })
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString(); // 保持搜索参数在分页中

        return view('customers.index', compact('customers', 'search'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
        Log::debug("Store Customer");
        $data = $request->validated();
        $data['owner_id'] = auth()->id();
        $customer = Customer::create($data);

        $customer->activities()->create([
            'user_id' => auth()->id(),
            'type' => 'create',
            'content' => '创建客户'
        ]);

        return redirect()->route('customers.show', $customer)->with('success', '客户已创建');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $customer->load(['contacts', 'deals', 'activities.user']);
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        $customer->activities()->create([
            'user_id' => auth()->id(),
            'type' => 'update',
            'content' => '更新客户信息'
        ]);
        return redirect()->route('customers.show', $customer)->with('success', '已更新');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
        $customer->delete();
        return redirect()->route('customers.index')->with('success', '已删除');
    }


}
