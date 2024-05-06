<?php

namespace App\Http\Controllers;

use App\Models\Ecommerce\Coupons;
use App\Models\Ecommerce\Packages;
use App\Models\MasterData\Hierarchy;
use App\Models\User;
use App\Models\Website\PageBuilder\Page;
use Illuminate\Http\Request;

class AutoCompleteController extends Controller
{
    public function users(Request $request)
    {
        $users = User::filterBy($request->all())->select('email', 'id');

        if ($request->get('roles')) {
            $users = $users->role($request->get('roles'));
        }
        $users = $users->limit(5)->get();

        return $users;
    }

    public function packages(Request $request)
    {
        $users = Packages::filterBy($request->all())->select('title', 'id')->limit(5)->get();

        return $users;
    }

    public function package_pricing(Packages $package, Request $request)
    {
        return $package->pricing()->limit(5)->get();
    }

    public function package_batches(Packages $package, Request $request)
    {
        return $package->activeBatches();
    }

    public function package_courses(Packages $package, Request $request)
    {
        return $package->courses->map(function ($course) {
            return [
                'id' => $course->course->id,
                'name' => $course->course->title,
            ];
        });
    }

    public function goals(Request $request)
    {
        $goals = Hierarchy::filterBy($request->all())->onlyGoals()->get();

        return $goals;
    }

    public function pages(Request $request)
    {
        $pages = Page::filterBy($request->all())->select('title', 'id', 'slug')->limit(5)->get();

        return $pages;
    }

    public function coupons(Request $request)
    {
        $coupons = Coupons::active()->filterBy($request->all())->select('id', 'code')->limit(5)->get();

        return $coupons;
    }
}
