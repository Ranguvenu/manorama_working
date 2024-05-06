<?php

namespace App\Http\Controllers\LeadManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadManagement\ContactUsRequests\CreateRequest as CreateContactUsRequest;
use App\Http\Resources\LeadManagement\ContactUsRequestsResource;
use App\Models\LeadManagement\ContactUsRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactUsRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-contact-requests'])->only('index', 'results');
    }

    public function index(Request $request)
    {
        return Inertia::render('LeadManagement/ContactUsRequests/index');
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $agents = ContactUsRequest::filterBy($request->all())->latest()->paginate($perpage);

        return ContactUsRequestsResource::collection($agents);
    }

    public function store(CreateContactUsRequest $request)
    {
        try {
            $data = $request->validated();
            $data['country_code'] = $request->get('phone')['code'];
            $data['phone_number'] = $request->get('phone')['number'];
            $create = ContactUsRequest::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Contact Request Sent Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
