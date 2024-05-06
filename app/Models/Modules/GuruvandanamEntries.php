<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\BuilderContract;

class GuruvandanamEntries extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'country_code',
        'phone',
        'school',
        'district',
        'locality',
        'pincode',
        'video',
        'certificate',
        'user_id'
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('user_id')) {
                $model->user_id = auth()->user()->id;
            }
        });
    }
    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\Modules\Guruvandanam';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function getPhoneAttribute()
    {
        return $this->attributes['country_code'].$this->attributes['phone'];
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }


}
