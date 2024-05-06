<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->user->email,
            'username' => $this->user->name,
            'fullname' => $this->user->fullname,
            'orderid' => $this->order_key,
            'mobilenumber' => $this->user->phone_number ? $this->user->phone_number : 0,
            'amount' => $this->order_amount,
            'created_at' => get_date($this->created_at, 'd M Y'),
            'status_name' => $this->status_name,
            'packagename'  =>$this->package_id != 0 ? $this->package->title : '---' ,
            'courses'    => $this->get_courses($this->package_pricing),
        ];
    }

    public function get_courses($pricing){
        $variant = $pricing ? $pricing->courses : [];
        $courses = [];
        if($variant){
            $courses = $variant->map(function($course){
                return $course->course ? $course->course->title : '';
            })->toArray();
        }
        return implode(",", $courses);
    }
}
