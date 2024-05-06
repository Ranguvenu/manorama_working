<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modules\Guruvandanam\CreateRequest as CreateGuruvandanamRequest;
use App\Http\Resources\Modules\GuruvandanamResource;
use App\Models\Modules\GuruvandanamEntries;
use Inertia\Inertia;
use Illuminate\Http\Request;

class GuruvandanamController extends Controller
{
    public function index()
    {
        return Inertia::render('LeadManagement/Guruvandanam/index');
    }

    public function store(CreateGuruvandanamRequest $request)
    {
        try {
            $data = $request->validated();   
            $data['country_code'] = $request->get('phone')['code'];
            $data['phone'] = $request->get('phone')['number'];
            $data['video'] = $request->get('video') ? $request->get('video') : $request->get('videourl');     
            $create = GuruvandanamEntries::create($data);
            return response()->json([
                'success' => true, 
                'message' => 'Created Guruvandanam Entry Successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function results(Request $request){
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;       
        $guruvandanam = GuruvandanamEntries::filterBy($request->all())->latest()->paginate($perpage);
        return GuruvandanamResource::collection($guruvandanam);
    }
}
