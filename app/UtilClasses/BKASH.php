<?php

namespace App\UtilClasses;

use Illuminate\Support\Facades\Http;

class Bkash
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
        $this->endpoint    = config("payment_gateways.bkash.endpoint");
        $this->username    = config("payment_gateways.bkash.username");
        $this->password    = config("payment_gateways.bkash.password");
        $this->appKey      = config("payment_gateways.bkash.app_key");
        $this->appSecret   = config("payment_gateways.bkash.app_secret");
        $this->callbackURL = config("payment_gateways.bkash.callback_url");
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

    // public function createPayment($amount, $invoiceNumber, $payerReference)
    // {
    //     $url = "{$this->endpoint}/create";

    //     $headers = $this->getHeader();

    //     $body = [
    //         "mode"                  => "0011",
    //         "amount"                => $amount,
    //         "currency"              => "BDT",
    //         "intent"                => "Sale",
    //         "payerReference"        => $payerReference,
    //         "merchantInvoiceNumber" => $invoiceNumber,
    //         "callbackURL"           => $this->callbackURL
    //     ];


    //     $response = Http::withHeaders($headers)->post($url, $body);
    //     $response = json_decode($response, true);

    //     return $response;
    // }

    public function createPayment($amount,$invoiceNumber,$payerReference)
    {
        $body = [
            'mode'                  => '0011',
            'amount'                => $amount,
            'currency'              => 'BDT',
            'intent'                => 'sale',
            'payerReference'        => $payerReference,
            'merchantInvoiceNumber' => $invoiceNumber,
            'callbackURL'           => $this->callbackURL,
        ];

        $url = "{$this->endpoint}/create";

        $headers = $this->getHeader();

        $response = Http::withHeaders($headers)->post($url, $body);
        $response = json_decode($response, true);

        return $response;
    }

    public function executePayment($paymentID)
    {
        $url = "{$this->endpoint}/execute";

        $headers = $this->getHeader();

        $body = [
            'paymentID' => $paymentID
        ];

        $response = Http::withHeaders($headers)->post($url, $body);
        $response = json_decode($response, true);

        return $response;
    }

    public function queryPayment($agreementID)
    {
        $url = "{$this->endpoint}/agreement/status";

        $headers = $this->getHeader();

        $body = [
            'agreementID' => $agreementID
        ];

        $response = Http::withHeaders($headers)->post($url, $body);
        $response = json_decode($response, true);

        return $response;
    }

    public function searchTransaction($trxID)
    {
        $url = "{$this->endpoint}/general/searchTransaction";

        $headers = $this->getHeader();

        $body = [
            'trxID' => $trxID
        ];

        $response = Http::withHeaders($headers)->post($url, $body);
        $response = json_decode($response, true);

        return $response;
    }

    public function refundTransaction($paymentID, $amount, $trxID, $sku, $reason)
    {
        $url = "{$this->endpoint}/payment/refund";

        $headers = $this->getHeader();

        $body = [
            'paymentID' => $paymentID,
            'amount'    => $amount,
            'trxID'     => $trxID,
            'sku'       => $sku,
            'reason'    => $reason
        ];

        $response = Http::withHeaders($headers)->post($url, $body);
        $response = json_decode($response, true);

        return $response;
    }

    public function refundStatus($paymentID, $trxID)
    {
        $url = "{$this->endpoint}/payment/refund";

        $headers = $this->getHeader();

        $body = [
            'paymentID' => $paymentID,
            'trxID'     => $trxID
        ];

        $response = Http::withHeaders($headers)->post($url, $body);
        $response = json_decode($response, true);

        return $response;
    }

    public function getHeader()
    {
        $token = "{$this->token['token_type']} {$this->token['id_token']}";

        $headers = [
            "Accept" => "application/json",
            "Content-Type"  => "application/json",
            "Authorization" => $token,
            "X-APP-Key"     => $this->appKey
        ];

        return $headers;
    }
}