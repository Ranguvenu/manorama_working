<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Resources\MasterData\CourseResource;
use App\Models\MasterData\Hierarchy;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $goals = Hierarchy::onlyGoals()->get();
        $data = [
            'goals' => $goals,
            'boards' => [],
            'classes' => [],
            'subjects' => [],
        ];

        return Inertia::render('MasterData/Courses/index', [
            'data' => $data,
        ]);
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $courses = Hierarchy::onlyCourses()->latest()->filterBy($request->all())->paginate($perpage);

        return CourseResource::collection($courses);
    }
}
