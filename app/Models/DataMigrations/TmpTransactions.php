<?php

namespace App\Models\DataMigrations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmpTransactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'package_id',
        'user_id',
        'status',

    ];

}
