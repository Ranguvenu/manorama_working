<?php

namespace App\Models\Careers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobApplicationAssignment extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'job_application_id',
        'assignment_id',
        'url',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('careers');
    }    

    public function posting_assignment(){
        return $this->belongsTo('App\Models\Careers\JobPostingAssignment', 'assignment_id', 'id');
    }
}
