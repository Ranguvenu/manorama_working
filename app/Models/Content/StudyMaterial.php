<?php

namespace App\Models\Content;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class StudyMaterial extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'goal_id',
        'board_id',
        'class_id',
        'subject_id',
        'chapter_id',
        'slug',
        'thumbnail_id',
        'title',
        'description',
        'published_on',
        'status',
        'author_id',
        'seo_configuration',
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
            ->useLogName('content');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Content\StudyMaterials';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function setSeoConfigurationAttribute($value)
    {
        $this->attributes['seo_configuration'] = serialize($value);
    }

    public function getSeoConfigurationAttribute()
    {
        return unserialize($this->attributes['seo_configuration']);
    }

    // public function setPublishedOnAttribute($value)
    // {
    //     $this->attributes['published_on'] = strtotime($value);
    // }

    public function getPublishedOnAttribute()
    {
        return $this->attributes['published_on'] ? get_date($this->attributes['published_on'], 'Y-m-d') : 'NA';
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1)->where('published_on', '<=', now());
    }

    public function board()
    {
        return $this->belongsTo('App\Models\MasterData\Hierarchy', 'board_id', 'id');
    }

    public function classes()
    {
        return $this->belongsTo('App\Models\MasterData\Hierarchy', 'class_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\MasterData\Hierarchy', 'subject_id', 'id');
    }

    public function thumbnail()
    {
        return $this->belongsTo('App\Models\Modules\Media', 'thumbnail_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\Blog\Author', 'author_id', 'id');
    }
}
