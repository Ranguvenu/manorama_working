<?php

namespace App\Models\LeadManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class LeadUserResponse extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'interested_in_id',
        'agent_id',
        'status',
        'response',
        'captured_from',
        'call_id',
        'callback',
        'callback_on',
        'old_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('agent_id')) {
                $model->agent_id = auth()->user() ? auth()->user()->id : 1;
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('lead_management');
    }

    public function getCallbackOnAttribute()
    {
        return $this->attributes['callback_on'] ? date('Y-m-d h:i a', $this->attributes['callback_on']) : 0;
    }

    public function agent()
    {
        return $this->belongsTo('App\Models\User', 'agent_id', 'id');
    }

    public function setCallbackOnAttribute($value)
    {
        $this->attributes['callback_on'] = strtotime($value);
    }

    public function interest()
    {
        return $this->belongsTo('App\Models\LeadManagement\InterestedIn', 'interested_in_id', 'id');
    }
}
