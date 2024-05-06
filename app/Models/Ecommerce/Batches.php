<?php

namespace App\Models\Ecommerce;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Batches extends Model
{
    use HasFactory;
    use LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'package_id',
        'hierarchy_id',
        'course_id',
        'batch_start_date',
        'batch_end_date',
        'duration',
        'student_limit',
        'batch_provider_id',
        'enrollment_start_date',
        'enrollment_end_date',
        'is_active',
        'old_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('ecommerce');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Ecommerce\Batches';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    // public function courses()
    // {
    //     return $this->hasOne('App\Models\Ecommerce\BatchesHasCourses', 'batch_id', 'id');
    // }

    public function package()
    {
        return $this->belongsTo('App\Models\Ecommerce\Packages', 'package_id', 'id');
    }

    public function hierarchy()
    {
        return $this->belongsTo("App\Models\MasterData\Hierarchy", 'hierarchy_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Content\Courses', 'course_id', 'id');
    }

    public function batch_provider()
    {
        return $this->belongsTo('App\Models\MasterData\Category', 'batch_provider_id', 'id');
    }

    public function enrollments()
    {
        return $this->hasMany('App\Models\Content\EnrollmentHasCourses', 'batch_id', 'id')->where('status', '!=', 0);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function getBatchStartDateAttribute()
    {
        return date('Y-m-d', strtotime($this->attributes['batch_start_date']));
    }

    public function getBatchEndDateAttribute()
    {
        return date('Y-m-d', strtotime($this->attributes['batch_end_date']));
    }

    public function getEnrollmentStartDateAttribute()
    {
        return date('Y-m-d', strtotime($this->attributes['enrollment_start_date']));
    }

    public function getEnrollmentEndDateAttribute()
    {
        return date('Y-m-d', strtotime($this->attributes['enrollment_end_date']));
    }
}
