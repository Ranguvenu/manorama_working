<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SmsNotificationLog extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'sms_notification_id',
        'event',
        'generated_by_id',
        'logged_at',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('generated_by_id')) {
                $model->generated_by_id = auth()->user() ? auth()->user()->id : 1;
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('notifications');
    }

    public function sms_notification()
    {
        return $this->belongsTo('App\Models\Notifications\SmsNotification', 'sms_notification_id', 'id');
    }

    public function generated_by()
    {
        return $this->belongsTo('App\Models\User', 'generated_by_id', 'id');
    }
}
