<?php

namespace App\Models\UserManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;
use App\Contracts\BuilderContract;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends SpatieRole
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'guard_name',
        'name',
        'fullname',
        'description',
        'mdlrole'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('user_management');
    }

    public function scopeFilterBy($query, $filters){
        $namespace = 'App\Utilities\MasterData\Categories';
        $filter = new BuilderContract($query, $filters, $namespace);
        return $filter->apply();
    }
}
