<?php

namespace App\Models\MasterData;

use App\Contracts\BuilderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Testimonial extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'profile',
        'avatar_id',
        'name',
        'title',
        'testimonial_type',
        'testimonial',
        'product_id',
        'user_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('masterdata');
    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\MasterData\Testimonials';
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

    public function product()
    {
        return $this->belongsTo('App\Models\Ecommerce\Packages', 'product_id', 'id');
    }
    public function avatar()
    {
        return $this->belongsTo('App\Models\Modules\Media', 'avatar_id', 'id');
    }

}
