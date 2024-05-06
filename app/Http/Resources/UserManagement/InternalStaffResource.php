<?php

namespace App\Http\Resources\UserManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InternalStaffResource extends JsonResource
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
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'email' => $this->email,
            'is_subscriber' => $this->is_purchased_user(),
            'roles' => !empty($this->roles) ? implode(',', $this->getRoleFullNames()->toArray()) : '-',
            'is_deleted' => $this->is_deleted
        ];
    }
}
