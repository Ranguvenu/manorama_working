<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Resources\Ecommerce\EnrollmentsResource;
use App\Models\Content\Enrollment;
use App\Models\Ecommerce\Packages;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EnrollmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-enrollments'])->only('index', 'results');
    }

    public function index(Request $request)
    {
        $packages = Packages::all();
        $enrollment = new Enrollment;

        return Inertia::render('Ecommerce/Enrollments/index',
            
        [      'data'=>[
                    'packages' => $packages,
                    'type'  => $enrollment->enrollmenttypes()
                ],
           
            ]
        );
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $orders = Enrollment::filterBy($request->all())->latest()->paginate($perpage);

        return EnrollmentsResource::collection($orders);
    }
}
