<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\ProfileResource;
use App\Models\MasterData\Country;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index(User $user, Request $request)
    {
        return Inertia::render('Profile/index', ['data' => ProfileResource::make(Auth::user())]);
    }

    public function getstates(Country $country)
    {
        return $country->states;
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        $countries = Country::get();

        return response()->json([
            'data' => $request->user(),
            'countries' => $countries,
        ], 200);
    }

    /**
     * Update the user's profile information.
     */
    public function update(User $user, ProfileUpdateRequest $request)
    {
        try {
            $update = $user->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Updated User',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function complete(User $user, Request $request)
    {
        $request->validate([
            'gender' => 'required|integer|min:1',
            'dob' => 'required|date_format:Y-m-d',
        ]);

        $user->dob = $request->get('dob');
        $user->gender = $request->get('gender');
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile Updated Successfully',
        ], 200);
    }
}
