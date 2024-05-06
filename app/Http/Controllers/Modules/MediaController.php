<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modules\Media\CreateRequest as CreateMediaRequest;
use App\Http\Requests\Modules\Media\UpdateRequest as UpdateMediaRequest;
use App\Http\Resources\Modules\MediaResource;
use App\Models\Modules\Media;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perpage = $request->get('perpage') ? $request->get('perpage') : 100;
            $media = Media::filterBy($request->all())->withRestrictions()->latest()->paginate($perpage);

            return MediaResource::collection($media);
        } catch (Exception $e) {
            return false;
        }
    }

    public function create(Request $request)
    {
        $created = Media::select('created_at')->latest('created_at')->get()->groupBy(function ($item) {
            return $item->created_at->format('F Y');
        });

        $types = Media::select('type')->latest('created_at')->get()->groupBy(function ($item) {
            return $item->media_type;
        });

        $components = Media::select('component')->latest('created_at')->get()->groupBy(function ($item) {
            return $item->component;
        });

        try {
            return response()->json([
                'success' => true,
                'data' => [
                    'dates' => array_keys($created->toArray()),
                    'types' => array_keys($types->toArray()),
                    'components' => array_keys($components->toArray()),
                ],
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
            ], 422);
        }
    }

    public function store(CreateMediaRequest $request)
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

                return response()->json([
                    'success' => true,
                    'media' => new MediaResource($media),
                    'message' => 'File uploaded successfully',
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload file',
            ], 422);
        }
    }

    public function edit(Request $request)
    {
        try {
            if (is_array($request->get('ids'))) {
                $media = Media::whereIn($request->get('return_type'), $request->get('ids'));
                $response = MediaResource::collection($media);
            } else {
                if (is_int($request->get('ids'))) {
                    $media = Media::findOrfail($request->get('ids'));
                } else {
                    $media = Media::where($request->get('return_type'), $request->get('ids'))->first();
                }
                $response = new MediaResource($media);
            }

            return response()->json([
                'data' => $response,
            ], 200);
        } catch (Exception $e) {
        }
    }

    public function update(Media $media, UpdateMediaRequest $request)
    {
        try {
            $update = $media->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Data updated successfully',
                'data' => $update,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update media',
            ], 422);
        }
    }

    public function destroy(Media $media)
    {
        try {
            $service = new FileUploadService();
            $isdeleted = $service->delete($media->name);
            if ($isdeleted) {
                $media->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Media deleted successfully',
                    'data' => $isdeleted,
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete media',
                'data' => $isdeleted,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete media',
            ], 422);
        }
    }
}
