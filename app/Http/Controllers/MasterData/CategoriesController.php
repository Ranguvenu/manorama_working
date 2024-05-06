<?php

namespace App\Http\Controllers\MasterData;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\Categories\CreateRequest as CreateCategoryRequest;
use App\Http\Requests\MasterData\Categories\UpdateRequest as UpdateCategoryRequest;
use App\Models\MasterData\Category;
use App\Models\MasterData\Taxonomy;
use App\Http\Resources\MasterData\CategoryResource;
use App\Models\LeadManagement\InterestedIn;
use App\Models\Content\DownloadableResource;
use App\Models\Blog\Article;
use App\Models\Careers\JobPosting;
use App\Models\MasterData\Faq;
use App\Models\UserManagement\UserMeta;
use App\Services\Moodle\Sources as SourcesService;
use App\Models\Content\Videolist;

class CategoriesController extends Controller
{
    public $service;

    public function __construct(){
        $this->service = new SourcesService();
        $category = request()->route('taxonomy');
        $this->middleware(['role_or_permission:view-'.$category])->only('index', 'results');
        $this->middleware(['role_or_permission:create-'.$category])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-'.$category])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-'.$category])->only('destroy');
    }

    public function index(Taxonomy $taxonomy){
        if($taxonomy->editable){
            return Inertia::render('MasterData/Categories/index',['taxonomy' => $taxonomy]);
        }
        abort(404);
    }

    public function results(Taxonomy $taxonomy, Request $request){
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $categories = $taxonomy->categories()->filterBy($request->all())->latest()->paginate($perpage);
        return CategoryResource::collection($categories);
    }

    public function list(Taxonomy $taxonomy, Request $request){
        $categories = $taxonomy->categories()->filterBy($request->all())->get();
        return $categories;
    }

    public function create(Taxonomy $taxonomy, Request $request){
        $check_taxonomy = Taxonomy::where('name',$taxonomy)->first();
        if($check_taxonomy){
            return Inertia::render('MasterData/Categories/create',['taxonomy'=>$taxonomy,'edit'=>false]);
        }
        else {
            abort(404);
        }        
    }

    public function store(Taxonomy $taxonomy, CreateCategoryRequest $request){
        try{
            $create = $taxonomy->categories()->create($request->validated());

            if ($taxonomy->slug == 'question_source') {
                $this->service->create_sources($request->validated());
            }

            return response()->json([
                'success'   => true,
                'message'   => 'Created '.$taxonomy->singular.' successfully'
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'success'   => true,
                'message'   => $e->getMessage()
            ], 422); 
        }
    }

    public function edit(Taxonomy $taxonomy, Category $category){
        return response()->json([
			'data'	=> $category
        ],200);
    }

    public function update(Taxonomy $taxonomy, Category $category, UpdateCategoryRequest $request){
        try{
            $create = $category->update($request->validated());
            return response()->json([
                'success'   => true,
                'message'   => 'Updated '.$taxonomy->singular.' successfully'
            ], 200); 
        }catch(Exception $e){
            return response()->json([
                'success'   => true,
                'message'   => $e->getMessage()
            ], 422);
        }
    }

    public function destroy(Taxonomy $taxonomy, Category $category){
        try{
            $delete = $category->delete();
            return response()->json([
                'success'   => true,
                'message'   => 'Deleted '.$taxonomy->singular.' successfully'
            ], 200); 
        }catch(Exception $e){
            return response()->json([
                'success'   => true,
                'message'   => $e->getMessage()
            ], 422);
        }
    }
    public function existingcategory(Taxonomy $taxonomy,Category $category){       

        if($category->taxonomy_slug == 'lead_source'){
                $existingcategory =  InterestedIn::get()->where('source_id',$category->id);
        } else if($category->taxonomy_slug == 'resource_type'){
                $existingcategory =  DownloadableResource::get()->where('resource_type_id',$category->id);
        } else if($category->taxonomy_slug == 'article_category'){        
                $value = $category->id;       
                $existingcategory = Article::where(function ($query) use ($value) {
                    $query->whereRaw("FIND_IN_SET('$value', category) > 0");
                })->get();   
       } else if($category->taxonomy_slug == "current-affair_category"){
                $value = $category->id;       
                $existingcategory = Article::where(function ($query) use ($value) {
                    $query->whereRaw("FIND_IN_SET('$value', category) > 0");
                })->get();
       } else if ($category->taxonomy_slug == "job_category"){
                $existingcategory =  JobPosting::get()->where('category_id',$category->id);
       } else if ($category->taxonomy_slug == "faq_category"){
                $existingcategory =  Faq::get()->where('category_id',$category->id);
        } else if($category->taxonomy_slug == "question_source"){
                $sources = UserMeta ::where('key','sources')->pluck('value')->toArray();
                $sourcesarr = array_merge(...$sources);              
                if (is_array($sourcesarr) && in_array($category->id,$sourcesarr)) {
                        $existingcategory = $sourcesarr;             
                    } else{
                        $existingcategory = [];
                    }    
         } else if ($category->taxonomy_slug == "user_category"){
                $categories = UserMeta ::where('key','categories')->pluck('value')->toArray();
                $categoriesarr = array_merge(...$categories);    

            if (is_array($categoriesarr) && in_array($category->id, $categoriesarr)) {
                    $existingcategory = $categoriesarr;             
                } else{
                    $existingcategory = [];
                } 

            } else if($category->taxonomy_slug == 'video_category'){
                $existingcategory =  Videolist::get()->where('category_id',$category->id);
         
            }


        return response()->json([
            'success' => true,
			'data'	=>  $existingcategory
        ],200);
      
     
    }
}
