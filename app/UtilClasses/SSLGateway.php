<?php

namespace App\UtilClasses;

use Illuminate\Support\Facades\Http;

class SSLGateway
{
    private $endpoint;
    private $storeID;
    private $storePassword;
    private $callbackSuccess;
    private $callbackFail;
    private $callbackCancel;

    function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->endpoint        = config("payment_gateways.ssl.endpoint");
        $this->storeID         = config("payment_gateways.ssl.store_id");
        $this->storePassword   = config("payment_gateways.ssl.store_password");
        $this->callbackSuccess = config('payment_gateways.ssl.callback_success');
        $this->callbackFail    = config('payment_gateways.ssl.callback_fail');
        $this->callbackCancel  = config('payment_gateways.ssl.callback_cancel');
        $this->callbackIPN     = config('payment_gateways.ssl.callback_ipn');
    }

    public function requestSession(
        $amount, $trxID, $productCategory, $customerName, $customerEmail, $customerAddress,
        $customerCity, $customerPostcode, $custpmerCountry, $customerPhone, $items,
        $productName, $productProfile, $multiCardName
    )
    {
        $endpoint = "{$this->endpoint}/gwprocess/v4/api.php";

        $params = [
            "store_id"         => $this->storeID,
            "store_passwd"     => $this->storePassword,
            "total_amount"     => $amount,
            "currency"         => "BDT",
            "tran_id"          => $trxID,
            "product_category" => $productCategory,
            "success_url"      => $this->callbackSuccess,
            "fail_url"         => $this->callbackFail,
            "cancel_url"       => $this->callbackCancel,
            "ipn_url"          => $this->callbackIPN,
            "emi_option"       => 0,
            "cus_name"         => $customerName,
            "cus_email"        => $customerEmail,
            "cus_add1"         => $customerAddress,
            "cus_city"         => $customerCity,
            "cus_postcode"     => $customerPostcode,
            "cus_country"      => $custpmerCountry,
            "cus_phone"        => $customerPhone,
            "shipping_method"  => 'NO',
            "num_of_item"      => $items,
            "product_name"     => $productName,
            "product_profile"  => $productProfile,
            "multi_card_name"  => $multiCardName,
        ];

       $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $endpoint);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($curl);

        curl_close($curl);

        $data = json_decode($data, true);

        return $data;
    }
}