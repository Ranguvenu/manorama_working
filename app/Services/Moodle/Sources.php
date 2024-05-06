<?php

namespace App\Services\Moodle;


class Sources extends MoodleService
{
    public function create_sources($data)
    {
        $payload = [];
        $payload['form_params'] = [
            'wsfunction' => 'local_questions_create_sources',
            'name' => $data['name'],
            'code' => $data['code'],
        ];
        $payload['headers'] = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
        $response = $this->make_request('POST', $payload);

        if ($response['success']) {
            return $response['data']['id'];
        }

        return false;
    }
}
