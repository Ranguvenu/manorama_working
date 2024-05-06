<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\BuilderContract;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class School extends Model
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
        'code',
        'location',
        'district',
        'state',
        'country',
        'address',
        'contact_details',
        'is_published',
        'created_by',
        'updated_by'
    ];

    protected static function boot(){
        parent::boot();
        static::creating(function($model) {
            if(!$model->isDirty('created_by')){
                $model->created_by = auth()->user()->id;
            }

            if(!$model->isDirty('updated_by')){
                $model->updated_by = auth()->user()->id;
            }
        });

        static::updating(function($model) {
            if(!$model->isDirty('updated_by')){
                $model->updated_by = auth()->user()->id;
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('masterdata');
    }

    public function scopeFilterBy($query, $filters){
        $namespace = 'App\Utilities\MasterData\Schools';
        $filter = new BuilderContract($query, $filters, $namespace);
        return $filter->apply();
    }

    public function user_created(){
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function user_updated(){
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }
}
