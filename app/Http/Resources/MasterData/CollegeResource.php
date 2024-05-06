<?php

namespace App\Http\Resources\MasterData;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollegeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                        => $this->id,
            'name'                      => $this->name,
            'address'                   => $this->address,
            'email'                     => $this->email,
            'website'                   => $this->website,
            'logo'                      => $this->logo ? asset($this->logo->url) : '',
            'brochure'                  => $this->brochure ? asset($this->brochure->url) : '',
            'application_form'          => $this->application_form ? asset($this->application_form->url) : '',
            'established_year'          => $this->established_year,
            'type'                      => $this->type,
            'country'                   => $this->country,
            'state'                     => $this->state,
            'district'                  => $this->district,
            'pincode'                   => $this->pincode,
            'contact_person'            => $this->contact_person,
            'phone'                     => $this->phone,
            'fax'                       => $this->fax,
            'student_intake'            => $this->student_intake,
            'nat_rank'                  => $this->nat_rank,
            'is_deemed'                 => $this->is_deemed,
            'name_of_principal'         => $this->name_of_principal,
            'contact_no_of_principal'   => $this->contact_no_of_principal,
            'email_of_principal'        => $this->email_of_principal,
            'admin'                     => $this->admin,
            'short_description'         => $this->short_description,
            'why_join'                  => $this->why_join,
            'high_light_text'           => $this->high_light_text,
            'similar_location'          => $this->similar_location,
            'similar_college'           => $this->similar_college,
            'facilities'                => $this->facilities,
        ];
    }
}
