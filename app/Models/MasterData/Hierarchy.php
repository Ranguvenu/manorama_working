<?php

namespace App\Models\MasterData;

use App\Contracts\BuilderContract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Hierarchy extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'type_id',
        'title',
        'code',
        'description',
        'parent_id',
        'depth',
        'path',
        'mdl_id',
        'image',
        'tags',
        'old_id',
        'is_active'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('path')) {
                $slug = Str::slug($model->title);
                $count = self::where('path', $slug)->count();
                if ($count > 0) {
                    $slug .= '-'.($count + 1);
                }
                $model->path = $slug;
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('masterdata');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\MasterData\Hierarchy';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function scopeonlyGoals($query)
    {
        return $query->where('type_id', 1);
    }

    public function scopeonlyCourses($query)
    {
        return $query->where('type_id', 4);
    }

    public function boards()
    {
        return $this->hasMany('App\Models\MasterData\Hierarchy', 'parent_id', 'id')->where('depth', 1);
    }

    public function classes()
    {
        return $this->hasMany('App\Models\MasterData\Hierarchy', 'parent_id', 'id')->where('depth', 2);
    }

    public function subjects()
    {
        return $this->hasMany('App\Models\MasterData\Hierarchy', 'parent_id', 'id')->where('depth', 3)->where('type_id', 4);
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\MasterData\Hierarchy', 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\MasterData\Hierarchy', 'parent_id', 'id');
    }

    public function getTypeNameAttribute()
    {
        $types = $this->types();

        return isset($types[$this->attributes['type_id']]) ? $types[$this->attributes['type_id']] : '';
    }

    public function types()
    {
        return [
            'INVALID',
            'Goal',
            'Board',
            'Class',
            'Course',
        ];
    }

    public function cloned_courses()
    {
        return $this->hasMany('App\Models\Content\Courses', 'parent_mdl_id', 'mdl_id');
    }

    public function batches()
    {
        return $this->hasMany('App\Models\Ecommerce\Batches', 'hierarchy_id', 'id');
    }

    public function activeBatches()
    {
        $today = Carbon::now();
        $batches = $this->batches()
                    ->whereDate('enrollment_start_date', '<=', $today)
                    ->whereDate('enrollment_end_date', '>=', $today)
                    ->withCount('enrollments')
                    ->having('enrollments_count', '<', \DB::raw('batches.student_limit'))
                    ->orderBy('enrollment_start_date', 'asc')
                    ->where('is_active', 1)->get();

        return $batches;
    }

    public function activeBatchesInPackage($package)
    {
        $today = Carbon::now();
        $batches = $this->batches()
                    ->where('package_id', $package)
                    ->whereDate('enrollment_start_date', '<=', $today)
                    ->whereDate('enrollment_end_date', '>=', $today)
                    ->withCount('enrollments')
                    ->having('enrollments_count', '<', \DB::raw('batches.student_limit'))
                    ->orderBy('enrollment_start_date', 'asc')
                    ->where('is_active', 1)->get();

        return $batches;
    }

    public function packagecourses()
    {
        return $this->hasMany('App\Models\Ecommerce\PackageHasCourses', 'course_id', 'id');
    }
}
