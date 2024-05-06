<?php

namespace App\Services\Notifications\SMS;

use App\Helpers\SiteSettings;
use GuzzleHttp\Client;

class SinchService
{
    protected $apiurl = 'https://push3.aclgateway.com/';

    protected $version = 'v1';

    protected $plan_id;

    protected $api_token;

    protected $from_number;

    protected $endpoints;

    protected $variables;

    protected $settings;

    public function __construct()
    {
        $this->settings = new SiteSettings();
        $this->endpoints = $this->available_endpoints();
        $this->variables = $this->get_variables();
        $this->client = new Client();
        $this->plan_id = $this->settings->sinch_plan_id();
        $this->api_token = $this->settings->sinch_api_token();
        $this->from_number = $this->settings->sinch_from_number();
    }

    public function send_sms($to, $message)
    {
        $payload['headers'] = [
            'Content-Type' => 'application/json',
        ];
        $payload['json'] = [
                'appid' => $this->plan_id,
                'userId' => $this->plan_id,
                'pass' => $this->api_token,
                'contenttype' => '1',
                'from' => $this->from_number,
                'to' => $to,
                'alert' => '1',
                'selfid' => 'true',
                'intflag' => 'false',
                'text' => $message,
            ];
        $response = $this->make_request($this->get_endpoint('send_sms'), $payload);

        return $response;
    }

    public function get_endpoint($slug)
    {
        $endpoint = $this->endpoints && isset($this->endpoints[$slug]) ? $this->endpoints[$slug] : [];
        $url = $this->apiurl.$this->version.$endpoint['url'];

        return [
            'url' => $this->add_variables($url),
            'method' => $endpoint['method'],
        ];
    }

    public function get_variables()
    {
        return [
            '{plan_id}' => $this->plan_id,
        ];
    }

    public function add_variables($string)
    {
        foreach ($this->variables as $key => $variable) {
            $string = str_replace($key, $variable, $string);
        }

        return $string;
    }

    public function get_status_code($code)
    {
        $codes = $this->get_status_codes();

        return isset($codes[$code]) ? $codes[$code] : 'unknown';
    }

    public function get_status_codes()
    {
        return [
            'Queued' => 'message.queued',
            'Dispatched' => 'message.submitted',
            'Failed' => 'message.undelivered',
            'Delivered' => 'message.delivered',
            'Expired' => 'message.expired',
            'Rejected' => 'message.rejected',
            'Cancelled' => 'message.cancelled',
            'Aborted' => 'message.expired',
            'Deleted' => 'optedout',
        ];
    }

    public function available_endpoints()
    {
        return [
            'send_sms' => [
                'method' => 'POST',
                'auth' => true,
                'url' => '/enterprises/messages.json',
            ],
        ];
    }

    public function make_request($endpoint, $payload)
    {
        $post = $this->client->request($endpoint['method'],
            $endpoint['url'],
            $payload);
        $response = ($post->getStatusCode() == 200) ? json_decode($post->getBody(), true) : false;

        return $response;
    }
}
