<?php

namespace App\Http\Controllers\Website\PageBuilder;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Pages\CreateRequest as CreatePageRequest;
use App\Http\Requests\Website\Pages\UpdateRequest as UpdatePageRequest;
use App\Http\Resources\Website\PageResource;
use App\Models\User;
use App\Models\Website\PageBuilder\Page;
use App\Models\Website\PageBuilder\PageComponentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-website-pages'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-website-pages'])->only('create', 'store');
        $this->middleware(['role_or_permission:design-website-pages'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-website-pages'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-website-pages'])->only('destroy');
    }

    public function index()
    {
        $page = new Page();

        return Inertia::render('Website/PageBuilder/Pages/index',
            [
                'data' => [
                    'authors' => User::permission('create-website-pages')->get(),
                    'statuses' => $page->statuses(),
                ],
            ],
        );
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $pages = Page::filterBy($request->all())->latest()->paginate($perpage);

        return PageResource::collection($pages);
    }

    public function store(CreatePageRequest $request)
    {
        try {
            $page = Page::create($request->validated());

            return response()->json([
                'success' => true,
                'data' => $page->id,
                'message' => 'Page published successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to publish page',
            ]);
        }
    }

    public function create()
    {
        $page = new Page();

        return Inertia::render('Website/PageBuilder/Pages/create', [
            'edit' => false,
            'options' => [
                'statuses' => $page->statuses(),
                'packages' => [],
            ],
        ]);
    }

    public function edit(Page $page)
    {
        $package = [];
        if ($page->package) {
            $package[] = $page->package;
        }

        return Inertia::render('Website/PageBuilder/Pages/create', [
            'page' => $page,
            'resource' => new PageResource($page),
            'edit' => $page->id,
            'options' => [
                'statuses' => $page->statuses(),
                'packages' => $package,
            ],
        ]);
    }

    public function update(Page $page, UpdatePageRequest $request)
    {
        try {
            $update = $page->update($request->validated());

            return response()->json([
                'success' => true,
                'data' => $page->id,
                'message' => 'Page updated successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to publish page',
            ]);
        }

        return to_route('website.pages.create');
    }

    public function components(Request $request)
    {
        $components = PageComponentType::filterBy($request->all())->get();

        return $components;
    }

    public function publish(Page $page, Request $request)
    {
        try {
            $page->configuration = $request->all();
            $page->save();

            return response()->json([
                'success' => true,
                'message' => 'Page published successfully',
                'page_slug' => $page->slug,
                'page_type' => $page->page_type,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(Page $page)
    {
        DB::beginTransaction();
        try {
            $page->components()->delete();
            $page->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Page deleted successfully',
            ], 200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete page',
                'data' => $e->getMessage(),
            ], 200);
        }
    }
}
