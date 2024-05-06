<?php

namespace App\Http\Resources\Blog;

use App\Models\MasterData\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticlesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'is_published' => $this->is_published,
            'categories' => collect($this->category)->map(function ($id) {
                $category = Category::find($id);

                return $category ? $category->name : '';
            }),
        ];
    }
}
