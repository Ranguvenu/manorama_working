<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Services\Moodle\Users as UsersService;
use Illuminate\Support\Facades\Log;

class UsersMigrations extends Command
{
    public $service;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:users-migrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->service = new UsersService();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('mdl_user', 0)->get();
        
        if ($users) {
            $mdlroles[] = 'student';
            foreach($users as $user) {

                $data = $user;
                $data = $data->toArray();
                // $mdlroles[] = 'subscriber';
                $data['name'] = strtolower($data['name']);
                $data['password'] = 'WElcome@'.uniqid();
                $data['phone']['number'] = !empty($data['phone_number']) ? $data['phone_number'] : 0;

                $mdl_id = $this->service->createorupdate_user($data, null, $mdlroles);
                if (!empty($mdl_id['success'])) {
                    $user->mdl_user = (int)$mdl_id['data']['id'];
                    $user->save();
    
                    $message = "User having old_id ". $data['old_id'] ." is created";
                    $this->info($message);
                    Log::info($message);
                } else {
                    $message = "User having old_id ". $data['old_id'] ." is not created in LMS due to ". $mdl_id['message'];
                    $this->info($message);
                    Log::info($message);
                }
            }
        } else {
            $message = "There is no Users to insert in LMS";
            $this->info($message);
        }
    }
}
