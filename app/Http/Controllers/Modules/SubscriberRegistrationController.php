<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modules\SubscriberRegistration\CreateRequest as CreateSubscriberRequest;
use App\Models\UserManagement\SubscriberOtp;
use App\Services\Notifications\NotificationService;
use App\Services\SubscriberRegistration;

class SubscriberRegistrationController extends Controller
{
    public function store(CreateSubscriberRequest $request)
    {
        try {
            $channel = $request->get('channel');
            if ($channel == 'sms') {
                $to_address = str_replace('+', '', $request->get('phone')['code'].$request->get('phone')['number']);
            } elseif ($channel == 'email') {
                $to_address = $request->get('email');
            }
            $validate = SubscriberOtp::where('type', $channel)->where('to_address', $to_address)->where('otp', $request->get('otp'))->latest()->first();
            if ($validate) {
                $data = [
                    'name' => uniqid(),
                    'email' => $request->get('email'),
                    'password' => \Hash::make($request->get('password')),
                    'country_code' => $request->get('phone')['code'],
                    'phone_number' => $request->get('phone')['number'],
                    'firstname' => $request->get('firstname'),
                    'lastname' => $request->get('lastname'),
                ];
                $subscriber = new SubscriberRegistration();
                $subscriber->create_subscriber($data);

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

    public function otp(CreateSubscriberRequest $request)
    {
        try {
            $channel = $request->get('channel');
            if ($channel == 'sms') {
                $to_address = str_replace('+', '', $request->get('phone')['code'].$request->get('phone')['number']);
            } elseif ($channel == 'email') {
                $to_address = $request->get('email');
            }
            $otp = SubscriberOtp::updateOrCreate([
                'to_address' => $to_address,
                'type' => $channel,
            ], [
                'otp' => rand(100000, 999999),
            ]);

            $notifier = new NotificationService(null, $to_address);
            $notifier->send('srv-notification', $channel, $otp->variables);

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
