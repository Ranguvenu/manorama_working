<?php

namespace App\Models\Ecommerce;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_key',
        'package_pricing_id',
        'package_id',
        'transaction_id',
        'gateway',
        'reference_key',
        'user_id',
        'agent_id',
        'order_amount',
        'discount_amount',
        'net_payable',
        'created_by_id',
        'status',
        'old_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('ecommerce');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('user_id')) {
                $model->user_id = auth()->user() ? auth()->user()->id : 1;
            }

            if (!$model->isDirty('created_by_id')) {
                $model->created_by_id = auth()->user() ? auth()->user()->id : 1;
            }
        });
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Ecommerce\Orders';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function notes()
    {
        return $this->hasMany('App\Models\Ecommerce\OrderNotes', 'order_id', 'id');
    }

    public function coupon_claim()
    {
        return $this->hasOne('App\Models\Ecommerce\CouponCodeClaims', 'order_id', 'id');
    }

    public function package_pricing()
    {
        return $this->belongsTo("App\Models\Ecommerce\PackagePricing", 'package_pricing_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Ecommerce\Packages', 'package_id', 'id');
    }

    public function getStatusNameAttribute()
    {
        $statuses = $this->statuses();

        return isset($statuses[$this->attributes['status']]) ? $statuses[$this->attributes['status']] : '';
    }

    public function statuses()
    {
        return [
            'Not Applicable',
            'Processing',
            'Cancelled',
            'Completed',
            'Pending Payment',
            'Payment Failed',
            'Free Trial',
        ];
    }

    public function enrollment()
    {
        return $this->hasOne('App\Models\Content\Enrollment', 'order_id', 'id');
    }

    public function agent()
    {
        return $this->belongsTo('App\Models\User', 'agent_id', 'id');
    }

    public function getVariablesAttribute()
    {
        return [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'firstname' => $this->user->firstname,
            'lastname' => $this->user->lastname,
            'package' => $this->package->title,
            'content' => $this->package->instructions,
        ];
    }

    public function sap_controller()
    {
        return $this->hasMany('App\Models\Ecommerce\SapController', 'order_id', 'id');
    }
}
