<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'name' => $this->firstname.' '.$this->lastname,
            'address' => $this->address,
            'address2' => $this->address2,
            'email' => $this->email,
            'phone' => $this->phone,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'country' => $this->country,
            'state' => $this->state,
            'country_name' => $this->country_name,
            'state_name' => $this->state_name,
            'city' => $this->city,
            'dob' => $this->dob ? get_date($this->dob, 'd M Y') : '--',
            'avatar' => $this->profile ? $this->profile->url : '',
            'orders' => $this->orders->map(function($order) {
                $pricings = $order->package_pricing ? $order->package_pricing->courses : [];
                $courses = [];
                if($pricings){
                    $courses = $pricings->map(function($course) {
                        return $course->course->title;
                    })->toArray();
                }
                return [
                    'id' => $order->id,
                    'order_key' => $order->order_key,
                    'package_name' => $order->package ? $order->package->title : 'NA',
                    'courses' => implode(", ", $courses),
                    'order_amount' => $order->order_amount,
                    'transaction_id' => $order->transaction_id,
                    'status_name' => $order->status_name,
                    'created_at' => get_date($order->created_at, 'd M Y')
                ];
            }),
            'completed' => $this->profilepercentage() ? $this->profilepercentage() : '',
            'created_at' => get_date($this->created_at, 'd M Y'),
            'updated_at' => get_date($this->updated_at, 'd M Y'),
        ];
    }
}
