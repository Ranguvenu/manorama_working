<?php

namespace App\Models\Careers;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobApplication extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'user_id',
        'job_posting_id',
        'resume',
        'status',
        'response',
        'qualification',
        'task',
        'video_link',
        'assignment_link',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('user_id')) {
                $model->user_id = auth()->user()->id;
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('careers');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Careers\JobApplication';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function scopeSubmitted($query)
    {
        return $query->where('status', '>=', 2);
    }

    public function scopeSaved($query)
    {
        return $query->where('status', 1);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function resume()
    {
        return $this->belongsTo('App\Models\Modules\Media', 'resume', 'id');
    }

    public function task()
    {
        return $this->belongsTo('App\Models\Modules\Media', 'task', 'id');
    }

    public function job()
    {
        return $this->belongsTo('App\Models\Careers\JobPosting', 'job_posting_id', 'id');
    }

    public function assignments()
    {
        return $this->hasMany('App\Models\Careers\JobApplicationAssignment', 'job_application_id', 'id')->with('posting_assignment');
    }

    public function statuses()
    {
        return [
            'No Application will have this status',
            'Saved',
            'Submitted',
            'Shortlisted',
            'Rejected',
        ];
    }

    public function getStatusNameAttribute()
    {
        $statuses = $this->statuses();

        return isset($statuses[$this->attributes['status']]) ? $statuses[$this->attributes['status']] : 'NA';
    }
}
