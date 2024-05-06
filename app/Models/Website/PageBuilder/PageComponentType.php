<?php

namespace App\Models\Website\PageBuilder;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PageComponentType extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'featured_image',
        'service',
        'order',
        'configuration',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('page_builder');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Website\PageComponentTypes';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function setConfigurationAttribute($value)
    {
        $this->attributes['configuration'] = serialize($value);
    }

    public function getConfigurationAttribute()
    {
        return unserialize($this->attributes['configuration']);
    }

    public function component_types()
    {
        return $this->hasMany('App\Models\Website\PageBuilder\PageComponents', 'page_component_type_id', 'id');
    }
}
