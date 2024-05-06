<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\BuilderContract;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CollegeFacilities extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'college_facilities';
    
    protected $fillable = [
        'college_id',
        'slug',
        'name',
        'is_available',
        'description',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('masterdata');
    }

    /**
     * Get the facility that belongs to college
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class, 'college_id', 'id');
    }

    public static function available_facilities(){
        return [
            array(
                "name" => "Library",
                "slug" => "library",
                "is_available" => false,
                "description" =>  "",
            ),
            array(
                "name" => "Campus Wifi",
                "slug" => "campus-wifi",
                "is_available" => false,
                "description" =>  "",
            ),
            array(
                "name" => "Hostel",
                "slug" => "hostel",
                "is_available" => false,
                "description" =>  "",
            ),
            array(
                "name" => "Cafeteria/Mess",
                "slug" => "cafeteria",
                "is_available" => false,
                "description" =>  "",
            ),
            array(
                "name" => "Hospital/Medical Facilities",
                "slug" => "hospital",
                "is_available" => false,
                "description" =>  "",
            ),
            array(
                "name" => "Transport Facilities",
                "slug" => "transport-facilities",
                "is_available" => false,
                "description" =>  "",
            ),
            array(
                "name" => "Sports Complex",
                "slug" => "sports-complex",
                "is_available" => false,
                "description" =>  "",
            ),
            array(
                "name" => "Gym",
                "slug" => "gym",
                "is_available" => false,
                "description" =>  "",
            ),
            array(
                "name" => "Labs",
                "slug" => "labs",
                "is_available" => false,
                "description" =>  "",
            )
        ];
    }
}
