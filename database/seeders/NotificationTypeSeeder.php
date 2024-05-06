<?php

namespace Database\Seeders;

use App\Models\Notifications\NotificationType;
use Illuminate\Database\Seeder;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notificationtypes = [
            '2fa-notification' => [
                'title' => '2FA Notification',
                'slug' => '2fa-notification',
                'description' => '2fa Notifications',
                'variables' => [
                    'code' => '[[code]]',
                    'sitename' => '[[sitename]]',
                    'role' => '[[role]]',
                ],
            ],
            'rcv-notification' => [
                'title' => 'Request Callback Verification Notification',
                'slug' => 'rcv-notification',
                'description' => 'Request Callback Verification',
                'variables' => [
                    'code' => '[[code]]',
                ],
            ],
            'srv-notification' => [
                'title' => 'Subscriber Verification Notification',
                'slug' => 'srv-notification',
                'description' => 'Subscriber Verification',
                'variables' => [
                    'code' => '[[code]]',
                ],
            ],
            'new-user-created' => [
                'title' => 'New User Registered Notification',
                'slug' => 'new-user-created',
                'description' => 'New user created in the site',
                'variables' => [
                    'name' => '[[name]]',
                    'email' => '[[email]]',
                    'firstname' => '[[firstname]]',
                    'lastname' => '[[lastname]]',
                ],
            ],
            'subscriber-welcome' => [
                'title' => 'Subscriber Welcome Notification',
                'slug' => 'subscriber-welcome',
                'description' => 'Subscriber Welcome Notification',
                'variables' => [
                    'name' => '[[name]]',
                    'email' => '[[email]]',
                    'firstname' => '[[firstname]]',
                    'lastname' => '[[lastname]]',
                ],
            ],
            'payment-confirmation' => [
                'title' => 'Payment Confirmation Notification',
                'slug' => 'payment-confirmation',
                'description' => 'Payment Confirmation Notification',
                'variables' => [
                    'name' => '[[name]]',
                    'email' => '[[email]]',
                    'firstname' => '[[firstname]]',
                    'lastname' => '[[lastname]]',
                    'amount' => '[[amount]]',
                    'package' => '[[package]]',
                ],
            ],
            'package-subscription' => [
                'title' => 'Package Subscription Notification',
                'slug' => 'package-subscription',
                'description' => 'Package Subscription Notification',
                'variables' => [
                    'name' => '[[name]]',
                    'email' => '[[email]]',
                    'firstname' => '[[firstname]]',
                    'lastname' => '[[lastname]]',
                    'amount' => '[[amount]]',
                    'package' => '[[package]]',
                ],
            ],
            'payment-failed' => [
                'title' => 'Payment Failed Notification',
                'slug' => 'payment-failed',
                'description' => 'Payment Failed Notification',
                'variables' => [
                    'name' => '[[name]]',
                    'email' => '[[email]]',
                    'firstname' => '[[firstname]]',
                    'lastname' => '[[lastname]]',
                    'amount' => '[[amount]]',
                    'package' => '[[package]]',
                ],
            ],
            'external-agency-course-enrolment-instructions' => [
                'title' => 'External Agency Course Enrolment Instructions',
                'slug' => 'external-agency-course-enrolment-instructions',
                'description' => 'External Agency Course Enrolment Instructions',
                'variables' => [
                    'name' => '[[name]]',
                    'email' => '[[email]]',
                    'firstname' => '[[firstname]]',
                    'lastname' => '[[lastname]]',
                    'package' => '[[package]]',
                    'content' => '[[content]]',
                ],
            ],
            'promocode' => [
                'title' => 'Promocode Notification',
                'slug' => 'promocode',
                'description' => 'Promocode Notification',
                'variables' => [
                    'name' => '[[name]]',
                    'email' => '[[email]]',
                    'code' => '[[code]]',
                ],
            ],
        ];

        foreach ($notificationtypes as $key => $notificationtype) {
            NotificationType::updateOrCreate([
                'slug' => $key,
            ], $notificationtype);
        }
    }
}
