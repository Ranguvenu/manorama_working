<?php

namespace App\Http\Controllers;

use App\Models\LeadManagement\LeadUserResponse;
use App\Models\Notifications\SmsNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebhooksController extends Controller
{
    public function sinch(Request $request)
    {
        $service = new \App\Services\Notifications\SMS\SinchService();
        $data = $request->all();
        \Log::info('********************************55*********');
        \Log::info(serialize($data));
        \Log::info('**********************************55*******');
        \Log::info($request['batch_id']);
        $notification = SmsNotification::where('message_id', $request['batch_id'])->first();
        $dateAndTime = Carbon::parse($data['at']);
        \Log::info($notification['batch_id']);
        $log = [
            'logged_at' => $dateAndTime->toDateTimeString(),
            'event' => $service->get_status_code($data['status']),
        ];

        return $notification->sms_logs()->create($log);
    }

    public function smscountry(Request $request)
    {
        $service = new \App\Services\Notifications\SMS\SMSCountryService();
        $data = $request->get('SMS');
        $notification = SmsNotification::where('message_id', $data['UUID'])->first();
        $dateAndTime = Carbon::parse($data['StatusTime']);
        $log = [
            'logged_at' => $dateAndTime->toDateTimeString(),
            'event' => $service->get_status_code($data['StatusCode']),
        ];
        \Log::info('********************************SMSCOUNTRY*********');
        \Log::info(serialize($data));
        \Log::info('********************************SMSCOUNTRY*********');

        return $notification->sms_logs()->create($log);
    }

    public function capture_raalink_response(LeadUserResponse $caller, Request $request)
    {
        \Log::info('********************************RAALINK RESPONSE*********');
        \Log::info(serialize($request->all()));
        \Log::info('********************************RAALINK RESPONSE*********');
        $caller->response = $request->get('recordingfile');
        $caller->status = $request->get('calldispostatus');
        if ($request->get('callback_date')) {
            $caller->callback = true;
        }
        $caller->callback_on = $request->get('callback_date');
        $caller->save();

        return $caller;
    }
}
