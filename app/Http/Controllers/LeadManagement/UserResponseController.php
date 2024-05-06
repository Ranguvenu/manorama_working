<?php

namespace App\Http\Controllers\LeadManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadManagement\UserResponse\CreateRequest as CreateResponseRequest;
use App\Http\Resources\LeadManagement\UserResponseResource;
use App\Models\LeadManagement\InterestedIn;

class UserResponseController extends Controller
{
    public function index(InterestedIn $interests)
    {
        return [
            'comments' => UserResponseResource::collection($interests->comments),
            'callhistory' => UserResponseResource::collection($interests->callhistory),
        ];
    }

    public function store(InterestedIn $interests, CreateResponseRequest $request)
    {
        try {
            $create = $interests->responses()->create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Response Submitted Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
