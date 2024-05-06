<?php

namespace App\Models\Notifications\Templates;

use App\Contracts\BuilderContract;
use App\Traits\TemplatesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SmsTemplate extends Model
{
    use HasFactory;
    use TemplatesTrait;
    use LogsActivity;

    protected $fillable = [
        'notification_type_id',
        'title',
        'content',
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
        $namespace = 'App\Utilities\Notifications\Templates\SMS';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function notification_type()
    {
        return $this->belongsTo('App\Models\Notifications\NotificationType', 'notification_type_id', 'id');
    }

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = strip_tags($value);
    }

    public function logs() 
    { 
        return $this->hasMany('App\Models\Notifications\SmsNotification', 'template_id', 'id'); 
    }
}
