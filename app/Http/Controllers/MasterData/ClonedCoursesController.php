<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Resources\MasterData\ClonedCoursesResource;
use App\Models\MasterData\Hierarchy;
use App\Models\Ecommerce\Batches;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClonedCoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-cloned-course'])->only('index', 'results');
    }

    public function index(Request $request)
    {
        $goals = Hierarchy::onlyGoals()->get();
        $data = [
            'goals' => $goals,
            'boards' => [],
            'classes' => [],
            'subjects' => [],
        ];

        return Inertia::render('MasterData/ClonedCourses/index', [
            'data' => $data,
        ]);
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $courses = Batches::whereHas('course')->latest()->filterBy($request->all())->paginate($perpage);

        return ClonedCoursesResource::collection($courses);
    }
}
