<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\Author\CreateRequest as CreateAuthorRequest;
use App\Http\Requests\Blog\Author\UpdateRequest as UpdateAuthorRequest;
use App\Http\Resources\Blog\AuthorResource;
use App\Models\Blog\Author;
use App\Models\Blog\Article;
use App\Models\Content\StudyMaterial;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-blog-author'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-blog-author'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-blog-author'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-blog-author'])->only('destroy');
    }

    public function index()
    {
        return Inertia::render('Blog/Author/index');
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $author = Author::filterBy($request->all())->paginate($perpage);

        return AuthorResource::collection($author);
    }

    public function store(CreateAuthorRequest $request)
    {
        try {
            $create = Author::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Created Author Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function edit(Author $author)
    {
        return response()->json([
            'data' => $author,
        ], 200);
    }

    public function update(Author $author, UpdateAuthorRequest $request)
    {
        try {
            $update = $author->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Updated Author Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(Author $author)
    {
        try {

            if ($author->articles || $author->studymaterials) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete author as he has some associated content',
                ], 422);
            }
            $delete = $author->delete();

            return response()->json([
            'success' => true,
            'message' => 'Deleted Author Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
            'success' => true,
            'message' => $e->getMessage(),
            ], 422);
        }
    }
    public function existingauthor(Author $author){          
        
        $existingarticleauthor = Article::where('author_id',$author->id)->get();   
        $studymaterialauthor =  StudyMaterial::where('author_id',$author->id)->get();       
        if(count($existingarticleauthor) == 0 ){    
            $existingauthor = [];
        } else if(count($studymaterialauthor) == 0 ){       
            $existingauthor = [];
        } else{     
            $existingauthor = Author::where('id',$author->id)->get();
        }
        return response()->json([
            'success' => true,
			'data'	=>  $existingauthor
        ],200);

    }
}
