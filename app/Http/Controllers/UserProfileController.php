<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests\UserProfileRequest;
use App\Http\Resources\Modules\MediaResource;
use App\Models\MasterData\Country;
use App\Models\User;
use App\Models\Modules\Media;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserProfileController extends Controller
{
    public function index(User $user, Request $request)
    {
        $data = Auth::user();
        $avatar = $data->profile ? $data->profile->url : '';

        return Inertia::render('UserProfile/index', ['data' => $data, 'avatar' => $avatar]);
    }

    public function edit(Request $request)
    {
        $countries = Country::get();

        return response()->json([
            'data' => $request->user(),
            'countries' => $countries,
        ], 200);
    }

    public function update(User $user, UserProfileRequest $request)
    {
        try {
            $update = $user->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully.',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function profileupdate(Request $request, User $user)
    {
        try {
            $service = new FileUploadService($request->get('component'));
            $file = $service->upload($request->file('file'));
            if ($file) {
                $media = Media::create([
                    'url' => $file['url'],
                    'name' => $file['name'],
                    'title' => $file['title'],
                    'component' => $request->get('component'),
                    'size' => $file['size'],
                    'type' => $file['type'],
                    'extension' => $file['extension'],
                ]);

                $profile_id = $media->id;

                $updateuser = User::find($user->id);
                $updateuser->profile_id = $profile_id;
                $updateuser->update();

                return response()->json([
                    'success' => true,
                    'media' => new MediaResource($media),
                    'message' => 'File uploaded successfully',
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
    
}
