<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class EnrollmentHasCourses extends Model
{
    use HasFactory;
    use LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'enrollment_id',
        'batch_id',
        'hierarchy_id',
        'status',
        'mdl_response',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('content');
    }

    public function batch()
    {
        return $this->belongsTo('App\Models\Ecommerce\Batches', 'batch_id', 'id');
    }

    public function hierarchy()
    {
        return $this->belongsTo('App\Models\MasterCourse', 'hierarchy_id', 'id');
    }

    public function enrollment()
    {
        return $this->belongsTo('App\Models\Content\Enrollment', 'enrollment_id', 'id');
    }

    public function setMdlResponseAttribute($value)
    {
        $this->attributes['mdl_response'] = serialize($value);
    }

    public function getMdlResponseAttribute()
    {
        return unserialize($this->attributes['mdl_response']);
    }
}
