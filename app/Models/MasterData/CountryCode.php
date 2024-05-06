<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\BuilderContract;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CountryCode extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'code',
        'name',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('masterdata');
    }

    public function scopeFilterBy($query, $filters){
        $namespace = 'App\Utilities\MasterData\CountryCode';
        $filter = new BuilderContract($query, $filters, $namespace);
        return $filter->apply();
    }
}



