<?php

namespace App\Models\Website\PageBuilder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PageComponents extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'page_id',
        'page_component_type_id',
        'order',
        'visible',
        'configuration',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('page_builder');
    }

    public function setConfigurationAttribute($value)
    {
        $this->attributes['configuration'] = serialize($value);
    }

    public function getConfigurationAttribute()
    {
        return unserialize($this->attributes['configuration']);
    }

    public function page()
    {
        return $this->belongsTo('App\Models\Website\PageBuilder\Page', 'page_id', 'id');
    }

    public function component_type()
    {
        return $this->belongsTo('App\Models\Website\PageBuilder\PageComponentType', 'page_component_type_id', 'id');
    }
}
