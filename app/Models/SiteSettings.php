<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SiteSettings extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category',
        'key',
        'value'
    ];

    protected static function boot(){
        parent::boot();
        static::creating(function ($model){
            if(auth()->user()){
                if(!$model->isDirty('created_by')){
                    $model->created_by = auth()->user()->id;
                }
                if(!$model->isDirty('updated_by')){
                    $model->updated_by = auth()->user()->id;
                }
            }else{
                $model->created_by = 1;
                $model->updated_by = 1;
            }
        });
        static::updating(function ($model){
            if(!$model->isDirty('updated_by')){
                if(auth()->user()){
                    $model->updated_by = auth()->user()->id;
                }else{
                    $model->updated_by = 1;
                }
            }
        });
        static::created(function($model) {
            cache()->flush();
        });
        static::updated(function($model) {
            cache()->flush();
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('site_settings');
    }

    public static function set_setting($category, $setting, $value){
        return self::updateOrCreate([
            'category'  => $category,
            'key'       => $setting
        ], ['value' => $value]);
    }

    public static function get_settings($category){
        return self::where('category', $category)->pluck('value', 'key');
    }

    public function setValueAttribute($value){
        if(is_array($value)){
            $this->attributes['value'] = serialize($value);
        }else{
            $this->attributes['value'] = $value;
        }
    }

    
    public function getValueAttribute(){
        return is_data_serialized($this->attributes['value']) ? unserialize($this->attributes['value']) : $this->attributes['value'];
    }
}
