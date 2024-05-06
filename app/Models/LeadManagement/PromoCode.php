<?php

namespace App\Models\LeadManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PromoCode extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'interested_in_id',
        'coupon_id',
        'code',
        'created_by_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('created_by_id')) {
                $model->created_by_id = auth()->user() ? auth()->user()->id : 1;
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('lead_management');
    }

    public function created_by()
    {
        return $this->belongsTo('App\Models\User', 'created_by_id', 'id');
    }
}
