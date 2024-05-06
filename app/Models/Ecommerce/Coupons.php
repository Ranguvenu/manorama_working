<?php

namespace App\Models\Ecommerce;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Coupons extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'package_id',
        'code',
        'discount_type',
        'discount_value',
        'valid_from',
        'valid_to',
        'coupon_usage_limit',
        'user_usage_limit',
        'created_by_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('created_by_id')) {
                $model->created_by_id = auth()->user()->id;
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('ecommerce');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Ecommerce\Coupons';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function setValidFromAttribute($value)
    {
        $this->attributes['valid_from'] = strtotime($value);
    }

    public function setValidToAttribute($value)
    {
        $this->attributes['valid_to'] = strtotime($value);
    }

    public function getValidFromAttribute($value)
    {
        return date('Y-m-d', $this->attributes['valid_from']);
    }

    public function getValidToAttribute($value)
    {
        return date('Y-m-d', $this->attributes['valid_to']);
    }

    public function claims()
    {
        return $this->hasMany('App\Models\Ecommerce\CouponCodeClaims', 'coupon_code_id', 'id')->where('status', 1);
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Ecommerce\Packages', 'package_id', 'id');
    }

    public function packages()
    {
        return $this->hasMany('App\Models\Ecommerce\CouponHasPackages', 'coupon_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('valid_to', '>=', strtotime(today()))->where('valid_from', '<=', strtotime(today()));
    }
}
