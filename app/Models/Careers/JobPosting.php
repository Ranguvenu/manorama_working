<?php

namespace App\Models\Careers;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobPosting extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'title',
        'subject',
        'category_id',
        'publish_from',
        'description',
        'tags',
        'open',
        'created_by',
        'updated_by',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = auth()->user()->id;
            }

            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }

            if (!$model->isDirty('slug')) {
                $model->slug = strtolower(str_replace(' ', '-', $model->title));
            }
        });

        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }

            if (!$model->isDirty('slug')) {
                $model->slug = strtolower(str_replace(' ', '-', $model->title));
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
        $namespace = 'App\Utilities\Careers\JobPosting';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function scopeActive($query)
    {
        return $query->whereDate('publish_from', '<=', now())->where('open', 1);
    }

    public function has_current_user_application()
    {
        $user = \Auth::user() ? \Auth::user()->id : 0;

        return $this->applications()->where('user_id', $user)->exists();
    }

    public function application_status()
    {
        $user = \Auth::user() ? \Auth::user()->id : 0;

        return $this->applications()->submitted()->where('user_id', $user)->exists();
    }

    public function current_user_application_submitted()
    {
        $user = \Auth::user() ? \Auth::user()->id : 0;

        return $this->applications()->submitted()->where('user_id', $user)->exists();
    }

    public function current_user_application_saved()
    {
        $user = \Auth::user() ? \Auth::user()->id : 0;

        return $this->applications()->saved()->where('user_id', $user)->exists();
    }

    public function current_user_application()
    {
        $user = \Auth::user() ? \Auth::user()->id : 0;

        return $this->applications()->with('assignments')->where('user_id', $user)->first();
    }

    public function user_created()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function user_updated()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

    public function job_posting_assignments()
    {
        return $this->hasMany('App\Models\Careers\JobPostingAssignment', 'job_posting_id', 'id');
    }

    public function applications()
    {
        return $this->hasMany('App\Models\Careers\JobApplication', 'job_posting_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\MasterData\Category', 'category_id', 'id');
    }

    public function getAllTagsAttribute()
    {
        return explode(',', $this->attributes['tags']);
    }
}
