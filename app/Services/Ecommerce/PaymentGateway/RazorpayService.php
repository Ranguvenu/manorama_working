<?php

namespace App\Services\Ecommerce\PaymentGateway;

use App\Helpers\SiteSettings;
use Razorpay\Api\Api as RazorPayApi;

class RazorpayService
{
    protected $service;

    public $apikey;

    protected $apisecrect;

    public function __construct()
    {
        $settings = new SiteSettings();
        $this->apikey = $settings->payment_razorpay_key_id();
        $this->apisecret = $settings->payment_razorpay_key_secret();
        $this->service = new RazorPayApi($this->apikey, $this->apisecret);
    }

    public function api_key()
    {
        return $this->apikey;
    }

    public function create_order($amount)
    {
        return $this->service->order->create([
            'amount' => $amount * 100,
            'currency' => 'INR',
        ]);
    }

    public function verify_payment($payment_id)
    {
        $payment = $this->service->payment->fetch($payment_id);

        return $this->service->payment->fetch($payment_id)->capture(['amount' => $payment['amount']]);
    }
}
