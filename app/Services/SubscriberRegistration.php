<?php

namespace App\Services;

use App\Models\LeadManagement\Lead;
use App\Models\MasterData\Category;
use App\Models\MasterData\Taxonomy;
use App\Models\UserManagement\Role;
use App\Services\Notifications\NotificationService;
use App\Services\Moodle\Users as UsersService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscriberRegistration
{
    public function __construct()
    {
    }

    public function create_subscriber($data)
    {
        $service = new UsersService();

        DB::beginTransaction();
        try{       
        $subscriber = Category::where('slug', 'subscribers')->first();
        $user = $subscriber->users()->create($data);
        $user->assignRole('subscriber');
        $laravelrole = 'subscriber';
        $mdlroles = [];
        $mdlrole = Role::where('name', $laravelrole)->first();
        if ($mdlrole !== null && $mdlrole->mdlrole != null) {
            $mdlroles[] = $mdlrole->mdlrole;
        }
        $data['phone']['number'] = $data['phone_number'];   
        $mdl_id = $service->createorupdate_user($data, '', $mdlroles);
        if (!empty($mdl_id['success'])) {
            $user->mdl_user = $mdl_id['data']['id'];
            $user->save();
            $this->create_lead($user);
            $this->notify_user($user);            
            DB::commit();
            return $user;
        } else {
            DB::rollback();
            return false;
        }
    } catch (Exception $e) {
        DB::rollback();
        return false;
    }

    }

    public function create_lead($user)
    {
        $taxonomy = Taxonomy::findOrFail('lead_category');
        $category = $taxonomy->categories->where('slug', 'registered')->first();

        $leaddata = [
            'name' => $user->fullname,
            'country_code' => $user->country_code,
            'phone_number' => $user->phone_number,
        ];

        $lead = Lead::updateOrCreate(
            ['email' => $user->email],
            $leaddata);

        $lead->registrations()->updateOrCreate(['user_id' => $user->id], ['user_id' => $user->id]);
        $source = Category::where('slug', 'website_registration')->first();
        $lead->interests()->create([
            'received_from' => '',
            'category_id' => $category->id,
            'source_id' => $source->id,
            'product_id' => 0,
        ]);

        return $lead;
    }

    public function notify_user($user)
    {
        $notifier = new NotificationService($user);
        $notifier->send('new-user-created', 'email', $user->variables);
        $notifier->send('subscriber-welcome', 'email', $user->variables);

        return true;
    }
}
