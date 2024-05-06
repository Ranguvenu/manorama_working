<?php

namespace Database\Seeders;

use App\Models\Notifications\NotificationSettings;
use App\Models\Notifications\NotificationType;
use App\Models\Notifications\Templates\EmailTemplate;
use App\Models\Notifications\Templates\SmsTemplate;
use Illuminate\Database\Seeder;

class NotificationSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'tfa-authentication-sms' => [
                'title' => 'Two Factor Authentication',
                'slug' => 'tfa-authentication-sms',
                'method' => 'sms',
                'notification_type_id' => '2fa-notification',
                'recipient_type' => 'customer',
                'template' => [
                    'title' => 'Two Factor Authentication SMS',
                    'content' => 'Please use [[code]] as the OTP for mobile number verification at MMHA -Manorama Horizon',
                    'status' => 1,
                    'notification_type_id' => '2fa-notification',
                ],
            ],
            'tfa-authentication-email' => [
                'title' => 'Two Factor Authentication',
                'slug' => 'tfa-authentication-email',
                'method' => 'email',
                'notification_type_id' => '2fa-notification',
                'recipient_type' => 'customer',
                'template' => [
                    'title' => 'Two Factor Authentication Email',
                    'subject' => 'Your OTP',
                    'content' => 'Please use [[code]] as the OTP for 2fa authentication at MMHA -Manorama Horizon',
                    'status' => 1,
                    'notification_type_id' => '2fa-notification',
                ],
            ],
            'request-callback-verification-sms' => [
                'title' => 'Request Callback Verification',
                'slug' => 'request-callback-verification-sms',
                'method' => 'sms',
                'notification_type_id' => 'rcv-notification',
                'recipient_type' => 'customer',
                'template' => [
                    'title' => 'Request Callback Verification SMS',
                    'content' => 'Please use [[code]] as the OTP for mobile number verification at MMHA -Manorama Horizon',
                    'status' => 1,
                    'notification_type_id' => 'rcv-notification',
                ],
            ],
            'request-callback-verification-email' => [
                'title' => 'Request Callback Verification',
                'slug' => 'request-callback-verification-email',
                'method' => 'email',
                'notification_type_id' => 'rcv-notification',
                'recipient_type' => 'customer',
                'template' => [
                    'title' => 'Request Callback Verification Email',
                    'subject' => 'Your OTP',
                    'content' => 'Please use [[code]] as the OTP for mobile number verification at MMHA -Manorama Horizon',
                    'status' => 1,
                    'notification_type_id' => 'rcv-notification',
                ],
            ],
            'subscriber-verification-email' => [
                'title' => 'Subscriber Email Verification',
                'slug' => 'subscriber-verification-email',
                'method' => 'email',
                'notification_type_id' => 'srv-notification',
                'recipient_type' => 'customer',
                'template' => [
                    'title' => 'Subscriber Email Verification Email',
                    'subject' => 'Your OTP',
                    'content' => 'Please use [[code]] as the OTP for mobile number verification at MMHA -Manorama Horizon',
                    'status' => 1,
                    'notification_type_id' => 'srv-notification',
                ],
            ],
            'subscriber-verification-sms' => [
                'title' => 'Subscriber Mobile Verification',
                'slug' => 'subscriber-verification-sms',
                'method' => 'sms',
                'notification_type_id' => 'srv-notification',
                'recipient_type' => 'customer',
                'template' => [
                    'title' => 'Subscriber Email Verification SMS',
                    'content' => 'Please use [[code]] as the OTP for mobile number verification at MMHA -Manorama Horizon',
                    'status' => 1,
                    'notification_type_id' => 'srv-notification',
                ],
            ],
            'new-subscriber-registered-email' => [
                'title' => 'New Subscriber Registered',
                'slug' => 'new-subscriber-registered-email',
                'method' => 'email',
                'notification_type_id' => 'new-user-created',
                'recipient_type' => 'admin',
                'template' => [
                    'title' => 'New Subscriber Registration Email',
                    'subject' => 'New User Registration',
                    'content' => 'Hello Admin, New user has registered on to the site',
                    'status' => 1,
                    'notification_type_id' => 'new-user-created',
                ],
            ],
            'subscriber-welcome-email' => [
                'title' => 'Subscriber Welcome Email',
                'slug' => 'subscriber-welcome-email',
                'method' => 'email',
                'notification_type_id' => 'subscriber-welcome',
                'recipient_type' => 'customer',
                'template' => [
                    'title' => 'Subscriber Welcome Email',
                    'subject' => 'Welcome to Manorama Horizon - Your Learning Journey Begins!',
                    'content' => 'Welcome to Manorama Horizon - Your Learning Journey Begins!',
                    'status' => 1,
                    'notification_type_id' => 'subscriber-welcome',
                ],
            ],
            'payment-confirmation-email' => [
                'title' => 'Payment Confirmation Email',
                'slug' => 'payment-confirmation-email',
                'method' => 'email',
                'notification_type_id' => 'payment-confirmation',
                'recipient_type' => 'customer',
                'template' => [
                    'title' => 'Subscriber Payment Confirmation Email',
                    'subject' => 'Payment Confirmation for Your Enrollment ',
                    'content' => 'Payment Confirmation for Your Enrollment ',
                    'status' => 1,
                    'notification_type_id' => 'payment-confirmation',
                ],
            ],
            'package-subscription-email' => [
                'title' => 'Package Subscription Email',
                'slug' => 'package-subscription-email',
                'method' => 'email',
                'notification_type_id' => 'package-subscription',
                'recipient_type' => 'customer',
                'template' => [
                    'title' => 'Package Subscription Email',
                    'subject' => 'Welcome to your course on Manorama Horizon',
                    'content' => 'Payment Confirmation for Your Enrollment ',
                    'status' => 1,
                    'notification_type_id' => 'package-subscription',
                ],
            ],
            'payment-failed-email' => [
                'title' => 'Payment Failed Email',
                'slug' => 'payment-failed-email',
                'method' => 'email',
                'notification_type_id' => 'payment-failed',
                'recipient_type' => 'customer',
                'template' => [
                    'title' => 'Package Subscription Email',
                    'subject' => 'Payment Failure Notification for your course',
                    'content' => 'Payment Failure Notification for your course',
                    'status' => 1,
                    'notification_type_id' => 'payment-failed',
                ],
            ],
            'external-agency-course-enrolment-instructions-email' => [
                'title' => 'External Agency Course Enrolment Instructions Email',
                'slug' => 'external-agency-course-enrolment-instructions-email',
                'method' => 'email',
                'notification_type_id' => 'external-agency-course-enrolment-instructions',
                'recipient_type' => 'customer',
                'template' => [
                    'title' => 'External Agency Course Enrolment Instructions Email',
                    'subject' => 'Steps to enroll to you course',
                    'content' => 'Hello [[name]], [[content]]',
                    'status' => 1,
                    'notification_type_id' => 'external-agency-course-enrolment-instructions',
                ],
            ],
            'promocode-notification-sms' => [
                'title' => 'Promocode Notification SMS',
                'slug' => 'promocode-notification-sms',
                'method' => 'sms',
                'notification_type_id' => 'promocode',
                'recipient_type' => 'customer',
                'template' => [
                    'title' => 'Promocode Notification SMS',
                    'content' => 'Please use [[code]] as the Promocode',
                    'status' => 1,
                    'notification_type_id' => 'promocode',
                ],
            ],
            'promocode-notification-email' => [
                'title' => 'Promocode Notification Email',
                'slug' => 'promocode-notification-email',
                'method' => 'email',
                'notification_type_id' => 'promocode',
                'recipient_type' => 'customer',
                'template' => [
                    'title' => 'Promocode Notification Email',
                    'subject' => 'Your Promocode',
                    'content' => 'Please use [[code]] as the Promocode',
                    'status' => 1,
                    'notification_type_id' => 'promocode',
                ],
            ],
        ];

        foreach ($settings as $key => $setting) {
            $notificationtype = NotificationType::where('slug', $setting['notification_type_id'])->first();
            if ($notificationtype) {
                $exists = NotificationSettings::where('slug', $setting['slug'])->first();
                $template = 0;
                $setting['notification_type_id'] = $notificationtype->id;
                $setting['template']['notification_type_id'] = $notificationtype->id;
                $notification = NotificationSettings::updateOrCreate([
                    'slug' => $setting['slug'],
                ], [
                    'title' => $setting['title'],
                    'slug' => $setting['slug'],
                    'method' => $setting['method'],
                    'notification_type_id' => $notificationtype->id,
                    'recipient_type' => $setting['recipient_type'],
                ]);
                if (!$exists) {
                    if (isset($setting['template'])) {
                        if ($setting['method'] == 'sms') {
                            $template = SmsTemplate::create($setting['template']);
                        } else {
                            $template = EmailTemplate::create($setting['template']);
                        }
                        if ($template) {
                            $notification->template_id = $template->id;
                            $notification->save();
                        }
                    }
                }
            }
        }
    }
}
