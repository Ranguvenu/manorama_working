<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class NotificationSettings extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'method',
        'notification_type_id',
        'template_id',
        'recipient_type',
        'recipient',
        'from_address',
        'from_name',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('notifications');
    }

    public function email_template()
    {
        return $this->belongsTo('App\Models\Notifications\Templates\EmailTemplate', 'template_id', 'id');
    }

    public function sms_template()
    {
        return $this->belongsTo('App\Models\Notifications\Templates\SmsTemplate', 'template_id', 'id');
    }

    public function notification_type()
    {
        return $this->belongsTo('App\Models\Notifications\NotificationType', 'notification_type_id', 'id');
    }

    public function getTemplateNameAttribute()
    {
        $template = '';
        if ($this->attributes['method'] == 'sms') {
            $template = $this->sms_template;
        } elseif ($this->attributes['method'] == 'email') {
            $template = $this->email_template;
        }

        return $template ? $template->title : 'NA';
    }

    public function getTemplatesAttribute()
    {
        $templates = [];
        if ($this->attributes['method'] == 'sms') {
            $templates = $this->notification_type->sms_templates;
        } elseif ($this->attributes['method'] == 'email') {
            $templates = $this->notification_type->email_templates;
        }

        return $templates;
    }
}
