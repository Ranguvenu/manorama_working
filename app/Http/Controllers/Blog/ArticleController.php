<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\Article\CreateRequest as CreateArticleRequest;
use App\Http\Requests\Blog\Article\UpdateRequest as UpdateArticleRequest;
use App\Http\Resources\Blog\ArticleResource;
use App\Http\Resources\Blog\ArticlesResource;
use App\Meta;
use App\Models\Blog\Article;
use App\Models\Blog\Author;
use App\Models\MasterData\Category;
use App\Models\MasterData\Taxonomy;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-article'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-article'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-article'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-article'])->only('destroy');
    }

    public function index(Category $category)
    {
        $taxonomy = Taxonomy::findOrFail($category->slug.'_category');

        return Inertia::render('Blog/Article/index', [
            'type' => $category,
            'data' => [
                'authors' => Author::all(),
                'categories' => $taxonomy->categories,
            ],
        ]);
    }

    public function results(Category $category, Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $article = $category->blogs()->filterBy($request->all())->latest()->paginate($perpage);

        return ArticlesResource::collection($article);
    }

    public function show(Category $category, Article $article, Request $request)
    {
        if ($article && $article->seo_configuration) {
            foreach ($article->seo_configuration as $key => $value) {
                if (is_array($value)) {
                    $value = implode(',', $value);
                } else {
                    $value = $value;
                }
                Meta::addMeta($key, $value, $request->fullUrl());
            }
        }

        return Inertia::render('Blog/Article/view', [
            'article' => new ArticleResource($article),
            'type' => $category,
        ]);
    }

    public function create(Category $category)
    {
        $taxonomy = Taxonomy::findOrFail($category->slug.'_category');

        return response()->json([
            'authors' => Author::all(),
            'categories' => $taxonomy->categories,
        ], 200);
    }

    public function store(Category $category, CreateArticleRequest $request)
    {
        try {
            $create = $category->blogs()->create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Created Article Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function edit(Category $category, Article $article)
    {
        return response()->json([
          'data' => $article,
        ], 200);
    }

    public function update(Category $category, Article $article, UpdateArticleRequest $request)
    {
        try {
            $update = $article->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Updated Article Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(Category $category, Article $article)
    {
        try {
            $delete = $article->delete();

            return response()->json([
              'success' => true,
              'message' => 'Deleted Article Successfully',
             ], 200);
        } catch (Exception $e) {
            return response()->json([
              'success' => true,
              'message' => $e->getMessage(),
            ], 422);
        }
    }
}
