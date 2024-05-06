<?php

namespace App\Models\Ecommerce;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SapController extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'payload',
        'sap_type',
        'is_submitted',
        'last_submited_at',
        'status',
        'attempts',
        'is_edited',
        'updated_by_id',
    ];

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Ecommerce\SapController';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function sap_types()
    {
        return [
            'Not Applicable',
            'Order File',
            'Reconcilation File',
        ];
    }

    public function responses()
    {
        return $this->hasMany('App\Models\Ecommerce\SapResponse', 'sap_controller_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Ecommerce\Order', 'order_id', 'id');
    }

    public function getSapTypeNameAttribute()
    {
        $types = $this->sap_types();

        return isset($types[$this->attributes['sap_type']]) ? $types[$this->attributes['sap_type']] : '';
    }
}
