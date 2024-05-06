<?php

namespace App\Models\Modules;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Media extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'url',
        'name',
        'size',
        'component',
        'uploaded_to',
        'type',
        'extension',
        'title',
        'alttext',
        'description',
        'caption',
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
        });

        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('modules');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Modules\Media';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function scopewithRestrictions($query)
    {
        $user = \Auth::user();
        if ($user->hasRole('subscriber')) {
            $query->where('created_by', $user->id);
        }
    }

    public function user_created()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function user_updated()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

    public function getMimeTypeAttribute()
    {
        return $this->attributes['type'];
    }

    public function getFileSizeAttribute()
    {
        return format_bytes($this->attributes['size']);
    }

    public function getMediaTypeAttribute()
    {
        $mimetype = $this->attributes['type'];
        if (in_array($mimetype, ['image/png', 'image/jpeg', 'image/jpg', 'image/webp', 'image/svg', 'image/svg+xml'])) {
            return 'images';
        } elseif (in_array($mimetype, ['application/pdf'])) {
            return 'pdfs';
        } elseif (in_array($mimetype, ['video/mp4'])) {
            return 'videos';
        } else {
            return 'default';
        }
    }
}
