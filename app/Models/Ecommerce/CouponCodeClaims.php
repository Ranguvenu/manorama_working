<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CouponCodeClaims extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'coupon_code_id',
        'order_id',
        'coupon_amount',
        'used_by_id',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('used_by_id')) {
                $model->used_by_id = auth()->user() ? auth()->user()->id : 1;
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('ecommerce');
    }

    public function coupon_code()
    {
        return $this->belongsTo('App\Models\Ecommerce\Coupons', 'coupon_code_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo("App\Models\Ecommerce\Order", 'order_id', 'id');
    }

    public function used_by()
    {
        return $this->belongsTo('App\Models\User', 'used_by_id', 'id');
    }
}
