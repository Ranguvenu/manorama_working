<?php

namespace App\Http\Resources\Modules;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuruvandanamResource extends JsonResource
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
            'name'          => $this->name,
            'email'          => $this->email,
            'phone'           => $this->phone,
            'school'        =>  $this->school,
            'district'    => $this->district,
            'locality'          => $this->locality,
            'pincode'         => $this->pincode,
            'video'       => $this->video,
            'certificate'       => $this->certificate,
            'username'   =>     $this->user->name,            
        ];
    }
}
