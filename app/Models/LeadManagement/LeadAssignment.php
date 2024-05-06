<?php

namespace App\Models\LeadManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class LeadAssignment extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'interested_in_id',
        'assigned_to_id',
        'assigned_by_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('assigned_by_id')) {
                $model->assigned_by_id = auth()->user() ? auth()->user()->id : 1;
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('lead_management');
    }

    /**
     * Get the user information.
     *
     * @return \App\Models\User
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'assigned_to_id', 'id');
    }

    /**
     * Get the user who assigned particular lead.
     *
     * @return \App\Models\User
     */
    public function assign()
    {
        return $this->belongsTo('App\Models\User', 'assigned_by_id', 'id');
    }

    public function interests()
    {
        return $this->belongsTo('App\Models\LeadManagement\InterestedIn', 'interested_in_id', 'id');
    }
}
