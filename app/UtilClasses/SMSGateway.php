<?php

namespace App\UtilClasses;

use Illuminate\Support\Facades\Http;

class SMSGateway
{
    private $endpoint;
    private $username;
    private $password;
    private $source;
    // for two
    private $apiKey;
    private $secretKey;

    function __construct()
    {
        $this->init();
    }

    public function init()
    {
        // init for DSTBD
        // $this->endpoint = config('smsgateway.end_point');
        // $this->username = config('smsgateway.username');
        // $this->password = config('smsgateway.password');
        // $this->source   = config('smsgateway.source');

        // init for REVE
        $this->endpoint  = config('smsgateway.end_point');
        $this->apiKey    = config('smsgateway.api_key');
        $this->secretKey = config('smsgateway.secret_key');
        $this->source    = config('smsgateway.source');
    }

    // for DSTBD
    public function sendByDSTBD($phoneNumber, $message)
    {
        $response = Http::get($this->endpoint, [
            'username'    => $this->username,
            'password'    => $this->password,
            'type'        => 0,
            'dlr'         => 1,
            'destination' => $phoneNumber,
            'source'      => $this->source,
            'message'     => $message,
        ]);

        return $response;
    }

    // for REVE
    public function sendByREVE($phoneNumber, $message)
    {
        $response = Http::get($this->endpoint, [
            'apikey'         => $this->apiKey,
            'secretkey'      => $this->secretKey,
            'callerID'       => $this->source,
            'toUser'         => $phoneNumber,
            'messageContent' => $message
        ]);
        return $response;
    }
}