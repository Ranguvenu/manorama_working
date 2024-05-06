<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Courses extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hierarchy_id',
        'name',
        'code',
        'mdl_id',
        'parent_mdl_id',
        'description',
        'thumbnail',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('content');
    }

    public function batch()
    {
        return $this->hasOne('App\Models\Ecommerce\Batches', 'course_id', 'id');
    }
}
