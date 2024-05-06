<?php

namespace App\Models\DataMigrations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MigrationLogs extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'component',
        'component_status',
        'raw_data',
        'inserted_data',
        'status'
    ];
}
