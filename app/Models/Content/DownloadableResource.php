<?php

namespace App\Models\Content;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class DownloadableResource extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'downloadable_resources';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'publish_from',
        'publish_to',
        'resource_type_id',
        'resource_id',
        'is_active',
        'old_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('content');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Content\DownloadableResources';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function setPublishedFromAttribute($value)
    {
        $this->attributes['publish_from'] = strtotime($value);
    }

    public function getPublishedFromAttribute()
    {
        return date('Y-m-d', $this->attributes['publish_from']);
    }

    public function setPublishedToAttribute($value)
    {
        $this->attributes['publish_to'] = strtotime($value);
    }

    public function getPublishedToAttribute()
    {
        return date('Y-m-d', $this->attributes['publish_to']);
    }

    // public function getDescriptionAttribute()
    // {
    //     return strip_tags($this->attributes['description']);
    // }

    public function scopeActive($query)
    {
        $today = now();

        return $query->where('is_active', 1)->where(function ($query) use ($today) {
            $query->whereDate('publish_from', '<=', $today)
            ->whereDate('publish_to', '>=', $today);
        });
    }

    public function file()
    {
        return $this->belongsTo('App\Models\Modules\Media', 'resource_id', 'id');
    }

    public function resource_type()
    {
        return $this->belongsTo('App\Models\MasterData\Category', 'resource_type_id', 'id');
    }
}
