<?php

namespace App\Models\LeadManagement;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ContactUsRequest extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
            'name',
            'email',
            'country_code',
            'phone_number',
            'message',
        ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('lead_management');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\LeadManagement\ContactUsRequests';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }
}
