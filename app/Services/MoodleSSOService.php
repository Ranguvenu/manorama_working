<?php

namespace App\Services;

use App\Helpers\SiteSettings;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

class MoodleSSOService
{
    private $moodle_url;

    private $moodle_token;

    private $login_redirect;

    private $encryption_method = 'AES-256-CBC';

    private $encryption_key;

    private $logout_redirect;

    public function __construct()
    {
        $this->settings = new SiteSettings();
        $this->moodle_url = $this->settings->lms_url();
        $this->moodle_token = $this->settings->lms_token();
        $this->encryption_key = $this->settings->lms_encryption_key();
        $this->client = new Client(['http_errors' => false, 'verify' => false]);
    }

    public function authenticate_user(User $user, $course = 0)
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
                $create_user = $this->create_user_on_moodle($newuser);
                if ($create_user['success'] && $create_user['data']) {
                    $mdl_user = $create_user['data'][0]['id'];
                }
            }
            $user->mdl_user = $mdl_user;
            $user->save();
        }

        $payload = [
            'moodle_user_id' => $user->mdl_user,
            'user_email' => $user->email,
            'user_login' => $user->name,
            'hash' => hash('md5', rand(10, 1000)),
            'login_redirect' => $this->login_redirect,
        ];

        $hash_data = $this->encrypt_data(serialize($payload), $payload['hash']);
        $response = $this->set_user_preference($user->mdl_user, $hash_data);
        $redirect_url = $this->moodle_url.'/auth/lbssomoodle/login.php?action=login&&mdl_user_id='.$user->mdl_user.'&code='.$payload['hash'].'&course_id='.$course;

        return $redirect_url;
    }

    public function destroy_session(User $user)
    {
        if ($user->mdl_user) {
            $payload = [
                'moodle_user_id' => $user->mdl_user,
                'user_email' => $user->email,
                'user_login' => $user->name,
                'hash' => hash('md5', rand(10, 1000)),
                'login_redirect' => $this->login_redirect,
            ];

            $hash_data = $this->encrypt_data(serialize($payload), $payload['hash']);
            $response = $this->set_user_preference($user->mdl_user, $hash_data);
            $redirect_url = $this->moodle_url.'/auth/lbssomoodle/login.php?action=logout&&mdl_user_id='.$user->mdl_user.'&code='.$payload['hash'];

            return $redirect_url;
        }
    }

    public function logout_user()
    {
        \Auth::logout();
        $redirect_url = url('/home');

        return $redirect_url;
    }

    /**
     * Create user on moodle via webservice.
     *
     * @param array $users
     *
     * @return array $response
     */
    public function create_user_on_moodle($users)
    {
        $payload = [];
        $payload['form_params'] = [
            'wstoken' => $this->moodle_token,
            'wsfunction' => 'core_user_create_users',
            'moodlewsrestformat' => 'json',
            'users' => $users,
        ];
        $payload['headers'] = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
        $response = $this->make_request('POST', $payload);

        if ($response['code'] == 200) {
            return [
                'success' => true,
                'data' => $response['data'],
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to process the request',
            ];
        }
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
            'wstoken' => $this->moodle_token,
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

    /**
     * Sets user preference via api on moodle.
     *
     * @param int    $mdl_user_id
     * @param string $hash_data   [For verifying authenticity of the request]
     *
     * @return array $response
     */
    public function set_user_preference($mdl_user_id, $hash_data)
    {
        $payload = [];
        $payload['query'] = [
            'wstoken' => $this->moodle_token,
            'wsfunction' => 'auth_lbssomoodle_set_user_preference',
            'moodlewsrestformat' => 'json',
            'hashdata' => $hash_data,
            'userid' => $mdl_user_id,
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

    /**
     * Validates encryption key on moodle.
     *
     * @param string $moodle_url
     * @param string $moodle_token
     * @param string $encryption_key
     *
     * @return array $response
     */
    public function validate_encryption_key_moodle($moodle_url, $moodle_token, $encryption_key)
    {
        $payload = [];
        $payload['query'] = [
            'wstoken' => $moodle_token,
            'wsfunction' => 'auth_lbssomoodle_test_connection',
            'moodlewsrestformat' => 'json',
            'encryptionkey' => $encryption_key,
        ];

        $response = $this->make_request('POST', $payload, $moodle_url);

        if ($response && $response['code'] == 200) {
            return $response;
        } else {
            return [
                'success' => false,
                'message' => 'Failed to process the request',
            ];
        }
    }

    /**
     * Make API Request.
     *
     * @param string $method
     * @param array  $payload
     * @param string $moodle_url
     */
    private function make_request($method, $payload, $moodle_url = '')
    {
        $url = $moodle_url ? $moodle_url : $this->moodle_url;
        $url .= '/webservice/rest/server.php';

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

    /**
     * Encrypts data.
     *
     * @param string $data
     * @param string $private_key
     *
     * @return string $encrypted_data
     */
    public function encrypt_data($data, $private_key)
    {
        $secret_key = $this->encryption_key;
        $key = hash('sha256', $private_key);
        $hash_hmac = substr(hash('sha256', $secret_key), 0, 16);
        $encrypted_data = openssl_encrypt($data, $this->encryption_method, $key, 0, $hash_hmac);

        return base64_encode($encrypted_data);
    }

    /**
     * Public function Decrypt Data.
     *
     * @param string $encrypted_data
     * @param string $private_key
     *
     * @return string $data
     */
    public function decrypt_data($encrypted_data, $private_key)
    {
        $secret_key = $this->encryption_key;
        $key = hash('sha256', $private_key);
        $hash_hmac = substr(hash('sha256', $secret_key), 0, 16);
        $data = openssl_decrypt(base64_decode($encrypted_data), $this->encryption_method, $key, 0, $hash_hmac);

        return $data;
    }
}
