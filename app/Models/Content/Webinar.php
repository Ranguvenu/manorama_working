<?php

namespace App\Models\Content;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Webinar extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'category_id',
        'thumbnail_id',
        'title',
        'description',
        'date_time',
        'about_presenter',
        'meeting_information',
        'recording_url',
        'status',
        'slug',
        'published_on',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('slug')) {
                $slug = Str::slug($model->title);
                $count = self::where('slug', $slug)->count();
                if ($count > 0) {
                    $slug .= '-'.($count + 1);
                }
                $model->slug = $slug;
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('content');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Content\Webinars';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function setDateTimeAttribute($value)
    {
        $this->attributes['date_time'] = strtotime($value);
    }

    public function getDateTimeAttribute()
    {
        return date('Y-m-d\TH:i', $this->attributes['date_time']);
    }

    public function setPublishedOnAttribute($value)
    {
        $this->attributes['published_on'] = strtotime($value);
    }

    public function getPublishedOnAttribute()
    {
        return date('Y-m-d', $this->attributes['published_on']);
    }

    public function getDescriptionAttribute()
    {
        return strip_tags($this->attributes['description']);
    }

    public function thumbnail()
    {
        return $this->belongsTo('App\Models\Modules\Media', 'thumbnail_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\MasterData\Category', 'category_id', 'id');
    }
}
