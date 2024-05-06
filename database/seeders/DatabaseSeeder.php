<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SystemUserSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            TaxonomySeeder::class,
            CategorySeeder::class,
            CountrySeeder::class,
            NotificationTypeSeeder::class,
            NotificationSettingSeeder::class,
            PageComponentTypeSeeder::class,
        ]);
    }
}
