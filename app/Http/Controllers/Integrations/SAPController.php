<?php

namespace App\Http\Controllers\Integrations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\SapController\UpdateRequest as UpdateSapRequest;
use App\Http\Resources\Ecommerce\SapResource;
use App\Models\Ecommerce\SapController as Sapdata;
use App\Services\SAPService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SAPController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-sap-data'])->only('index', 'results');
        $this->middleware(['role_or_permission:edit-sap-data'])->only('update', 'edit');
    }

    public function index(Request $request)
    {
        return Inertia::render('Ecommerce/SAPData/index');
    }

    public function results(Request $request, Sapdata $sapdata)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $data = $sapdata->filterBy($request->all())->latest()->paginate($perpage);

        return SapResource::collection($data);
    }

    public function edit(Sapdata $sapdata)
    {
        return response()->json([
            'data' => $sapdata,
            'response' => $sapdata->responses()->latest()->first(),
        ], 200);
    }

    public function update(Sapdata $sapdata, UpdateSapRequest $request)
    {
        try {
            $sapresponse = [];
            $sapservice = new SAPService();
            $update = $sapdata->update($request->validated());
            if ($sapdata->sap_type == 1) {
                $sapresponse = $sapservice->submit_order_file($sapdata);
            } elseif ($sapdata->sap_type == 2) {
                $sapresponse = $sapservice->submit_reconcilation_file($sapdata);
            }

            return response()->json([
                'success' => true,
                'message' => 'Updated SAP Data Successfully',
                'response' => $sapresponse,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
                'response' => $sapresponse,
            ], 422);
        }
    }
}
