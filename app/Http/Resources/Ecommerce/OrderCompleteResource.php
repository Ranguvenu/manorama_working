<?php

namespace App\Http\Resources\Ecommerce;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderCompleteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'reference_key' => $this->reference_key,
            'transaction_id' => $this->transaction_id,
            'total_amount' => $this->order_amount,
            'net_payable' => $this->net_payable,
            'package' => $this->package ? $this->package->title : '',
            'subjects' => $this->package_pricing->courses->map(function ($subject) {
                return $subject->course ? $subject->course->title : '';
            }),
            'status_name' => $this->status_name,
            'status' => $this->status,
            'valid_till' => $this->enrollment ? get_date($this->enrollment->end_date, 'M d, Y, h:m A') : 0,
            'expires_on' => ($this->package && $this->package->is_trial_available) ? Carbon::now()->addDays($this->package->is_trial_available)->format('d M Y') : 0,
            'transaction_date' => $this->created_at->format('M d, Y, h:m A'),
        ];
    }
}
