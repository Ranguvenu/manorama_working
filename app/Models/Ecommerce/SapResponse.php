<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SapResponse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sap_controller_id',
        'response',
        'payload',
        'sap_status',
        'response_status',
    ];

    public function controller()
    {
        return $this->belongsTo('App\Models\Ecommerce\SapController', 'sap_controller_id', 'id');
    }
}
