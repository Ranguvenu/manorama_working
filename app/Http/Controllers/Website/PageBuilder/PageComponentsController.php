<?php

namespace App\Http\Controllers\Website\PageBuilder;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\PageComponents\CreateRequest as PageComponentCreateRequest;
use App\Http\Requests\Website\PageComponents\UpdateRequest as PageComponentUpdateRequest;
use App\Http\Resources\Website\PageComponentsResource;
use App\Models\MasterData\Testimonial;
use App\Models\Website\PageBuilder\Page;
use App\Models\Website\PageBuilder\PageComponents;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageComponentsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-website-pages'])->only('index', 'show');
        $this->middleware(['role_or_permission:create-website-pages'])->only('create', 'store');
        $this->middleware(['role_or_permission:design-website-pages'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-website-pages'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-website-pages'])->only('destroy');
    }

    public function index(Page $page)
    {
        return Inertia::render('Website/PageBuilder/Pages/design', [
            'page' => $page,
        ]);
    }

    public function show(Page $page)
    {
        return Inertia::render('Website/PageBuilder/Pages/preview', [
            'page' => $page,
        ]);
    }

    public function create(Page $page)
    {
        $components = $page->components;

        return response()->json([
            'data' => PageComponentsResource::collection($components),
        ], 200);
    }

    public function testimonialsdata(Page $page)
    {
        $components = $page->components;

        return response()->json([
            'testimonialdata' => Testimonial::all(),
        ], 200);
    }

    public function store(Page $page, PageComponentCreateRequest $request)
    {
        try {
            $create = $page->components()->create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Component added successfully',
                'data' => $page->components,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => [],
            ], 422);
        }
    }

    public function clone(Page $page, PageComponents $component)
    {
        try {
            $clone = $component->replicate();
            $clone->save();

            return response()->json([
                'success' => true,
                'message' => 'Component cloned successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update_visibility(Page $page, PageComponents $component, $visible)
    {
        try {
            $component->visible = $visible;
            $component->save();

            return response()->json([
                'success' => true,
                'message' => 'Updated status',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(Page $page, PageComponents $component, PageComponentUpdateRequest $request)
    {
        try {
            $update = $component->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Component updated successfully',
                'data' => $page->components,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => [],
            ], 422);
        }
    }

    public function update_position(Page $page, Request $request)
    {
        try {
            $components = $request->all();
            $total = sizeof($components);
            foreach ($components as $index => $value) {
                $component = PageComponents::findOrFail($value['id']);
                $component->order = $total - $index;
                $component->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Positions updated',
                'data' => $components,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => [],
            ], 422);
        }
    }

    public function destroy(Page $page, PageComponents $component)
    {
        try {
            $destroy = $component->delete();

            return response()->json([
                'success' => true,
                'message' => 'Component deleted successfuly',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => [],
            ], 422);
        }
    }
}
