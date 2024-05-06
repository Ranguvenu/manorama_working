<?php

namespace App\Http\Resources\UserManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'name' => $this->name,
		    'fullname' => $this->fullname,
            'permissions' => PermissionResource::collection($this->whenLoaded('permissions')),
            'mdlrole' => ucfirst($this->mdlrole)
        ];
    }
}
