<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\Batch\CreateRequest as CreateBatchRequest;
use App\Http\Requests\Ecommerce\Batch\UpdateRequest as UpdateBatchRequest;
use App\Http\Resources\Ecommerce\BatchEnrollmentsResource;
use App\Http\Resources\Ecommerce\BatchResource;
use App\Models\Ecommerce\Batches;
use App\Models\Ecommerce\Packages;
use App\Models\MasterData\Taxonomy;
use App\Services\Moodle\Package as PackageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    public $service;

    public function __construct()
    {
        $this->service = new PackageService();
    }

    public function index(Packages $package)
    {
        $batches = $package->batches()->latest()->paginate(10);

        return BatchResource::collection($batches);
    }

    public function create(Packages $package)
    {
        $taxonomy = Taxonomy::find('batch_provider');

        $courses = $package->courses->map(function ($course) {
            return $course->course;
        });

        return response()->json([
            'showcourses' => $courses->count(),
            'courses' => $courses,
            'providers' => $taxonomy->categories,
        ], 200);
    }

    public function store(Packages $package, CreateBatchRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            if ($package->package_type == 1) {
                $course = $package->courses()->first();
                if ($course && $course->course && $course->course->id) {
                    $data['hierarchy_id'] = $course->course->id;
                }
            }
            $batch = $package->batches()->create($data);
            $clonedcourse = $this->service->create_batch($batch);
            if ($clonedcourse) {
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Created Batch',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create batch in lms please contact your administrator',
                    'data' => $clonedcourse,
                ], 200);
            }
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'errors' => $e,
                'success' => false,
                'message' => 'Failed to create',
            ], 422);
        }
    }

    public function edit(Batches $batch)
    {
        return $batch;
    }

    public function update(Batches $batch, UpdateBatchRequest $request)
    {
        try {
            $package = $batch->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Batch Updated successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update Batch',
            ], 200);
        }
    }

    public function destroy(Batches $batch)
    {
        try {
            if ($batch->enrollments()->count()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete batch as there are some enrolments associated with it',
                ], 200);
            }
            $this->service->destroy_package($batch->code, 'batch');
 		$batch->course()->delete();            
		$delete = $batch->delete();
           

            return response()->json([
                'success' => true,
                'message' => 'Batch deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Batch',
            ], 422);
        }
    }

    public function enrollments(Batches $batch, Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $enrollments = $batch->enrollments()->paginate($perpage);

        return BatchEnrollmentsResource::collection($enrollments);
    }
}
