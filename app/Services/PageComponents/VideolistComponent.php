<?php

namespace App\Services\PageComponents;
use App\Http\Resources\Content\VideolistResource;
use App\Models\Content\Videolist;
use App\Models\MasterData\Taxonomy;
use Illuminate\Http\Request;

class VideolistComponent
{
    public function index(Request $request)
    {   
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
         $videolists = Videolist::filterBy($request->all())->paginate($perpage);
         return VideolistResource::collection($videolists);        
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
