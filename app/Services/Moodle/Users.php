<?php

namespace App\Services\Moodle;

class Users extends MoodleService
{
    public function createorupdate_user($user, $sources = null,$mdlroles = null,$profile = null)
    {
        $users[0] = [
            'username' => $user['name'],
            'email' => $user['email'],
            'password' => !empty($user['password']) ? $user['password'] : '',
            'firstname' => $user['firstname'] ? $user['firstname'] : '',
            'lastname' => $user['lastname'] ? $user['lastname'] : '',
            'phone1' => $user['phone']['number'] ?? $user['phone_number'],
        ];
        $payload = [];
        $payload['form_params'] = [
            'wsfunction' => 'createuser_withsources',
            'old_id' => !empty($user['old_id']) ? $user['old_id'] : 0,
            'users' => $users,
            'roles' => implode(',',$mdlroles),
            'sources' => !empty($sources) ? base64_encode(serialize($sources)) : '',
            'profile' => $profile ? $profile : ''
        ];

        $payload['headers'] = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $response = $this->make_request('POST', $payload);

        return $response;
    }

    public function delete_user($username)
    {
        $payload = [];
        $payload['form_params'] = [
            'wsfunction' => 'delete_userwithsources',
            'username' => $username,
        ];
        $payload['headers'] = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
        $response = $this->make_request('POST', $payload);

        if ($response['success']) {
            return $response['data'];
        }

        return false;
    }
}
