<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
//use Spatie\Activitylog\Traits\LogsActivity;

class Taxonomy extends Model
{
    use HasFactory;
    //use LogsActivity;

    protected $primaryKey = 'slug';
    
    public $incrementing = false;

    protected $fillable = [
        'name',
        'slug',
        'editable'
    ];

   // public function getActivitylogOptions(): LogOptions
   // {
   //     return LogOptions::defaults()
   //         ->logAll()
   //         ->useLogName('masterdata');
   // }

    public function categories(){
        return $this->hasMany('App\Models\MasterData\Category', 'taxonomy_slug', 'slug');
    }
}
