<?php

namespace App\Services\PageComponents;

use App\Http\Resources\Services\PageComponents\BlogsResource;
use App\Http\Resources\Services\PageComponents\StudyMaterialsResource;
use App\Http\Resources\Services\PageComponents\WebinarsResource;
use App\Models\Content\StudyMaterial;
use App\Models\Content\Webinar;
use App\Models\MasterData\Category;
use Illuminate\Http\Request;

class FreeResources
{
    public function index(Request $request)
    {
        $count = $request->get('count') ? $request->get('count') : 4;
        $response = [];
        switch ($request->get('category')) {
            case 'article':
            case 'current-affair':
                $category = Category::where('slug', $request->get('category'))->first();
                $response = $category->blogs()->latest()->published()->take($count)->get();
                $response = BlogsResource::collection($response);
                break;
            case 'studymaterials':
                $response = StudyMaterial::latest()->take($count)->get();
                $response = StudyMaterialsResource::collection($response);
                break;
            case 'webinars':
                $response = Webinar::published()->latest()->take($count)->get();
                $response = WebinarsResource::collection($response);
                break;
            default:
        }

        return response()->json([
            'data' => $response,
        ], 200);
    }
}
