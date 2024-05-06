<?php

namespace App\Http\Resources\Blog;

use App\Models\MasterData\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'author' => $this->author,
            'author_image' => $this->author ? $this->author->profile_image : '',
            'banner_image' => $this->image ? $this->image->url : '/images/article/article1.png',
            'thumbnail' => $this->thumbnail ? $this->thumbnail->url : '/images/article/article1.png',
            'short_description' => $this->short_description,
            'description' => $this->description,
            'is_published' => $this->is_published,
            'published_on' => get_date($this->published_on, 'd M Y'),
            'categories' => collect($this->category)->map(function ($id) {
                $category = Category::find($id);
                return $category ? $category->name : '';
            }),
            'slug' => $this->slug,
        ];
    }
}
