<?php

namespace App\Http\Controllers;

use App\Http\Resources\Ecommerce\OrdersResource;
use App\Models\Content\DownloadableResource;
use App\Models\Content\Enrollment;
use App\Models\Ecommerce\Batches;
use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\Packages;
use App\Models\MasterData\Category;
use App\Models\MasterData\Taxonomy;
use App\Models\User;

class ReportsController extends Controller
{
    public function registrations()
    {
        $category = Category::where('taxonomy_slug', 'user_type')->where('slug', 'subscribers')->first();
        $users = $category->users();
        $userid = $users->get('id');
        $active_users = User::whereHas('orders', function ($query) use ($userid) {
            $query->whereIn('user_id', $userid);
        })->get();

        return [
            'active' => $active_users->count(),
            'total' => $users->count(),
        ];
    }

    public function batches()
    {
        $batches = new Batches();

        return [
            'total' => $batches->count(),
            'active' => $batches->active()->count(),
        ];
    }

    public function packages()
    {
        $packages = new Packages();

        return [
            'total' => $packages->count(),
            'active' => $packages->active()->count(),
        ];
    }

    public function enrolments()
    {
        $enrolments = new Enrollment();

        return [
            'total' => $enrolments->whereHas('order', function ($query) {
                $query->where('status', '>', 0);
            })->where('status', 1)->count(),
            'active' => $enrolments->whereHas('order', function ($query) {
                $query->where('status', '>', 0);
            })->where('status', 1)->whereDate('end_date', '>', today())->count(),
        ];
    }

    public function articles()
    {
        $taxonomy = Taxonomy::findOrFail('blog_type');
        $articles = $taxonomy->categories()->where('slug', 'article')->first();

        return [
            'total' => $articles->articles()->count(),
            'active' => $articles->articles()->active()->count(),
        ];
    }

    public function currentaffairs()
    {
        $taxonomy = Taxonomy::findOrFail('blog_type');
        $currentaffairs = $taxonomy->categories()->where('slug', 'current-affair')->first();

        return [
            'total' => $currentaffairs->articles()->count(),
            'active' => $currentaffairs->articles()->active()->count(),
        ];
    }

    public function resources()
    {
        $taxonomy = Taxonomy::findOrFail('blog_type');
        $resources = new DownloadableResource();

        return [
            'total' => $resources->count(),
            'active' => $resources->active()->count(),
        ];
    }

    public function orderscount()
    {
        $orders = new Order();

        return [
            'total' => $orders->count(),
            'completed' => $orders->where('status', 3)->count(),
        ];
    }

    public function orders()
    {
        $orders = Order::latest()->limit(10)->get();

        return OrdersResource::collection($orders);
    }
}
