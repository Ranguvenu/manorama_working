<?php

namespace App\Http\Controllers\Careers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Careers\JobPostings\CreateRequest as CreateJobPostingRequest;
use App\Http\Requests\Careers\JobPostings\UpdateRequest as UpdateJobPostingRequest;
use App\Http\Resources\Careers\JobPostingResource;
use App\Models\Careers\JobPosting;
use App\Models\MasterData\Taxonomy;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobPostingController extends Controller
{
    public function __construct(){
        $this->middleware(['role_or_permission:view-job-postings'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-job-postings'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-job-postings'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-job-postings'])->only('destroy');
    }
    
    public function index(Request $request)
    {
        return Inertia::render('Careers/JobPostings/index');
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $jobpostings = JobPosting::filterBy($request->all())->latest()->paginate(10);

        return JobPostingResource::collection($jobpostings);
    }

    public function create()
    {
        $taxonomy = Taxonomy::findOrFail('job_category');

        return response()->json([
            'categories' => $taxonomy->categories,
        ], 200);
    }

    public function store(CreateJobPostingRequest $request)
    {
        try {
            $job = JobPosting::create($request->validated());
            $job->job_posting_assignments()->createMany($request->get('assignments'));

            return response()->json([
                'success' => true,
                'message' => 'created job',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function edit(JobPosting $job)
    {
        $response = $job;
        $response['assignments'] = $job->job_posting_assignments;

        return response()->json([
            'data' => $response,
        ], 200);
    }

    public function update(JobPosting $job, UpdateJobPostingRequest $request)
    {
        try {
            // return $request->assignments->toArray;
            $update = $job->update($request->validated());
            $job->job_posting_assignments()->createUpdateOrDelete($request->get('assignments'));

            return response()->json([
                'success' => true,
                'message' => 'Updated job',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(JobPosting $job)
    {
        try {
            $delete = $job->delete();

            return response()->json([
                'success' => true,
                'message' => 'Deleted job',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
             'success' => true,
             'message' => $e->getMessage(),
            ], 422);
        }
    }
}
