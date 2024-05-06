<?php

namespace App\Http\Controllers\MasterData;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\Schools\CreateRequest as CreateSchoolRequest;
use App\Http\Requests\MasterData\Schools\UpdateRequest as UpdateSchoolRequest;
use App\Models\MasterData\School;
use App\Http\Resources\MasterData\SchoolResource;

class SchoolsController extends Controller
{
	public function __construct(){
        $this->middleware(['role_or_permission:view-school'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-school'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-school'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-school'])->only('destroy');
    }
    
    public function index(Request $request){
        return Inertia::render('MasterData/Schools/index');
    }

    public function results(Request $request){
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $schools = School::with('user_created')->filterBy($request->all())->paginate($perpage);
        return SchoolResource::collection($schools);
    }

    public function create(){
        return Inertia::render('MasterData/Schools/create',['edit'=>false]);
    }

    public function store(CreateSchoolRequest $request){    
		try{    
        	$create = School::create($request->validated());
			return response()->json([
				'success'	=> true,
				'message'	=> 'Created School Successfully'
			], 200);
		}catch(Exception $e){
			return response()->json([
				'success'	=> true,
				'message'	=> $e->getMessage()
			], 422);
		}
	}

    public function edit(School $school){
        return response()->json([
			'data'	=> $school
        ],200);     
    }
	public function show(School $school){
		return response()->json([
            'success' => true,
            'data' => new SchoolResource($school),
        ], 200);

	}

    public function update(School $school, UpdateSchoolRequest $request){  
        try{
			$update = $school->update($request->validated());      
			return response()->json([
				'success'	=> true,
				'message'	=> 'Updated School Successfully'
			], 200);
		}catch(Exception $e){
			return response()->json([
				'success'	=> true,
				'message'	=> $e->getMessage()
			], 422);
		}
	}

    public function destroy(School $school){
		try{
       		$delete = $school->delete();
			   return response()->json([
				'success'	=> true,
				'message'	=> 'Deleted School Successfully'
			], 200);       
		}catch(Exception $e){
			return response()->json([
				'success'	=> true,
				'message'	=> $e->getMessage()
			], 422);
		}
    }
}
