<?php

namespace App\Models\Content;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Enrollment extends Model
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
        'package_pricing_id',
        'order_id',
        'user_id',
        'start_date',
        'end_date',
        'enrollment_type',
        'created_by_id',
        'updated_by_id',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('created_by_id')) {
                $model->created_by_id = auth()->user() ? auth()->user()->id : 1;
            }

            if (!$model->isDirty('updated_by_id')) {
                $model->updated_by_id = auth()->user() ? auth()->user()->id : 1;
            }
        });
        static::updating(function ($model) {
            if (!$model->isDirty('updated_by_id')) {
                $model->updated_by_id = auth()->user() ? auth()->user()->id : 1;
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('content');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Ecommerce\Enrollments';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function scopeSubscribed($query)
    {
        return $query->where('enrollment_type', 1);
    }

    public function scopeTrail($query)
    {
        return $query->where('enrollment_type', 2);
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Ecommerce\Order', 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Ecommerce\Packages', 'package_id', 'id');
    }

    public function courses()
    {
        return $this->hasMany('App\Models\Content\EnrollmentHasCourses', 'enrollment_id', 'id');
    }

    public function package_pricing()
    {
        return $this->belongsTo("App\Models\Ecommerce\PackagePricing", 'package_pricing_id', 'id');
    }

    public function enrollmenttypes()
    {
        return [
                'Pending',
                'Paid Enrollment',
                'Free Enrollment',
         ];
    }

    public function statuses()
    {
        return [
            'Pending',
            'Completed',
            'Verified',
            'Cancelled',
        ];
    }

    public function getStatusNameAttribute()
    {
        $statuses = $this->statuses();

        return isset($statuses[$this->attributes['status']]) ? $statuses[$this->attributes['status']] : 'NA';
    }

    public function getEnrollmentTypeNameAttribute()
    {
        $enrolmenttypes = $this->enrollmenttypes();

        return ($enrolmenttypes && isset($enrolmenttypes[$this->attributes['enrollment_type']])) ? $enrolmenttypes[$this->attributes['enrollment_type']] : 'NA';
    }
}
