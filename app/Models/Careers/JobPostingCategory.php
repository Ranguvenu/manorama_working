<?php

namespace App\Models\Careers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobPostingCategory extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'job_posting_id',
        'category_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('careers');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\MasterData\Category', 'category_id', 'id');
    }

    public function job_postings()
    {
        return $this->belongsTo('App\Models\Careers\JobPosting', 'job_posting_id', 'id');
    }
}
