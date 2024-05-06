<?php

namespace App\Http\Controllers\Integrations;

use App\Http\Controllers\Controller;
use App\Models\LeadManagement\InterestedIn;
use App\Models\LeadManagement\LeadUserResponse;
use Illuminate\Http\Request;

class RaalinkController extends Controller
{
    public function call_user(InterestedIn $interest, Request $request)
    {
        try {
            $response = $interest->responses()->create([
                'captured_from' => 1,
                'call_id' => uniqid(),
            ]);
            $interest->status = 3;
            $interest->save();

            return response()->json([
                'success' => true,
                'url' => 'http://172.30.1.133/crmc2c.php?exten='.auth()->user()->name.'&phone='.$request->get('phone').'&profileId='.$interest->id.'&callID='.$response->call_id,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'url' => '',
            ], 200);
        }
    }

    public function capture(LeadUserResponse $caller, Request $request)
    {
        return $caller;
    }
}

// http://172.30.1.133/crmc2c.php?exten=ranga&phone=9110513099&profileId=1&callID=655874838a0cd
