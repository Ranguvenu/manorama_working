<?php

namespace App\Models\Website\PageBuilder;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Page extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'page_type',
        'seo_configuration',
        'package_id',
        'description',
        'status',
        'configuration',
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
                $slug = Str::slug($model->title);
                $count = self::where('slug', $slug)->count();
                if ($count > 0) {
                    $slug .= '-'.($count + 1);
                }
                $model->slug = $slug;
            }
        });

        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user() ? auth()->user()->id : 1;
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('website');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Website\Pages';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function user_created()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function user_updated()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

    public function components()
    {
        return $this->hasMany('App\Models\Website\PageBuilder\PageComponents', 'page_id', 'id')->orderBy('order', 'DESC');
    }

    public function visible_components()
    {
        return $this->hasMany('App\Models\Website\PageBuilder\PageComponents', 'page_id', 'id')->where('visible', 1)->orderBy('order', 'DESC');
    }

    public function getStatusNameAttribute()
    {
        return isset($this->statuses()[$this->status]) ? $this->statuses()[$this->status] : '-';
    }

    public function setConfigurationAttribute($value)
    {
        $this->attributes['configuration'] = serialize($value);
    }

    public function getConfigurationAttribute()
    {
        return unserialize($this->attributes['configuration']);
    }

    public function setSeoConfigurationAttribute($value)
    {
        return $this->attributes['seo_configuration'] = serialize($value);
    }

    public function getSeoConfigurationAttribute()
    {
        return unserialize($this->attributes['seo_configuration']);
    }

    public function statuses()
    {
        return [
            'Draft',
            'Published',
            'Thrashed',
        ];
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Ecommerce\Packages', 'package_id', 'id');
    }

    // public function metas()
    // {
    //     return $this->hasMany('App\Models\Website\PageMeta', 'page_id', 'id');
    // }
}
