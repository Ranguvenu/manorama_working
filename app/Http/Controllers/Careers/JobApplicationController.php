<?php

namespace App\Http\Controllers\Careers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Careers\JobApplications\CreateRequest as CreateJobApplicationRequest;
use App\Http\Requests\Careers\JobApplications\UpdateRequest as UpdateJobApplicationRequest;
use App\Http\Resources\Careers\JobApplicationResource;
use App\Models\Careers\JobApplication;
use App\Models\Careers\JobPosting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobApplicationController extends Controller
{
    public function __construct(){
        
    }
    
    public function index(JobPosting $job)
    {
        return Inertia::render('Careers/JobApplications/index', ['data' => $job]);
    }

    public function results(Request $request, JobPosting $job)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $applications = $job->applications()->submitted()->filterBy($request->all())->latest()->paginate($perpage);

        return JobApplicationResource::collection($applications);
    }

    public function create(JobPosting $job, Request $request)
    {
        $data = ['can_edit' => false, 'application' => [], 'submitted' => false];
        $response = $job;
        $response['assignments'] = $job->job_posting_assignments;
        $response['tags'] = $job->all_tags;

        if ($job->current_user_application_saved()) {
            $data['can_edit'] = true;
            $data['application'] = $job->current_user_application();
        }

        if ($job->current_user_application_submitted()) {
            $data['submitted'] = true;
        }
        $data['job'] = $response;

        return Inertia::render('Careers/JobApplications/create', $data);
    }

    public function store(JobPosting $job, CreateJobApplicationRequest $request)
    {
        try {
            $application = $job->applications()->create($request->validated());
            $application->assignments()->createUpdateOrDelete($request->get('assignments'));

            return redirect()->to('careers/'.$request->slug);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function edit(JobApplication $jobapplication)
    {
        return response()->json([
            'data' => $jobapplication,
        ], 200);
    }

    public function update(JobApplication $application, UpdateJobApplicationRequest $request)
    {
        try {
            $application->update($request->validated());
            $application->assignments()->createUpdateOrDelete($request->get('assignments'));

            return redirect()->to('careers/'.$request->slug);
        } catch (Exception $e) {
            return redirect()->to('careers/'.$request->slug);
        }
    }

    public function destroy(JobApplication $jobapplication)
    {
        try {
            $delete = $jobapplication->delete();

            return response()->json([
                'success' => true,
                'message' => 'Deleted job application',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
             'success' => true,
             'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(JobPosting $job, JobApplication $application)
    {
        return response()->json([
            'success' => true,
            'data' => new JobApplicationResource($application),
        ], 200);
    }

    public function update_status(JobApplication $application, $status)
    {
        try {
            $application->status = $status;
            $application->save();

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
