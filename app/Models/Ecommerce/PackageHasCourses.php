<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PackageHasCourses extends Model
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
        'course_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('ecommerce');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\MasterData\Hierarchy', 'course_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Ecommerce\Packages', 'package_id', 'id');
    }

    public function batches()
    {
        return $this->hasMany('App\Models\Ecommerce\Batches', 'package_id', 'package_id')->where('hierarchy_id', $this->course_id);
    }
}
