<?php

namespace App\Services\Moodle;

use App\Services\Notifications\NotificationService;
use Illuminate\Support\Facades\Hash;

class EnrollmentService extends MoodleService
{
    public function create_subscriber($user)
    {
        if (!$user->mdl_user) {
            $exists = $this->check_user_existance_on_moodle($user->email);
            if ($exists && isset($exists['user_id']) && $exists['user_id']) {
                $mdl_user = $exists['user_id'];
            } else {
                $newuser = [];

                $newuser[0] = [
                    'username' => $user->email,
                    'auth' => 'lbssomoodle',
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'email' => $user->email,
                    'password' => Hash::make(\Str::random(20)),
                ];

                $payload = [];
                $payload['form_params'] = [
                    'wsfunction' => 'core_user_create_users',
                    'moodlewsrestformat' => 'json',
                    'users' => $newuser,
                ];
                $payload['headers'] = [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ];
                $response = $this->make_request('POST', $payload);

                if ($response['code'] == 200) {
                    if ($response['success'] && $response['data']) {
                        $user->mdl_user = $response['data'][0]['id'];
                        $user->save();
                    }

                    return $user;
                } else {
                    return [
                        'success' => false,
                        'message' => 'Failed to process the request',
                    ];
                }
            }
        }

        return $user;
    }

    /**
     * Checks if authenticated user exists on moodle.
     *
     * @param string $user_name
     *
     * @return array $response
     */
    public function check_user_existance_on_moodle($user_name)
    {
        $payload = [];
        $payload['query'] = [
            'wsfunction' => 'auth_lbssomoodle_check_user_existance',
            'moodlewsrestformat' => 'json',
            'username' => $user_name,
        ];

        $response = $this->make_request('POST', $payload);

        if ($response['code'] == 200) {
            return $response['data'];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to process the request',
            ];
        }
    }

    public function enroll_subscriber($order)
    {
        $user = $order->user;

        if (!$user->mdl_user) {
            $user = $this->create_subscriber($user);
        }

        $mdl_user = $user->mdl_user;

        $enrollments = $order->enrollment->courses->map(function ($course) use ($mdl_user) {
            return [
                'roleid' => 5,
                'userid' => $mdl_user,
                'courseid' => ($course->batch && $course->batch->course) ? $course->batch->course->mdl_id : 0,
                'timestart' => strtotime($course->enrollment->start_date),
                'timeend' => strtotime($course->enrollment->end_date),
            ];
        });

        $payload = [];
        $payload['form_params'] = [
            'wsfunction' => ($order->enrollment->enrollment_type === 1) ? 'enrol_manual_enrol_users' : 'enrol_trial_enrol_users',
            'moodlewsrestformat' => 'json',
            'enrolments' => $enrollments->toArray(),
        ];

        $payload['headers'] = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
        $response = $this->make_request('POST', $payload);
        if ($order->package->is_external_course) {
            $notifier = new NotificationService($order->user);
            $notifier->send('external-agency-course-enrolment-instructions', 'email', $order->variables);
        }

        if (!$order->enrollment->courses->count()) {
            return $order->enrollment->update(['status' => 0]);
        }

        if ($response == 'null') {
            $order->enrollment->update(['status' => 2]);

            return $order->enrollment->courses()->update(['status' => 2]);
        } else {
            $errorexception = [
                'payload' => $payload,
                'response' => $response,
            ];
            $order->enrollment->update(['status' => 1]);

            return $order->enrollment->courses()->update(['status' => 1, 'mdl_response' => $errorexception]);
        }
    }

    public function migrration_enroll_subscriber($order)
    {
        $user = $order->userid;
        
        $enrollments[0] = [
            'roleid' => 5,
            'userid' => $order->userid,
            'courseid' => $order->courseid,
            'timestart' => $order->timestart,
            'timeend' => $order->timeend,
        ];

        $payload = [];
        $payload['form_params'] = [
            'wsfunction' => 'enrol_manual_enrol_users',
            'moodlewsrestformat' => 'json',
            'enrolments' => $enrollments,
        ];

        $payload['headers'] = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $response = $this->make_request('POST', $payload);

        if ($response == null) {
            $order->enrollment->update(['status' => 2]);

            return $order->enrollment->courses()->update(['status' => 2]);
        } else {
            $errorexception = [
                'payload' => $payload,
                'response' => $response,
            ];

            return $order->enrollment->courses()->update(['status' => 1, 'mdl_response' => $errorexception]);
        }
    }
}
