<?php

namespace App\Http\Controllers\MasterData;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\Universities\CreateRequest as CreateUniversityRequest;
use App\Http\Requests\MasterData\Universities\UpdateRequest as UpdateUniversityRequest;
use App\Models\MasterData\Universities;
use App\Http\Resources\MasterData\UniversityResource;


class UniversitiesController extends Controller
{
    public function __construct(){
        $this->middleware(['role_or_permission:view-universities'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-universities'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-universities'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-universities'])->only('destroy');
    }
    
    public function index(Request $request){
        return Inertia::render('MasterData/Universities/index');
    }
    
    public function results(Request $request){
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $universities = Universities::filterBy($request->all())->paginate($perpage);
        return UniversityResource::collection($universities);
    }   

    public function create(){       
        return Inertia::render('MasterData/Universities/create');
    }

    public function store(CreateUniversityRequest $request){       
        try{    
        	$create = Universities::create($request->validated());
			return response()->json([
				'success'	=> true,
				'message'	=> 'Created University Successfully'
			], 200);
		}catch(Exception $e){
			return response()->json([
				'success'	=> true,
				'message'	=> $e->getMessage()
			], 422);
		}
    }

    public function edit(Universities $universities){
        return response()->json([
			'data'	=> $universities
        ],200);     
    }
    public function show(Universities $universities){
        return response()->json([
            'success'=>true,
			'data'	=> new UniversityResource($universities),
        ],200);     
    }


   public function update(Universities  $universities, UpdateUniversityRequest $request){
 
    try{
        $update = $universities->update($request->validated());      
        return response()->json([
            'success'	=> true,
            'message'	=> 'Updated University Successfully'
        ], 200);
    }catch(Exception $e){
        return response()->json([
            'success'	=> true,
            'message'	=> $e->getMessage()
        ], 422);
    }
    }

    public function destroy(Universities  $universities,){  
        try{
            $delete = $universities->delete();
            return response()->json([
             'success'	=> true,
             'message'	=> 'Deleted University Successfully'
         ], 200);       
     }catch(Exception $e){
         return response()->json([
             'success'	=> true,
             'message'	=> $e->getMessage()
         ], 422);
     }

   
    }



}
