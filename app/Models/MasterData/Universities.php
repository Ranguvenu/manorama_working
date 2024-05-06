<?php

namespace App\Models\MasterData;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Universities extends Model
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
        'established_on',
        'address',
        'pincode',
        'location',
        'state',
        'country',
        'phone',
        'email',
        'fax',
        'website',
        'logo_id',
        'description',
        'is_published',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('masterdata');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\MasterData\Universities';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function user_created()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function user_updated()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

    public function setEstablishedOnAttribute($value)
    {
        $this->attributes['established_on'] = strtotime($value);
    }

    public function getEstablishedOnAttribute()
    {
        return $this->attributes['established_on'] ?  date('Y-m-d', $this->attributes['established_on']) : 'NA';
    }

    public function logo()
    {
        return $this->belongsTo('App\Models\Modules\Media', 'logo_id', 'id');
    }
}
