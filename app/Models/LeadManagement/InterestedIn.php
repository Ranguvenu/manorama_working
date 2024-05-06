<?php

namespace App\Models\LeadManagement;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class InterestedIn extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'interested_in';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'old_id',
        'lead_id',
        'product_id',
        'source_id',
        'status',
        'tags',
        'received_from',
        'category_id',
        'meta',
        'created_by_id',
        'updated_by_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->isDirty('created_by_id')) {
                $model->created_by_id = auth()->user() ? auth()->user()->id : 1;
            }

            if (!$model->isDirty('updated_by_id')) {
                $model->updated_by_id = auth()->user() ? auth()->user()->id : 1;
            }
        });

        static::updating(function ($model) {
            if (!$model->isDirty('updated_by_id')) {
                $model->updated_by_id = auth()->user() ? auth()->user()->id : 1;
            }
        });
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

    public function scopewithRestrictions($query)
    {
        $user = \Auth::user();
        if ($user->hasPermissionTo('view-assigned-leads')) {
            $query->whereHas('assignment', function ($q) use ($user) {
                $q->where('assigned_to_id', $user->id);
            });
        }
    }

    /**
     * Get the lead information.
     *
     * @return \App\Models\LeadManagement\Lead
     */
    public function leads()
    {
        return $this->belongsTo('App\Models\LeadManagement\Lead', 'lead_id', 'id');
    }

    /**
     * Get the source in which the lead is interested in.
     *
     * @return \App\Models\LeadManagement\LeadSource
     */
    public function source()
    {
        return $this->belongsTo('App\Models\MasterData\Category', 'source_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\MasterData\Category', 'category_id', 'id');
    }

    public function statuses()
    {
        return ['Received', 'Disqualified', 'Assigned','Pending','Subscribed'];
    }

    public function getStatusNameAttribute()
    {
        return isset($this->statuses()[$this->attributes['status']]) ? $this->statuses()[$this->attributes['status']] : 'NA';
    }

    public function assignment()
    {
        return $this->hasOne('App\Models\LeadManagement\LeadAssignment', 'interested_in_id', 'id');
    }

    public function responses()
    {
        return $this->hasMany('App\Models\LeadManagement\LeadUserResponse', 'interested_in_id', 'id')->latest();
    }

    public function callhistory()
    {
        return $this->hasMany('App\Models\LeadManagement\LeadUserResponse', 'interested_in_id', 'id')->where('captured_from', 1)->latest();
    }

    public function comments()
    {
        return $this->hasMany('App\Models\LeadManagement\LeadUserResponse', 'interested_in_id', 'id')->where('captured_from', 0)->latest();
    }

    public function getLastHandledAttribute()
    {
        $lastresponse = $this->responses()->latest()->first();

        return $lastresponse->agent ? $lastresponse->agent->name : 'NA';
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Ecommerce\Packages', 'product_id', 'id');
    }

    public function promocodes()
    {
        return $this->hasMany('App\Models\LeadManagement\PromoCode', 'interested_in_id', 'id');
    }

    public function setMetaAttribute($value)
    {
        $this->attributes['meta'] = serialize($value);
    }

    public function getMetaAttribute()
    {
        return is_data_serialized($this->attributes['meta']) ? unserialize($this->attributes['meta']) : $this->attributes['meta'];
    }
}
