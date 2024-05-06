<?php

namespace App\Http\Controllers\Notifications\Logs;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notifications\SmsNotificationResource;
use App\Models\Notifications\SmsNotification;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SmsLogsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-sms_log'])->only('index', 'results');
    }

    public function index(Request $request)
    {
        return Inertia::render('Notifications/Logs/Sms/index');
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;

        $smslogs = SmsNotification::with('sms_logs')->latest()->filterBy($request->all())->latest()->paginate($perpage);

        return SmsNotificationResource::collection($smslogs);
    }
}
