<?php

namespace App\Http\Controllers\Content;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Content\DownloadableResources\CreateRequest as CreateDownloadRequest;
use App\Http\Requests\Content\DownloadableResources\UpdateRequest as UpdateDownloadRequest;
use App\Models\MasterData\Taxonomy;
use App\Models\Content\DownloadableResource;
use App\Http\Resources\Content\DownloadableResourcesResource;

class DownloadableResourcesController extends Controller
{
    public function __construct(){
        $this->middleware(['role_or_permission:view-downloadable-resource'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-downloadable-resource'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-downloadable-resource'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-downloadable-resource'])->only('destroy');
    }
    
    public function index(Request $request){
        return Inertia::render('Content/DownloadableResources/index');
    }

    public function results(Request $request){
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $resource = DownloadableResource::filterBy($request->all())->paginate($perpage);
        return DownloadableResourcesResource::collection($resource);
    }

    public function create(){
        $resource_types = Taxonomy::findOrFail('resource_type');
        return response()->json([
            'resource_types' => $resource_types->categories
        ], 200);
    }

    public function store(CreateDownloadRequest $request){  
        try{    
            $create = DownloadableResource::create($request->validated());
            return response()->json([
                'success'   => true,
                'message'   => 'created resource'
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'success'   => true,
                'message'   => $e->getMessage()
            ], 422);
        }      
    }

    public function edit(DownloadableResource $resource){
        return response()->json([
            'data'  => $resource
        ],200);   
    }

    public function update(DownloadableResource $resource, UpdateDownloadRequest $request){  
        try{
            $update = $resource->update($request->validated());      
            return response()->json([
                'success'   => true,
                'message'   => 'Updated resource'
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'success'   => true,
                'message'   => $e->getMessage()
            ], 422);
        }
    }

    public function destroy(DownloadableResource $resource){
        try{
            $delete = $resource->delete();
               return response()->json([
                'success'   => true,
                'message'   => 'Deleted resource'
            ], 200);       
        }catch(Exception $e){
            return response()->json([
                'success'   => true,
                'message'   => $e->getMessage()
            ], 422);
        }
    }
}
