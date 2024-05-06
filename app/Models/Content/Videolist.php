<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\BuilderContract;

class Videolist extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'video',
        'thumbnail',
        'category_id',
        'published_from',
        'published_to',
        'created_by_id',
        'updated_by_id',
        'created_at',
        'updated_at'
      
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
    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Content\Videolist';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }


    public function setPublishedToAttribute($value)
    {
        $this->attributes['published_to'] = strtotime($value);
    }
    public function setPublishedFromAttribute($value)
    {
        $this->attributes['published_from'] = strtotime($value);
    }

    public function getPublishedFromAttribute($value)
    {
        return date('Y-m-d', $this->attributes['published_from']);
    }
    public function getPublishedToAttribute($value)
    {
        return date('Y-m-d', $this->attributes['published_to']);
    }

}
