<?php

namespace App\UtilClasses;

use Illuminate\Support\Facades\Http;

class BKASH
{
    private $endpoint;
    private $username;
    private $password;
    private $appKey;
    private $appSecret;
    private $callbackURL;
    private $token;

    function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->endpoint    = config("paymentgateways.bkash.endpoint");
        $this->username    = config("paymentgateways.bkash.username");
        $this->password    = config("paymentgateways.bkash.password");
        $this->appKey      = config("paymentgateways.bkash.app_key");
        $this->appSecret   = config("paymentgateways.bkash.app_secret");
        $this->callbackURL = config("paymentgateways.bkash.callback_url");
        $this->token       = $this->getToken();
    }

    /**
     * Token response from bkash server
     *
     * @return object {
            "statusCode"   : "0000"
            "statusMessage": "Successful"
            "id_token"     : "string"
            "token_type"   : "Bearer"
            "expires_in"   : "3600"
            "refresh_token": "string"
        }
     */
    public function getToken()
    {
        $url = "{$this->endpoint}/token/grant";

        $body = [
            "app_key"    => $this->appKey,
            "app_secret" => $this->appSecret
        ];

       $headers = [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
            'password'     => $this->password,
            'username'     => $this->username,
        ];

        $response = Http::withHeaders($headers)->post($url, $body);
        $response = json_decode($response, true);

        return $response;
    }

    public function createPayment($amount, $invoiceNumber, $payerReference)
    {
        $url = "{$this->endpoint}/create";

        $body = [
            "mode"                  => "0011",
            "amount"                => $amount,
            "currency"              => "BDT",
            "intent"                => "Sale",
            "payerReference"        => $payerReference,
            "merchantInvoiceNumber" => $invoiceNumber,
            "callbackURL"           => $this->callbackURL
        ];

        $headers = $this->getHeader();

        $response = Http::withHeaders($headers)->post($url, $body);
        $response = json_decode($response, true);

        return $response;
    }

    public function getHeader()
    {
        $token = "{$this->token['token_type']} {$this->token['id_token']}";

        $headers = [
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => $token,
            'X-APP-Key'     => $this->appKey,
        ];

        return $headers;
    }
}