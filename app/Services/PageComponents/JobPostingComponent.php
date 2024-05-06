<?php

namespace App\Services\PageComponents;

use App\Http\Resources\Services\PageComponents\JobPostingsResource;
use App\Models\Careers\JobPosting;
use App\Models\MasterData\Taxonomy;
use Illuminate\Http\Request;

class JobPostingComponent
{
    public function index(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $postings = JobPosting::active()->filterBy($request->all())->paginate($perpage);

        return JobPostingsResource::collection($postings);
    }

    public function create(Request $request)
    {
        $taxonomy = Taxonomy::findOrFail('job_category');

        return response()->json([
            'categories' => $taxonomy->categories,
        ], 200);
    }
}
