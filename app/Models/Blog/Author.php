<?php

namespace App\Models\Blog;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Author extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'image',
        'bio',
        'student_editor',
        'user_id',
        'created_by_id',
        'updated_by_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('created_by_id')) {
                $model->created_by_id = auth()->user()->id;
            }

            if (!$model->isDirty('updated_by_id')) {
                $model->updated_by_id = auth()->user()->id;
            }
        });

        static::updating(function ($model) {
            if (!$model->isDirty('updated_by_id')) {
                $model->updated_by_id = auth()->user()->id;
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
        $namespace = 'App\Utilities\Blog\Author';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function user_created()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function user_updated()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

    public function author_profile()
    {
        return $this->belongsTo('App\Models\Modules\Media', 'image', 'id');
    }

    public function getProfileImageAttribute()
    {
        return $this->author_profile ? $this->author_profile->url : '';
    }
    public function articles()
    {
        return $this->belongsTo('App\Models\Blog\Article', 'id', 'author_id');

    }
    public function studymaterials()
    {
        return $this->belongsTo('App\Models\Content\StudyMaterial', 'id', 'author_id');

    }
}
