<?php

namespace App\Services\Notifications\SMS;

use GuzzleHttp\Client;

class SMSCountryService
{
    private $apiurl = 'https://restapi.smscountry.com/';

    private $version = 'v0.1';

    private $authkey = 'mvK4C3XJ5H2aOdsToTs3';

    private $authtoken = 'DO1PxdpdakRrWsI3CeZVb4zcQsTNbOb8dfcuMGd0';

    protected $auth_key;

    protected $endpoints;

    protected $variables;

    public function __construct()
    {
        $this->auth_key = $this->generate_auth_token();
        $this->endpoints = $this->available_endpoints();
        $this->variables = $this->get_variables();
        $this->client = new Client(['http_errors' => false, 'verify' => false]);
    }

    public function generate_auth_token()
    {
        $token = $this->authkey.':'.$this->authtoken;

        return base64_encode($token);
    }

    public function send_sms($to, $message)
    {
        $payload['headers'] = [
            'Authorization' => 'Basic '.$this->generate_auth_token(),
            'Content-Type' => 'application/json',
        ];
        $payload['json'] = [
            'Text' => $message,
            'Number' => $to,
            'DRNotifyUrl' => \URL::to('/webhooks/smscountry'),
            'DRNotifyHttpMethod' => 'POST',
            'Tool' => 'API',
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
            '{authkey}' => $this->authkey,
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
            '0' => 'message.queued',
            '1' => 'message.submitted',
            '2' => 'message.undelivered',
            '3' => 'message.delivered',
            '4' => 'message.expired',
            '8' => 'message.rejected',
            '9' => 'message.sent',
            '10' => 'optedout',
            '11' => 'invalidnumber',
        ];
    }

    public function available_endpoints()
    {
        return [
            'send_sms' => [
                'method' => 'POST',
                'auth' => true,
                'url' => '/Accounts/{authkey}/SMSes/',
            ],
        ];
    }

    public function make_request($endpoint, $payload)
    {
        $post = $this->client->request($endpoint['method'],
            $endpoint['url'],
            $payload);
        $response = ($post->getStatusCode() == 202) ? json_decode($post->getBody(), true) : false;

        return $response;
    }
}
