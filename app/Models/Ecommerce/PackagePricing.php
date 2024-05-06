<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PackagePricing extends Model
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
        'actual_price',
        'selling_price',
        'sap_type_id',
        'sap_sub_type_id',
        'sap_ism_amount',
        'sap_ism_product_code',
        'old_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('ecommerce');
    }

    public function courses()
    {
        return $this->hasMany('App\Models\Ecommerce\PackagePricingHasCourses', 'package_pricing_id', 'id');
    }

    public function package()
    {
        // dd($this->belongsTo("App\Models\Ecommerce\Packages", 'package_id', 'id'));
        return $this->belongsTo("App\Models\Ecommerce\Packages", 'package_id', 'id');
    }

    public function getDiscountAttribute()
    {
        return $this->actual_price - $this->selling_price;
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Ecommerce\Order', 'package_pricing_id', 'id');
    }


    public function hasPurchasedThisVariation()
    {
        $user = auth()->user() ? auth()->user()->id : 0;
        if ($user) {
            $hasorder = $this->orders()-> where('status', 3)->where('user_id', $user)->first();

            return $hasorder ? true : false;
        }

        return false;
    }
    // public function scopehasPurchasedThisVariation($query)
    // {
    //     $user = auth()->user() ? auth()->user()->id : 0;
    //     if ($user) {
    //        return  $query->orders()-> where('status', 3)->where('user_id', $user)->first();

    //        }
    // }
}
