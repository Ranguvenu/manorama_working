<?php

namespace App\Http\Controllers\LeadManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadManagement\PromoCodes\CreateRequest as CreatePromoCodeRequest;
use App\Http\Resources\LeadManagement\PromoCodeResource;
use App\Models\LeadManagement\InterestedIn;
use Illuminate\Http\Request;
use App\Services\Notifications\NotificationService;

class LeadPromoCodesController extends Controller
{
    public function index(InterestedIn $interests, Request $request)
    {
        $codes = $interests->promocodes()->latest()->get();

        return PromoCodeResource::collection($codes);
    }

    public function send(InterestedIn $interests, CreatePromoCodeRequest $request)
    {
        try {
            $notification = new NotificationService(null, $request->get('email'));
            $interests->promocodes()->create($request->validated());
            $notification->send('promocode', 'email', $request->all());
            
            return response()->json([
                'success' => true,
                'message' => 'Promocode sent successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send promocode',
            ], 422);
        }
    }
}
