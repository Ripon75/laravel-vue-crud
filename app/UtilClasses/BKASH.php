<?php

namespace App\UtilClasses;

use Illuminate\Support\Facades\Http;

class SSLGateway
{
    private $endpoint;
    private $username;
    private $password;
    private $appKey;
    private $appSecret;

    function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->endpoint  = config("paymentgateways.bkash.endpoint");
        $this->username  = config("paymentgateways.bkash.username");
        $this->password  = config("paymentgateways.bkash.password");
        $this->appKey    = config("paymentgateways.bkash.app_key");
        $this->appSecret = config("paymentgateways.bkash.app_secret");
    }
}