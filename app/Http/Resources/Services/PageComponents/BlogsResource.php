<?php

namespace App\Http\Resources\Services\PageComponents;

use App\Models\MasterData\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $categories = collect($this->category)->map(function ($id) {
            $category = Category::find($id);

            return $category ? $category->name : '';
        });

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'thumbnail' => $this->thumbnail ? $this->thumbnail->url : '/images/article/article1.png',
            'badge' => $categories ? $categories[0] : '',
            'created_on' => get_date($this->created_at, 'F d, Y'),
        ];
    }
}
