<?php

namespace App\Models\LeadManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class LeadRegistration extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lead_id',
        'user_id',
        'registered_by_id',
        'created_on',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('registered_by_id')) {
                $model->registered_by_id = 1;
            }

            if (!$model->isDirty('created_on')) {
                $model->created_on = \Carbon\Carbon::now();
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
     * Get the lead information.
     *
     * @return \App\Models\LeadManagement\Lead
     */
    public function lead()
    {
        return $this->belongsTo('App\Models\LeadManagement\Lead', 'lead_id', 'id');
    }

    /**
     * Get the user information.
     *
     * @return \App\Models\User
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * Get the user who registered particular lead.
     *
     * @return \App\Models\User
     */
    public function registered_by()
    {
        return $this->belongsTo('App\Models\User', 'registered_by_id', 'id');
    }
}
