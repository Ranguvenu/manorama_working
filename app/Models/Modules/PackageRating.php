<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PackageRating extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'package_id',
        'user_id',
        'rating',
        'review',
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
            if (!$model->isDirty('user_id')) {
                $model->user_id = auth()->user()->id;
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
            ->useLogName('modules');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Ecommerce\Packages', 'package_id', 'id');
    }
}
