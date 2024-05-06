<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class NotificationType extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'variables',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('notifications');
    }

    public function setVariablesAttribute($value)
    {
        $this->attributes['variables'] = serialize($value);
    }

    public function getVariablesAttribute()
    {
        return unserialize($this->attributes['variables']);
    }

    public function notification_settings()
    {
        return $this->hasMany('App\Models\Notifications\NotificationSettings', 'notification_type_id', 'id');
    }

    public function email_settings()
    {
        return $this->notification_settings->where('method', 'email')->first();
    }

    public function sms_settings()
    {
        return $this->notification_settings->where('method', 'sms')->first();
    }

    public function email_templates()
    {
        return $this->hasMany('App\Models\Notifications\Templates\EmailTemplate', 'notification_type_id', 'id');
    }

    public function sms_templates()
    {
        return $this->hasMany('App\Models\Notifications\Templates\SmsTemplate', 'notification_type_id', 'id');
    }
}
