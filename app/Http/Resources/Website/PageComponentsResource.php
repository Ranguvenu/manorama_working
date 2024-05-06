<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageComponentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id'            => $this->id,
            'configuration' => $this->configuration,
            'component'     => $this->component_type->slug,
            'visible'       => $this->visible,
            'name'          => $this->component_type->name
        ];
    }
}
