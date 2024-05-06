<?php

namespace App\Models\MasterData;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name',
        'slug',
        'code',
        'taxonomy_slug',
        'editable',
        'meta',
        'created_by',
        'updated_by',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = auth()->user() ? auth()->user()->id : 1;
            }

            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user() ? auth()->user()->id : 1;
            }

            if (!$model->isDirty('slug')) {
                if (!$model->slug) {
                    $model->slug = strtolower(str_replace(' ', '-', $model->name));
                }
            }
        });

        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user() ? auth()->user()->id : 1;
            }

            if (!$model->isDirty('slug')) {
                if (!$model->slug) {
                    $model->slug = strtolower(str_replace(' ', '-', $model->name));
                }
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('masterdata');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\MasterData\Categories';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function setMetaAttribute($value)
    {
        $this->attributes['meta'] = serialize($value);
    }

    public function getMetaAttribute()
    {
        return unserialize($this->attributes['meta']);
    }

    public function user_created()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function user_updated()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

    public function taxonomy()
    {
        return $this->belongsTo('App\Models\MasterData\Taxonomy', 'taxonomy_slug', 'slug');
    }

    public function leads()
    {
        return $this->hasMany('App\Models\LeadManagement\InterestedIn', 'category_id', 'id');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User', 'user_type_id', 'id');
    }

    public function blogs()
    {
        return $this->hasMany('App\Models\Blog\Article', 'blog_type_id', 'id');
    }

    public function articles()
    {
        return $this->hasMany('App\Models\Blog\Article', 'blog_type_id', 'id');
    }

    public function faqs()
    {
        return $this->hasMany('App\Models\MasterData\Faq', 'category_id', 'id');
    }
}
