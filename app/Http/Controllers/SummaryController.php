<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Resources\Ecommerce\TransactionsResource;
use App\Models\Ecommerce\Coupons;
use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\Packages;
use App\Models\MasterData\Category;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function users(Category $category, Request $request)
    {
        $users = $category->users();
        $lastregistration = $users->latest()->first();

        return [
            'total' => $users->count(),
            'last_registration' => get_date($lastregistration->created_at, 'd M Y, h:i a'),
            'active' => 10,
        ];
    }

    public function leads(Category $category, Request $request)
    {
        $leads = $category->leads();
        $lastlead = $leads->latest()->first();

        return [
            'total' => $leads->count(),
            'active' => $leads->where('status', 0)->count(),
            'inprogress' => $category->leads()->where('status', '!=' , 1)->count(),
            'disqualified' => $category->leads()->where('status', 1)->count(),
            'lastlead' => get_date($lastlead->created_at, 'd M Y, h:i a'),
        ];
    }

    public function packages()
    {
        $packages = new Packages();
        $lastpackage = $packages->latest()->first();

        return [
            'total' => $packages->count(),
            'active' => $packages->where('is_published', 1)->count(),
            'totalactive' => $packages->where('is_published', 1)->whereMonth('created_at', now())->count(),
            'lastpackage' => get_date($lastpackage->created_at, 'd M Y, h:i a'),
        ];
    }

    public function coupons()
    {
        $coupons = new Coupons();
        $activecoupons = $coupons->active();
        $lastactive = $coupons->latest()->first();
        $enddate = strtotime(now()->endOfMonth());

        return [
            'total' => $activecoupons->count(),
            'totalactive' => $coupons->active()->where('valid_to', '<=', $enddate)->count(),
            'lastactive' => get_date($lastactive->created_at, 'd M Y, h:i a'),
        ];
    }

    public function transactions()
    {
        $topthree = Order::join('packages', 'orders.package_id', '=', 'packages.id')
                    ->whereExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('packages')
                            ->whereRaw('orders.package_id = packages.id');
                    })
                    ->whereMonth('orders.created_at', now())
                    ->select('orders.package_id as id', 'packages.title as title', DB::raw('COUNT(orders.package_id) as orders_count'))
                    ->where('status', 3)
                    ->groupBy('orders.package_id')
                    ->limit(3)
                    ->get();

        $packages = Order::whereMonth('created_at', now())->get();
        $totalamount = $packages->sum('order_amount');
        $totalorders = $packages->count();

        return [
            'data' => TransactionsResource::collection($topthree),
            'totalamount' => $totalamount,
            'totalorders' => $totalorders,
        ];
    }
}
