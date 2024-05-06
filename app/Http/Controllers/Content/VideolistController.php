<?php

namespace App\Http\Controllers\Content;
use App\Http\Controllers\Controller;
use App\Models\Content\Videolist;
use App\Models\MasterData\Taxonomy;
use Illuminate\Http\Request;
use App\Http\Resources\Content\VideolistResource;
use App\Http\Requests\Content\Videolist\CreateRequest as CreateVideolistRequest;
use App\Http\Requests\Content\Videolist\UpdateRequest as UpdateVideolistRequest;
use Inertia\Inertia;
class VideolistController extends Controller
{
    public function __construct(){
        $this->middleware(['role_or_permission:view-videolist'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-videolist'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-videolist'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-videolist'])->only('destroy');
    }

    public function index(){
        return Inertia::render('Content/Videolist/index');
    }
    public function results(Request $request){
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $videolists = Videolist::filterBy($request->all())->paginate($perpage);
        return VideolistResource::collection($videolists);

    }
    public function create(){
        $taxonomy = Taxonomy::findOrFail('video_category');
		return response()->json([
			'categories'	=> $taxonomy->categories	
		], 200);

    }
    public function store(CreateVideolistRequest $request){
        try {
            $data = $request->validated();      
            $create = Videolist::create($data);
            return response()->json([
                'success' => true, 
                'message' => 'Created Video List Successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => $e->getMessage(),
            ], 422);
        }
    }
    public function edit(Videolist $videolist){
        return response()->json([
			'data'	=> $videolist
        ],200); 

    }
    public function update(Videolist $videolist, UpdateVideolistRequest $request ){
        try{
            $data = $request->validated();           
			$update = $videolist->update($data);      
			return response()->json([
				'success'	=> true,
				'message'	=> 'Updated Video List  Successfully'
			], 200);
		}catch(Exception $e){
			return response()->json([
				'success'	=> true,
				'message'	=> $e->getMessage()
			], 422);
		}

    }
    public function destroy(Videolist $videolist){
        try {
            $delete = $videolist->delete();
            return response()->json([
                'success' => true,
                'message' => 'Deleted Video List  successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
        
    }
}
