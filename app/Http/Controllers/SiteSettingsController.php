<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteSettings\CreateRequest as CreateSiteSettingsRequest;
use App\Models\Notifications\Templates\EmailTemplate;
use App\Models\SiteSettings;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SiteSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-settings'])->only('index');
    }

    public function index(Request $request)
    {
        return Inertia::render('Settings/index');
    }

    public function store(CreateSiteSettingsRequest $request)
    {
        try {
            $settings = $request->validated();
            foreach ($settings['configuration'] as $key => $setting) {
                SiteSettings::set_setting($request->get('category'), $key, $setting);
            }

            return response()->json([
                'success' => true,
                'message' => 'Settings saved successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save settings',
            ], 422);
        }
    }

    public function create(Request $request)
    {
        try {
            $settings = SiteSettings::get_settings($request->get('category'));

            return response()->json([
                'success' => true,
                'data' => $settings,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
