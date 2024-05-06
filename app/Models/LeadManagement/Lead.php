<?php

namespace App\Models\LeadManagement;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Lead extends Model
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
        'country_code',
        'phone_number',
        'email',
        'is_email_verified',
        'is_phone_verified',
    ];

    protected static function boot()
    {
        parent::boot();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('lead_management');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\LeadManagement\Leads';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function interests()
    {
        return $this->hasMany('App\Models\LeadManagement\InterestedIn', 'lead_id', 'id');
    }

    public function registrations()
    {
        return $this->hasOne('App\Models\LeadManagement\LeadRegistration', 'lead_id', 'id');
    }

    public function getIsRegisteredAttribute()
    {
        return $this->registrations ? $this->registrations->user_id : false;
    }

    public function user()
    {
        return $this->hasOneThrough('App\Models\User', 'App\Models\LeadManagement\LeadRegistration', 'lead_id', 'id', 'id', 'user_id');
    }

    public function getPhoneAttribute()
    {
        return "{$this->country_code} {$this->phone_number}";
    }

    public function getCallerAttribute()
    {
        return $this->phone_number;
    }
}
