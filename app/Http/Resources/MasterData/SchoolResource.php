<?php

namespace App\Http\Resources\MasterData;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchoolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'         => $this->name,
            'code'          => $this->code,
            'location'      => $this->location,
            'district'     => $this->district,
            'state'        => $this->state,
            'country'      => $this->country,
            'address'      => $this->address,
            'contact_details' => $this->contact_details,
            'is_published' => ($this->is_published == 1) ? 'Active' : 'Inactive' , 
        ];
    }
}
