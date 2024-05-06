<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\Packages\CreateRequest as CreatePackageRequest;
use App\Http\Requests\Ecommerce\Packages\UpdateRequest as UpdatePackageRequest;
use App\Http\Resources\Ecommerce\EditPackageResource;
use App\Http\Resources\Ecommerce\PackageResource;
use App\Http\Resources\Ecommerce\PackagesResource;
use App\Models\Ecommerce\Packages;
use App\Models\MasterData\Hierarchy;
use App\Models\Website\PageBuilder\Page;
use App\Services\Moodle\Package as PackageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PackagesController extends Controller
{
    public $service;

    public function __construct()
    {
        $this->service = new PackageService();
        $this->middleware(['role_or_permission:view-package'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-package'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-package'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-package'])->only('destroy');
    }

    public function index()
    {
        $package = new Packages();
        $goals = Hierarchy::onlyGoals()->get();
        $data = [
            'goals' => $goals,
            'payment_types' => $package->payment_types(),
            'boards' => [],
            'classes' => [],
            'subjects' => [],
        ];

        return Inertia::render('Ecommerce/Packages/index', [
           'data' => $data,
        ]);
    }

    public function create($slug)
    {
        $package = new Packages();
        $goals = Hierarchy::onlyGoals()->get();
        $data = [
            'goals' => $goals,
            'package_types' => $package->package_types(),
            'payment_types' => $package->payment_types(),
            'boards' => [],
            'classes' => [],
            'subjects' => [],
        ];

        return Inertia::render('Ecommerce/Packages/create', [
            'edit' => false,
            'active' => $slug,
            'data' => $data,
            'package' => [
                'data' => [],
            ],
        ]);
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $packages = Packages::filterBy($request->all())->latest()->paginate($perpage);

        return PackagesResource::collection($packages);
    }

    public function list(Request $request)
    {
        $packages = Packages::filterBy($request->all())->latest()->pluck('title', 'id');

        return $packages;
    }

    public function show(Packages $package)
    {
        return Inertia::render('Ecommerce/Packages/show', [
            'data' => new PackageResource($package),
        ]);
    }

    public function edit(Packages $package, $slug)
    {
        $goals = Hierarchy::onlyGoals()->get();
        $data = [
            'goals' => $goals,
            'package_types' => $package->package_types(),
            'payment_types' => $package->payment_types(),
            'boards' => $package->goal->boards,
            'classes' => $package->board->classes,
            'subjects' => $package->classes->subjects,
        ];

        return Inertia::render('Ecommerce/Packages/create', [
            'edit' => true,
            'active' => $slug,
            'data' => $data,
            'package' => new EditPackageResource($package),
        ]);
    }

    public function store(CreatePackageRequest $request)
    {
        DB::beginTransaction();
        try {
            $package = Packages::create($request->validated());
            $courses = [];
            if ($package->package_type == 1) {
                $hierarchy = Hierarchy::create([
                    'title' => $package->title,
                    'code' => uniqid(),
                    'parent_id' => $package->class_id,
                    'depth' => 3,
                    'type_id' => 5,
                ]);
                $courses[] = [
                    'course_id' => $hierarchy->id,
                ];
            } else {
                $courses = array_map(function ($course) {
                    return ['course_id' => $course];
                }, $request->get('subjects'));
            }
            $package->courses()->createUpdateOrDelete($courses);

            if (!$package->is_paid) {
                $pricing = $package->pricing()->create([
                    'actual_price' => 0,
                    'selling_price' => 0,
                ]);
                $pricing->courses()->createUpdateOrDelete($courses);
            }

            $package->pages()->create([
                'title' => $package->title,
                'page_type' => 'package',
                'seo_configuration' => [
                    'title' => '',
                    'description' => '',
                    'card' => '',
                    'follow_links' => '',
                    'robots' => [],
                    'canonical_url' => '',
                    'schema' => '',
                    'twitter_handle' => '',
                    'keywords' => [],
                    'meta_data' => '',
                ],
            ]);

            $mdl_id = $this->service->create_package($package);
            if ($mdl_id) {
                $package->mdl_package = $mdl_id;
                $package->save();
                DB::commit();

                return response()->json([
                    'id' => $package->id,
                    'success' => true,
                    'message' => 'Package created successfully',
                ], 200);
            } else {
                DB::rollback();

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create',
                ], 422);
            }
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Failed to create package',
                'exception' => $e->getMessage(),
            ], 200);
        }
    }

    public function update(Packages $package, UpdatePackageRequest $request)
    {
        $result = $request->all();
        DB::beginTransaction();
        try {
            $packagedetails = $package;
            $package = $package->update($request->validated());

            $mdl_id = $this->service->create_package($packagedetails);
            if ($mdl_id) {
                $packagedetails->mdl_package = $mdl_id;
                $packagedetails->save();
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Package updated successfully',
                ], 200);
            } else {
                DB::rollback();

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update',
                ], 422);
            }
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update package',
            ], 200);
        }
    }

    public function destroy(Packages $package)
    {
        try {
            if ($package->orders()->count()) {
                return response()->json([
                    'success' => false,
                    'message' => 'As users has already purchased this package this package cannot be deleted',
                ], 200);
            }
            $this->service->destroy_package($package->code, 'package');
            $delete = $package->delete();

            return response()->json([
                'success' => true,
                'message' => 'Package deleted successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Package',
            ], 422);
        }
    }

    public function marketing(Packages $package, Request $request)
    {
        try {
            $rules = [];
            $rules['type'] = 'required';
            if ($request->get('type') == 0) {
                $rules['page_id'] = 'required';
            } else {
                $rules['title'] = 'required';
            }
            $request->validate($rules);

            if ($request->get('type') == 0) {
                $page = Page::find($request->get('page_id'));
                $page->package_id = $package->id;
                $page->page_type = 'package';
                $page->save();
            } else {
                if ($package->pages) {
                    $page = Page::find($package->pages->id);
                    $page->package_id = 0;
                    $page->page_type = 'page';
                    $page->save();
                }
                $package->pages()->create([
                    'title' => $request->get('title'),
                    'page_type' => 'package',
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Page created',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create page',
            ], 422);
        }
    }

    public function publish(Packages $package)
    {
        try {
            $package = $package->update([
                'is_published' => 1,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Package is Published',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e,
                'success' => false,
                'message' => 'Failed to Publish the Package',
            ], 200);
        }
    }
}
