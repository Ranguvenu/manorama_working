<?php

namespace App\Models\Blog;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Article extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'title',
        'description',
        'image_id',
        'category',
        'video_id',
        'thumbnail_id',
        'short_description',
        'author_id',
        'is_published',
        'order',
        'published_on',
        'labels',
        'slug',
        'tags',
        'seo_configuration',
        'blog_type_id',
        'created_by_id',
        'updated_by_id',
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

            if (!$model->isDirty('slug')) {
                $slug = Str::slug($model->title);
                $count = self::where('slug', $slug)->count();
                if ($count > 0) {
                    $slug .= '-'.($count + 1);
                }
                $model->slug = $slug;
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
            ->useLogName('blog');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Blog\Article';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', 1)->where('published_on', '<=', strtotime(now()));
    }

    public function scopeActive($query)
    {
        return $query->where('is_published', 1);
    }

    public function setPublishedOnAttribute($value)
    {
        $this->attributes['published_on'] = strtotime($value);
    }

    public function getPublishedOnAttribute()
    {
        return $this->attributes['published_on'] ? date('Y-m-d',$this->attributes['published_on']) : 'NA';
    }

    public function user_created()
    {
        return $this->belongsTo('App\Models\User', 'created_by_id', 'id');
    }

    public function user_updated()
    {
        return $this->belongsTo('App\Models\User', 'updated_by_id', 'id');
    }

    public function video()
    {
        return $this->belongsTo('App\Models\Modules\Media', 'video_id', 'id');
    }

    public function image()
    {
        return $this->belongsTo('App\Models\Modules\Media', 'image_id', 'id');
    }

    public function thumbnail()
    {
        return $this->belongsTo('App\Models\Modules\Media', 'thumbnail_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\Blog\Author', 'author_id', 'id');
    }

    public function blog_type()
    {
        return $this->belongsTo('App\Models\MasterData\Category', 'blog_type_id', 'id');
    }

    public function setCategoryAttribute($value)
    {
        $this->attributes['category'] = implode(',', $value);
    }

    public function getCategoryAttribute()
    {
        return array_map('intval', explode(',', $this->attributes['category']));
    }

    public function setSeoConfigurationAttribute($value)
    {
        $this->attributes['seo_configuration'] = serialize($value);
    }

    public function getSeoConfigurationAttribute()
    {
        return unserialize($this->attributes['seo_configuration']);
    }
}
