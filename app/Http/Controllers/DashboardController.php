<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Customer;
use App\Models\Deal;
use App\Models\PipelineStage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // 每个客户的商机数量
        $dealsPerCustomer = Customer::withCount('deals')
            ->orderBy('deals_count', 'desc')
            ->get();

        // 转化为前端可用数组
        $labels = $dealsPerCustomer->pluck('name');  // 客户名称
        $data = $dealsPerCustomer->pluck('deals_count'); // 商机数量
        // 客户总数
        $totalCustomers = Customer::count();

        // 每个行业客户数
        $customersByIndustry = Customer::select('industry', DB::raw('count(*) as total'))
            ->groupBy('industry')
            ->pluck('total', 'industry');

        // 商机总数
        $totalDeals = Deal::count();

        // 商机总金额
        $totalAmount = Deal::sum('amount');

        // 商机阶段分布
        $dealsByStage = PipelineStage::withCount('deals')->get()->pluck('deals_count', 'name');

        // 每个负责人商机数量
        $dealsByOwner = User::withCount('deals')->get()->pluck('deals_count', 'name');

        // 活动类型分布
        $activitiesByType = Activity::select('type', DB::raw('count(*) as total'))
            ->groupBy('type')
            ->pluck('total', 'type');

        return view('dashboard', compact(
            'totalCustomers', 'customersByIndustry',
            'totalDeals', 'totalAmount', 'dealsByStage',
            'dealsByOwner', 'activitiesByType',
            'labels', 'data'
        ));
    }
}
