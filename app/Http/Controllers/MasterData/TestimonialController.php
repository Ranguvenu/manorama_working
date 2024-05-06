<?php

namespace App\Http\Controllers\MasterData;

use Inertia\Inertia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\Testimonials\CreateRequest as CreateTestimonialsRequest;
use App\Http\Requests\MasterData\Testimonials\UpdateRequest as UpdateTestimonialsRequest;
use App\Models\Ecommerce\Packages;
use App\Models\MasterData\Testimonial;
use App\Http\Resources\MasterData\TestimonialResource;


class TestimonialController extends Controller
{
	public function __construct()
	{
        $this->middleware(['role_or_permission:view-testimonials'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-testimonial'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-testimonial'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-testimonial'])->only('destroy');
    }
    
    public function create()
    {
    	$packages = Packages::all();

    	return response()->json([
			'packages' => $packages
		], 200);
    }
    
    public function store(CreateTestimonialsRequest $request)
    {    
		try{
        	$create = Testimonial::create($request->validated());
			return response()->json([
				'success'	=> true,
				'message'	=> 'Created Testimonial Successfully'
			], 200);
		}catch(Exception $e){
			return response()->json([
				'success'	=> true,
				'message'	=> $e->getMessage()
			], 422);
		}
	}
    
    public function index(Request $request)
    {
        return Inertia::render('MasterData/Testimonials/index');
    }
    
    public function results(Request $request){
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $testimonials = Testimonial::filterBy($request->all())->paginate($perpage );
        return TestimonialResource::collection($testimonials);
    }

    public function destroy(Testimonial $testimonial)
    {
		try{
       		$delete = $testimonial->delete();
			   return response()->json([
				'success'	=> true,
				'message'	=> 'Deleted Testimonial Successfully'
			], 200);       
		}catch(Exception $e){
			return response()->json([
				'success'	=> true,
				'message'	=> $e->getMessage()
			], 422);
		}
    }

    public function edit(Testimonial $testimonial)
    {
        return response()->json([
			'data'	=> $testimonial
        ],200);     
    }

    public function update(Testimonial $testimonial, UpdateTestimonialsRequest $request)
    {  
        try{
			$update = $testimonial->update($request->validated());      
			return response()->json([
				'success'	=> true,
				'message'	=> 'Updated Testimonial Successfully'
			], 200);
		}catch(Exception $e){
			return response()->json([
				'success'	=> true,
				'message'	=> $e->getMessage()
			], 422);
		}
	}

}
