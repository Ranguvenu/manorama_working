<?php

namespace App\Services\PageComponents;

use App\Http\Resources\Services\PageComponents\BlogsResource;
use App\Http\Resources\Services\PageComponents\WebinarsResource;
use App\Models\Content\Webinar;
use App\Models\MasterData\Category;
use App\Models\MasterData\Taxonomy;
use Illuminate\Http\Request;

class BlogsComponent
{
    public function index(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        if ($request->get('type') == 'webinar') {
            $webinars = Webinar::filterBy($request->all())->paginate($perpage);

            return WebinarsResource::collection($webinars);
        } else {
            $category = Category::where('slug', $request->get('type'))->first();
            $postings = $category->blogs()->published()->filterBy($request->all())->orderBy('published_on', 'DESC')->paginate($perpage);

            return BlogsResource::collection($postings);
        }
    }

    public function create(Request $request)
    {
        $slug = $request->get('type').'_category';
        $taxonomy = Taxonomy::find($slug);

        return response()->json([
            'categories' => $taxonomy->categories,
        ], 200);
    }
}
