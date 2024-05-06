<?php

namespace App\Services\Moodle;

class Roles extends MoodleService
{
    public function get_roles()
    {
        $payload = [];
        $payload['form_params'] = [
            'wsfunction' => 'local_wsgetroles_get_roles',
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
