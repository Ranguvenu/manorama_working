<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\Webinars\CreateRequest as CreateWebinarRequest;
use App\Http\Requests\Content\Webinars\UpdateRequest as UpdateWebinarRequest;
use App\Http\Resources\Content\WebinarResource;
use App\Http\Resources\Content\WebinarsResource;
use App\Models\Content\Webinar;
use App\Models\MasterData\Taxonomy;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WebinarsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-webinar'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-webinar'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-webinar'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-webinar'])->only('destroy');
    }

    public function index()
    {
        return Inertia::render('Content/Webinars/index');
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $webinars = Webinar::latest()->filterBy($request->all())->paginate($perpage);

        return WebinarsResource::collection($webinars);
    }

    public function show(Webinar $webinar)
    {
        $recents = Webinar::latest()->take(4)->get();

        return Inertia::render('Content/Webinars/view', [
            'webinar' => new WebinarResource($webinar),
            'recents' => WebinarsResource::collection($recents),
        ]);
    }

    public function create()
    {
        $categories = Taxonomy::findOrFail('webinar_category');

        return response()->json([
            'categories' => $categories->categories,
        ], 200);
    }

    public function store(CreateWebinarRequest $request)
    {
        try {
            $create = Webinar::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Created webinar successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function edit(Webinar $webinar)
    {
        return response()->json([
            'data' => $webinar,
        ], 200);
    }

    public function update(Webinar $webinar, UpdateWebinarRequest $request)
    {
        try {
            $update = $webinar->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Updated webinar successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(Webinar $webinar)
    {
        try {
            $delete = $webinar->delete();

            return response()->json([
             'success' => true,
             'message' => 'Deleted webinar successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
