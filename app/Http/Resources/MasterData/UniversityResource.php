<?php

namespace App\Http\Resources\MasterData;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UniversityResource extends JsonResource
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
            'established_on' => date('d M Y', strtotime($this->established_on)),
            'pincode'       => $this->pincode,
            'phone'         => $this->phone,
            'email'         => $this->email,
            'fax'           => $this->fax,
            'website'       => $this->website,
            'description'   => $this->description,
            'location'      => $this->location,
            'district'     => $this->district,
            'state'        => $this->state,
            'country'      => $this->country,
            'address'      => $this->address,
            'contact_details' => $this->contact_details,
            'logo' => $this->logo ? asset($this->logo->url) : '',
            'is_published' => ($this->is_published == 1) ? 'Yes' : 'No' , 
        ];
    }
}
