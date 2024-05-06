<?php

namespace App\Services\PageComponents;

use App\Models\MasterData\Category;
use App\Models\MasterData\Taxonomy;
use Illuminate\Http\Request;

class FaqsComponent
{
    public function index(Request $request)
    {
        $categories = $request->get('categories');

        $response = collect($categories)->map(function ($data) {
            $category = Category::find($data);

            return [
                'category' => $category->name,
                'questions' => $category->faqs,
            ];
        });

        return response()->json([
            'data' => $response,
        ], 200);
    }

    public function create(Request $request)
    {
        $taxonomy = Taxonomy::find('faq_category');

        return response()->json([
            'categories' => $taxonomy->categories,
        ], 200);
    }
}
