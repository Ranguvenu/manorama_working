<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\Colleges\CreateRequest as CreateCollegeRequest;
use App\Http\Requests\MasterData\Colleges\UpdateRequest as UpdateCollegeRequest;
use App\Http\Resources\MasterData\CollegeResource;
use App\Models\MasterData\College;
use App\Models\MasterData\CollegeFacilities;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CollegesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-college'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-college'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-college'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-college'])->only('destroy');
    }

    public function index(Request $request)
    {
        return Inertia::render('MasterData/Colleges/index');
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $colleges = College::filterBy($request->all())->paginate(10);

        return CollegeResource::collection($colleges);
    }

    public function create()
    {
        $facilites = CollegeFacilities::available_facilities();

        return response()->json([
            'facilities' => $facilites,
        ], 200);
    }

    public function store(CreateCollegeRequest $request)
    {
        try {
            $create = College::create($request->validated());
            if ($create) {
                foreach ($request->get('facilities') as $key => $value) {
                    $create->facilities()->create($value);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'College Created Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function edit(College $college)
    {
        return response()->json([
            'data' => $college,
            'facilities' => $college->facilities,
        ], 200);
    }

    public function update(College $college, UpdateCollegeRequest $request)
    {
        try {
            $update = $college->update($request->validated());
            if ($update) {
                foreach ($request->get('facilities') as $key => $value) {
                    $college->facilities()->updateOrCreate([
                        'id' => $value['id'],
                    ], $value);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'College Updated Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(College $college)
    {
        return response()->json([
            'success' => true,
            'data' => new CollegeResource($college),
        ], 200);
    }

    public function destroy(College $college)
    {
        try {
            $delete = $college->delete();

            return response()->json([
             'success' => true,
             'message' => 'Deleted College Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
