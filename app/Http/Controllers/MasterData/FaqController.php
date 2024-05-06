<?php

namespace App\Http\Controllers\MasterData;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\Faq\CreateRequest as CreateFaqRequest;
use App\Http\Requests\MasterData\Faq\UpdateRequest as UpdateFaqRequest;
use App\Models\MasterData\Faq;
use App\Models\MasterData\Taxonomy;
use App\Http\Resources\MasterData\FaqResource;

class FaqController extends Controller
{
	public function __construct(){
        $this->middleware(['role_or_permission:view-faq'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-faq'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-faq'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-faq'])->only('destroy');
    }

    public function index(Request $request){
        return Inertia::render('MasterData/Faq/index');
    }

    public function results(Request $request){
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $faq = Faq::filterBy($request->all())->paginate($perpage);
        return FaqResource::collection($faq);
    }

    public function create(){
		$taxonomy = Taxonomy::findOrFail('faq_category');
		return response()->json([
			'categories'	=> $taxonomy->categories	
		], 200);
    }

    public function store(CreateFaqRequest $request){
      	try{    
        	$create = Faq::create($request->validated());
			return response()->json([
				'success'	=> true,
				'message'	=> 'Created Faq Successfully'
			], 200);
		}catch(Exception $e){
			return response()->json([
				'success'	=> true,
				'message'	=> $e->getMessage()
			], 422);
		}
	}
	
	public function edit(Faq $faq){
        return response()->json([
			'data'	=> $faq
        ],200);   	
	}	

	public function update(Faq $faq, UpdateFaqRequest $request){
        try{
			$update = $faq->update($request->validated());      
			return response()->json([
				'success'	=> true,
				'message'	=> 'Updated Faq Successfully'
			], 200);
		}catch(Exception $e){
			return response()->json([
				'success'	=> true,
				'message'	=> $e->getMessage()
			], 422);
		}
	}

	public function destroy(Faq $faq){
		try{
            $delete = $faq->delete();
            return response()->json([
				'success'	=> true,
				'message'	=> 'Deleted Faq Successfully'
         	], 200);       
     	}catch(Exception $e){
         	return response()->json([
             'success'	=> true,
             'message'	=> $e->getMessage()
         	], 422);
   		}   
	}
}
