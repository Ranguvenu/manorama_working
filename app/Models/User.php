<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country_code',
        'phone_number',
        'firstname',
        'lastname',
        'address',
        'address2',
        'country',
        'state',
        'city',
        'dob',
        'gender',
        'pincode',
        'profile_id',
        'user_type_id',
        'mdl_user',
        'last_login',
        'last_login_ip',
        'old_id',
        'is_deleted',
        'registration_mode',
        'is_profile_complete',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('user');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\UserManagement\Users';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }

    public function scopeActive($query)
    {
        return $query->where('is_deleted', 0);
    }

    public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function routeNotificationForSMS()
    {
        return str_replace('+', '', $this->phone);
    }

    public function code()
    {
        return $this->hasOne('App\Models\UserCode', 'user_id', 'id');
    }

    public function getPhoneAttribute()
    {
        return $this->attributes['country_code'].$this->attributes['phone_number'];
    }

    public function getRoleFullNames()
    {
        return $this->roles->pluck('fullname');
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = strtotime($value);
    }

    public function getDobAttribute()
    {
        return $this->attributes['dob'] != 0 ? date('Y-m-d', $this->attributes['dob']) : 0;
    }

    public function profile()
    {
        return $this->belongsTo('App\Models\Modules\Media', 'profile_id', 'id');
    }

    public function user_meta()
    {
        return $this->hasMany('App\Models\UserManagement\UserMeta', 'user_id', 'id');
    }

    public function user_type()
    {
        return $this->belongsTo('App\Models\MasterData\Category', 'user_type_id', 'id');
    }

    public function profilepercentage()
    {
        $attributes = collect($this->attributesToArray())->except(['id', 'email_verified_at', 'country_code', 'mdl_user', 'remember_token', 'created_at', 'updated_at'])->keys();
        $completed = $attributes->map(fn ($attribute) => $this->getAttribute($attribute))->filter();

        return round(($completed->count() / $attributes->count()) * 100, 2);
    }

    public function countries()
    {
        return $this->belongsTo('App\Models\MasterData\Country', 'country', 'id');
    }

    public function states()
    {
        return $this->belongsTo('App\Models\MasterData\State', 'state', 'id');
    }

    public function getCountryNameAttribute()
    {
        return $this->countries ? $this->countries->name : 'NA';
    }

    public function getStateNameAttribute()
    {
        return $this->states ? $this->states->name : 'NA';
    }

    public function claims()
    {
        return $this->hasMany('App\Models\Ecommerce\CouponCodeClaims', 'used_by_id', 'id')->where('status', 1);
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Ecommerce\Order', 'user_id', 'id')->latest();
    }

    public function is_purchased_user()
    {
        return $this->orders->where('status', 3)->first() ? true : false;
    }

    public function getVariablesAttribute()
    {
        return [
            'firstname' => $this->attributes['firstname'],
            'lastname' => $this->attributes['lastname'],
            'email' => $this->attributes['email'],
            'username' => $this->attributes['name'],
            'name' => $this->attributes['name'],
            'code' => $this->code ? $this->code->code : '',
            'sitename' => env('APP_NAME'),
            'role' => $this->getRoleNames(),
        ];
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['firstname'].' '.$this->attributes['lastname'];
    }

    public function lead_registrations()
    {
        return $this->hasOne('App\Models\LeadManagement\LeadRegistration', 'user_id', 'id');
    }
}
