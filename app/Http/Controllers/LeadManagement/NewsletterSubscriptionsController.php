<?php

namespace App\Http\Controllers\LeadManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadManagement\NewsletterSubscriptions\CreateRequest as CreateNewsletterRequest;
use App\Http\Resources\LeadManagement\NewsletterSubscriptionsResource;
use App\Models\LeadManagement\NewsletterSubscription;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NewsletterSubscriptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-newsletter-subscriptions'])->only('index', 'results');
    }

    public function index(Request $request)
    {
        return Inertia::render('LeadManagement/NewsletterSubscriptions/index');
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $agents = NewsletterSubscription::filterBy($request->all())->latest()->paginate($perpage);

        return NewsletterSubscriptionsResource::collection($agents);
    }

    public function store(CreateNewsletterRequest $request)
    {
        try {
            $data = $request->validated();
            $create = NewsletterSubscription::updateOrCreate([
                'email' => $request->get('email'),
            ], ['ip_address' => $request->getClientIp()]);

            return response()->json([
                'success' => true,
                'message' => 'Subcription Request Sent Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
