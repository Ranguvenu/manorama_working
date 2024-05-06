<?php

namespace App\Models\LeadManagement;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class NewsletterSubscription extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'ip_address',
        'email',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('lead_management');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\LeadManagement\NewsletterSubscriptions';
        $filter = new BuilderContract($query, $filters, $namespace);

        return $filter->apply();
    }
}
