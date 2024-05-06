<?php

namespace App\Services\PageComponents;

use App\Http\Resources\Services\PageComponents\DownloadableResourcesResource;
use App\Models\Content\DownloadableResource;
use App\Models\MasterData\Category;
use App\Models\MasterData\Taxonomy;
use Illuminate\Http\Request;

class DownloadableResourceComponent
{
    public function index(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $postings = DownloadableResource::active()->filterBy($request->all())->paginate($perpage);

        return DownloadableResourcesResource::collection($postings);
    }

    public function create(Request $request)
    {
        $taxonomy = Taxonomy::find('resource_type');

        return response()->json([
            'categories' => $taxonomy->categories,
        ], 200);
    }

    public function download(Request $request)
    {
        $resource = DownloadableResource::find($request->get('resource'));
        if ($resource && $resource->file) {
            $user = \Auth::user();
            $source = Category::where('slug', 'downloadable_resources')->first();
            $taxonomy = Taxonomy::findOrFail('lead_category');
            $category = $taxonomy->categories->where('slug', 'marketing')->first();

            // return $user->lead_registrations->lead->interests;
            $interest = $user->lead_registrations->lead->interests()->create([
                'received_from' => $request->get('received_from'),
                'source_id' => $source ? $source->id : 0,
                'category_id' => $category->id,
                'product_id' => 0,
                'tags' => $resource->title,
            ]);

            return response()->json([
                'success' => true,
                'url' => $resource->file->url,
                'title' => $resource->title,
            ]);
        }
    }
}
