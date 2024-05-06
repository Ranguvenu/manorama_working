<?php

namespace App\Models\Notifications;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SmsNotification extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'message_id',
        'channel',
        'module',
        'message',
        'to_phone',
        'template_id',
        'notification_type_id',
        'to_user_id',
        'created_by_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('created_by_id')) {
                $model->created_by_id = auth()->user() ? auth()->user()->id : 1;
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('notifications');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Notifications\SmsNotifications';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function to_user()
    {
        return $this->belongsTo('App\Models\User', 'to_user_id', 'id');
    }

    public function created_by()
    {
        return $this->belongsTo('App\Models\User', 'created_by_id', 'id');
    }

    public function notification_type()
    {
        return $this->belongsTo('App\Models\Notifications\NotificationType', 'notification_type_id', 'id');
    }

    public function template()
    {
        return $this->belongsTo('App\Models\Notifications\Templates\SmsTemplate', 'template_id', 'id');
    }

    public function sms_logs()
    {
        return $this->hasMany('App\Models\Notifications\SmsNotificationLog', 'sms_notification_id', 'id');
    }

    public function latest_sms_log()
    {
        return $this->hasOne('App\Models\Notifications\SmsNotificationLog', 'sms_notification_id', 'id')->latestOfMany();
    }

    public function getChannelNameAttribute()
    {
        $channel = 'NA';
        switch ($this->attributes['channel']) {
            case 'App\Channels\Notifications\SMS\SMSCountryChannel':
                $channel = 'SMS Country';
                break;
            case 'App\Channels\Notifications\SMS\SinchChannel':
                $channel = 'Sinch';
                break;
            default:
        }

        return $channel;
    }
}
