<?php

namespace App\Models\Notifications;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class EmailNotification extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'channel',
        'to_email',
        'subject',
        'message',
        'module',
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
        $namespace = 'App\Utilities\Notifications\EmailNotifications';
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
        return $this->belongsTo('App\Models\Notifications\Templates\EmailTemplate', 'template_id', 'id');
    }

    public function email_logs()
    {
        return $this->hasMany('App\Models\Notifications\EmailNotificationLog', 'email_notification_id', 'id');
    }

    public function latest_email_log()
    {
        return $this->hasOne('App\Models\Notifications\EmailNotificationLog', 'email_notification_id', 'id')->latestOfMany();
    }

    public function getChannelNameAttribute()
    {
        // $channel = 'NA';
        // switch ($this->attributes['channel']) {
        //     case 'App\Channels\Notifications\SMS\SMSCountryChannel':
        //         $channel = 'SMS Country';
        //         break;
        //     case 'App\Channels\Notifications\SMS\SinchChannel':
        //         $channel = 'Sinch';
        //         break;
        //     default:
        // }

        // return $channel;
    }
}
