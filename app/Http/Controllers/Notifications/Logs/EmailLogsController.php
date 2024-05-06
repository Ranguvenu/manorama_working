<?php

namespace App\Http\Controllers\Notifications\Logs;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notifications\EmailNotificationResource;
use App\Models\Notifications\EmailNotification;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmailLogsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-email_log'])->only('index', 'results');
    }

    public function index(Request $request)
    {
        return Inertia::render('Notifications/Logs/Email/index');
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $emaillogs = EmailNotification::filterBy($request->all())->latest()->paginate($perpage);

        return EmailNotificationResource::collection($emaillogs);
    }
}
