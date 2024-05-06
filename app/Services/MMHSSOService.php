<?php

namespace App\Services;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class MMHSSOService
{
    private $url = 'https://id.manoramaonline.com';

    private $client_id = 'horizon-stag';

    private $client_secret = '123456';

    private $redirect_url;

    public function __construct()
    {
        $this->redirect_url = route('integrations.mhsso.authenticate');
        $this->client = new Client(['http_errors' => false, 'verify' => false]);
    }

    public function authorize()
    {
        $params = [
            'response_type' => 'code',
            'scope' => 'openid profile email mobile',
            'client_id' => $this->client_id,
            'state' => uniqid(),
            'redirect_uri' => $this->redirect_url,
        ];

        $query = http_build_query($params);

        return url($this->url.'/authorize?'.$query);
    }

    public function authenticate($code)
    {
        $token = $this->get_token($code);
        if ($token && $token['code'] == 200) {
            $response = $token['data'];
            $validate_token = $this->validate_token($response['id_token'], $response['access_token']);
            if ($validate_token) {
                return $this->create_or_get_user($validate_token);
            }

            return false;
        }

        return false;
    }

    private function create_or_get_user($response)
    {
        if ($response && isset($response->email)) {
            $user = User::where('email', $response->email)->first();
            if ($user) {
                return $user;
            }

            $data = [
                'name' => uniqid(),
                'email' => $response->email,
                'password' => \Hash::make(uniqid()),
                'country_code' => $response->mobileCountryCode,
                'phone_number' => $response->mobileNumber,
                'firstname' => $response->firstName,
                'lastname' => $response->lastName,
                'registration_mode' => 1,
            ];
            $subscriber = new SubscriberRegistration();

            return $subscriber->create_subscriber($data);
        }
    }

    private function get_token($code)
    {
        $payload = [];
        $payload['query'] = [
            'code' => $code,
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->redirect_url,
        ];
        $response = $this->make_request('/token', 'POST', $payload);

        return $response;
    }

    private function validate_token($idtoken, $accesstoken)
    {
        if ($idtoken) {
            $accesstoken = utf8_encode($accesstoken);
            $content = explode('.', $idtoken);
            $second = $content[1];
            $mod_value = strlen($second) % 4;
            if ($mod_value != 0) {
                $append_str = '';
                $char_to_append = 4 - $mod_value;
                $second .= str_repeat('=', $char_to_append);
            }
            $second_item_data = json_decode(base64_decode($second));

            $hashed_access_token = hash('sha256', $accesstoken, true);
            $encoded_url = Str::limit(base64_encode($hashed_access_token), 16, '');
            if (Str::contains($second_item_data->at_hash, $encoded_url)) {
                return $second_item_data;
            }

            return false;
        }
    }

    /**
     * Make API Request.
     *
     * @param string $method
     * @param array  $payload
     */
    private function make_request($endpoint, $method, $payload)
    {
        $post = $this->client->request($method,
            $this->url.$endpoint,
            $payload);

        $response = ($post->getStatusCode() == 200) ? json_decode($post->getBody(), true) : false;

        return [
            'success' => true,
            'code' => $post->getStatusCode(),
            'data' => $response,
        ];
    }
}
