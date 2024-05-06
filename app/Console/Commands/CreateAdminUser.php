<?php

namespace App\Console\Commands;

use App\Models\MasterData\Category;
use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin-user {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an admin user in the system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $category = Category::where('slug', 'staff')->first();
        $data = [
            'name' => $this->argument('name'),
            'email' => $this->argument('email'),
            'password' => \Hash::make($this->argument('password')),
        ];
        $category = $category->users()->create($data);
        $category->assignRole('administrator');
    }
}
