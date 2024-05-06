<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notifications\Settings\SettingsUpdateRequest as UpdateSettingsRequest;
use App\Http\Resources\Notifications\NotificationSettingsResource;
use App\Models\Notifications\NotificationSettings;
use App\Models\Notifications\Templates\SmsTemplate;
use App\Models\Notifications\Templates\EmailTemplate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationSettingsController extends Controller
{
    public function __construct(){
        $this->middleware(['role_or_permission:create-notification-settings'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-notification-settings'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-notification-settings'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-notification-settings'])->only('destroy');
    }

    public function index(Request $request)
    {
        return Inertia::render('Notifications/Settings/index');
    }

    public function results(Request $request)
    {
        $settings = NotificationSettings::paginate(100);

        return NotificationSettingsResource::collection($settings);
    }

    public function edit(NotificationSettings $setting)
    {
        return response()->json([
            'data' => $setting,
            'templates' => $setting->templates->where('status', 1),
        ], 200);
    }

    public function update(NotificationSettings $setting, UpdateSettingsRequest $request)
    {
        try {
            $update = $setting->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Notificaton Settings Updated Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
