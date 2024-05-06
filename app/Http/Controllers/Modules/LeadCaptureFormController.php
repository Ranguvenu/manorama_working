<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modules\LeadCaptureForm\CreateRequest as CreateLeadCaptureRequest;
use App\Models\LeadManagement\Lead;
use App\Models\LeadManagement\LeadOtp;
use App\Models\MasterData\Category;
use App\Models\MasterData\Hierarchy;
use App\Models\MasterData\Taxonomy;
use App\Services\Notifications\NotificationService;
use Illuminate\Http\Request;

class LeadCaptureFormController extends Controller
{
    public function create(Request $request)
    {
        $goals = Hierarchy::onlyGoals()->get();

        return $goals;
    }

    public function store(CreateLeadCaptureRequest $request)
    {
        try {
            $channel = $request->get('channel');
            if ($channel == 'sms') {
                $to_address = str_replace('+', '', $request->get('phone')['code'].$request->get('phone')['number']);
            } elseif ($channel == 'email') {
                $to_address = $request->get('email');
            }
            $validate = LeadOtp::where('type', $channel)->where('to_address', $to_address)->where('otp', $request->get('otp'))->latest()->first();
            if ($validate) {
                $taxonomy = Taxonomy::findOrFail('lead_category');
                $category = $taxonomy->categories->where('slug', 'callback')->first();
                $data = $request->validated();
                $data['country_code'] = $request->get('phone')['code'];
                $data['phone_number'] = $request->get('phone')['number'];
                $lead = Lead::updateOrCreate(
                    ['email' => $request->get('email')],
                    $data);
                $source = Category::where('slug', 'callback_request')->first();
                $lead->interests()->create([
                    'received_from' => $request->get('received_from'),
                    'source_id' => $source->id,
                    'category_id' => $category->id,
                    'tags' => $request->get('tags'),
                    'product_id' => 0,
                ]);

                if (\Auth::user()) {
                    $lead->registrations()->updateOrCreate(['user_id' => auth()->user()->id], ['user_id' => auth()->user()->id]);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Submitted successfully',
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function otp(CreateLeadCaptureRequest $request)
    {
        try {
            $channel = $request->get('channel');
            if ($channel == 'sms') {
                $to_address = str_replace('+', '', $request->get('phone')['code'].$request->get('phone')['number']);
            } elseif ($channel == 'email') {
                $to_address = $request->get('email');
            }
            $otp = LeadOtp::updateOrCreate([
                'to_address' => $to_address,
                'type' => $channel,
            ], [
                'otp' => rand(10000, 99999),
            ]);

            $notifier = new NotificationService(null, $to_address);
            $notifier->send('rcv-notification', $channel, $otp->variables);

            return response()->json([
                'success' => true,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 200);
        }
    }
}
