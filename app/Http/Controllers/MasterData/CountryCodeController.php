<?php

namespace App\Http\Controllers\MasterData;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeadManagement\Lead;
use App\Models\LeadManagement\ContactUsRequest;
use App\Models\MasterData\CountryCode;
use App\Models\User;
use App\Http\Resources\MasterData\CountryCodeResource;

use App\Http\Requests\MasterData\CountryCode\CreateRequest as CreateCountryCodeRequest;
use App\Http\Requests\MasterData\CountryCode\UpdateRequest as UpdateCountryCodeRequest;

class CountryCodeController extends Controller
{
    //
	public function __construct(){
        $this->middleware(['role_or_permission:view-countrycode'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-countrycode'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-countrycode'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-countrycode'])->only('destroy');
    }


    public function index(CountryCode $countrycode){
        return Inertia::render('MasterData/CountryCode/index',['countrycode' => $countrycode]);
    }

    public function results(Request $request){
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $countryCode = CountryCode::filterBy($request->all())->paginate($perpage);

        return CountryCodeResource::collection($countryCode);
    }

    public function create(CountryCode $countrycode, Request $request){

        return Inertia::render('MasterData/CountryCode/create',['countrycode'=>$countrycode,'edit'=>false]);
     
    }
    public function edit(CountryCode $countrycode){
        return response()->json([
			'data'	=> $countrycode
        ],200);     
    }
    public function update(CountryCode $countrycode, UpdateCountryCodeRequest $request){  
        try{
			$update = $countrycode->update($request->validated());      
			return response()->json([
				'success'	=> true,
				'message'	=> 'Updated Country Code Successfully'
			], 200);
		}catch(Exception $e){
			return response()->json([
				'success'	=> true,
				'message'	=> $e->getMessage()
			], 422);
		}
	}
    public function store(CreateCountryCodeRequest $request){   
		try{    
        	$create = CountryCode::create($request->validated());
			return response()->json([
				'success'	=> true,
				'message'	=> 'Created Country Code Successfully'
			], 200);
		}catch(Exception $e){
			return response()->json([
				'success'	=> true,
				'message'	=> $e->getMessage()
			], 422);
		}
	}

    public function destroy(CountryCode $countrycode){
		try{
       		$delete = $countrycode->delete();
			   return response()->json([
				'success'	=> true,
				'message'	=> 'Deleted Country Code Successfully'
			], 200);       
		}catch(Exception $e){
			return response()->json([
				'success'	=> true,
				'message'	=> $e->getMessage()
			], 422);
		}
    }

    public function existingcode(CountryCode $countrycode)
    {
        if($countrycode->code){
			$userQuery = User::query()->select('id', 'name', 'email', 'country_code')->where('country_code', $countrycode->code);
			$leadQuery = Lead::query()->select('id', 'name', 'email', 'country_code')->where('country_code', $countrycode->code);
			$contactusQuery = ContactUsRequest::query()->select('id', 'name', 'email', 'country_code')->where('country_code', $countrycode->code);

			$codeexist = $userQuery->unionAll($leadQuery)->unionAll($contactusQuery)->get();
  		}

        return response()->json([
            'success' => true,
            'data'	=>  $codeexist
        ],200);
    }
}
