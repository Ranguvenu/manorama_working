<?php

namespace App\Models\Notifications\Templates;

use App\Contracts\BuilderContract;
use App\Traits\TemplatesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class EmailTemplate extends Model
{
    use HasFactory;
    use TemplatesTrait;
    use LogsActivity;

    protected $fillable = [
        'notification_type_id',
        'title',
        'content',
        'subject',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('created_by_id')) {
                $model->created_by_id = auth()->user() ? auth()->user()->id : 1;
            }

            if (!$model->isDirty('updated_by_id')) {
                $model->updated_by_id = auth()->user() ? auth()->user()->id : 1;
            }
        });

        static::updating(function ($model) {
            if (!$model->isDirty('updated_by_id')) {
                $model->updated_by_id = auth()->user() ? auth()->user()->id : 1;
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('templates');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Notifications\Templates\Email';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function notification_type()
    {
        return $this->belongsTo('App\Models\Notifications\NotificationType', 'notification_type_id', 'id');
    }

    public function sms_setting()
    {
        return $this->hasOne('App\Models\Notifications\NotificationSettings', 'template_id', 'id')->where('method', 'sms');
    }

    public function email_setting()
    {
        return $this->hasOne('App\Models\Notifications\NotificationSettings', 'template_id', 'id')->where('method', 'email');
    }

    public function logs()
    {
        return $this->hasMany('App\Models\Notifications\EmailNotification', 'template_id', 'id');
    }
}
