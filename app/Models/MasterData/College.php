<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\BuilderContract;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class College extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name',
        'established_year',
        'type',
        'address',
        'country',
        'state',
        'district',
        'pincode',
        'contact_person',
        'phone',
        'fax',
        'email',
        'website',
        'student_intake',
        'nat_rank',
        'is_deemed',
        'name_of_principal',
        'contact_no_of_principal',
        'email_of_principal',
        'admin',
        'short_description',
        'why_join',
        'high_light_text',
        'similar_location',
        'similar_college',
        'logo_id',
        'brochure_id',
        'application_form_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('masterdata');
    }

    public function scopeFilterBy($query, $filters){
        $namespace = 'App\Utilities\MasterData\Colleges';
        $filter = new BuilderContract($query, $filters, $namespace);
        return $filter->apply();
    }

    public function facilities(){
        return $this->hasMany('App\Models\MasterData\CollegeFacilities', 'college_id', 'id');
    }

    public function logo(){
        return $this->belongsTo('App\Models\Modules\Media', 'logo_id', 'id');
    }

    public function brochure(){
        return $this->belongsTo('App\Models\Modules\Media', 'brochure_id', 'id');
    }

    public function application_form(){
        return $this->belongsTo('App\Models\Modules\Media', 'application_form_id', 'id');
    }
}
