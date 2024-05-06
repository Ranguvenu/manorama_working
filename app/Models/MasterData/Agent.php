<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\BuilderContract;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Agent extends Model
{
    use HasFactory;
    use LogsActivity;
    
    protected $table = 'field_agents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'location',
        'locality',
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
        $namespace = 'App\Utilities\MasterData\Agents';
        $filter = new BuilderContract($query, $filters, $namespace);
        return $filter->apply();
    }

}
