<?php

namespace App\Models\Careers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobPostingAssignment extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'job_posting_id',
        'title',
        'description',
        'meta',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('careers');
    }

    public function job_postings()
    {
        return $this->belongsToMany('App\Models\Careers\JobPosting', 'job_posting_id', 'id');
    }

    public function setMetaAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['meta'] = serialize($value);
        } else {
            $this->attributes['meta'] = $value;
        }
    }

    public function getMetaAttribute()
    {
        return is_data_serialized($this->attributes['meta']) ? unserialize($this->attributes['meta']) : $this->attributes['meta'];
    }
}
