<?php

namespace App\Services\Moodle;

use App\Helpers\SiteSettings;
use GuzzleHttp\Client;

abstract class MoodleService
{
    private $moodle_url;

    private $moodle_token;

    private $client;

    public function __construct()
    {
        $this->settings = new SiteSettings();
        $this->moodle_url = $this->settings->lms_url();
        $this->moodle_token = $this->settings->lms_token();
        $this->encryption_key = $this->settings->lms_encryption_key();
        $this->client = new Client(['http_errors' => false, 'verify' => false]);
    }

    /**
     * Make API Request.
     *
     * @param string $method
     * @param array  $payload
     * @param string $moodle_url
     */
    protected function make_request($method, $payload, $moodle_url = '')
    {
        $url = $moodle_url ? $moodle_url : $this->moodle_url;
        $url .= '/webservice/rest/server.php';

        $authentication = [
            'wstoken' => $this->moodle_token,
            'moodlewsrestformat' => 'json',
        ];

        if ($payload && isset($payload['query'])) {
            $payload['query'] = array_merge($payload['query'], $authentication);
        }

        if ($payload && isset($payload['form_params'])) {
            $payload['form_params'] = array_merge($payload['form_params'], $authentication);
        }

        $post = $this->client->request($method,
            $url,
            $payload);

        $response = ($post->getStatusCode() == 200) ? json_decode($post->getBody(), true) : false;

        if ($response && !isset($response['exception'])) {
            return [
                'success' => true,
                'code' => $post->getStatusCode(),
                'data' => json_decode($post->getBody(), true),
            ];
        } else {
            return [
                'success' => false,
                'code' => $post->getStatusCode(),
                'data' => json_decode($post->getBody(), true),
                'message' => ($response && isset($response['message'])) ? $response['message'] : 'Invalid Response',
            ];
        }

        return $response;
    }
}
