<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SystemUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'system',
            'email' => 'system@mm.co.in.moodle.com',
            'password' => \Hash::make(uniqid(30)),
        ]);
    }
}
