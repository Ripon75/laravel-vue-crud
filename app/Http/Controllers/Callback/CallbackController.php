<?php

namespace App\Http\Controllers\Callback;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use App\Http\Controllers\Controller;

class CallbackController extends Controller
{
    public function SSLCallback(Request $request, $type)
    {
        // Check ssl trxid
        // $trxID  = $request->input("tran_id");
        // $status = $request->input("status");

        // $error          = $request->input("error");
        // $bankTranId     = $request->input("bank_tran_id");
        // $currency       = $request->input("currency");
        // $tranDate       = $request->input("tran_date");
        // $amount         = $request->input("amount");
        // $storeId        = $request->input("store_id");
        // $currencyType   = $request->input("currency_type");
        // $currencyAmount = $request->input("currency_amount");
        // $currencyRate   = $request->input("currency_rate");
        // $baseFair       = $request->input("base_fair");
        // $valueA         = $request->input("value_a");
        // $valueB         = $request->input("value_b");
        // $valueC         = $request->input("value_c");
        // $valueD         = $request->input("value_d");
        // $verifySign     = $request->input("verify_sign");
        // $verifySignSha2 = $request->input("verify_sign_sha2");
        // $verifyKey      = $request->input("verify_key");

        // $paymentTrxObj = PaymentTransaction::find($trxID);

        // if ($paymentTrxObj) {
        //     $orderID  = $paymentTrxObj->order_id;
        //     $orderObj = Order::find($orderID);

        //     if($status === "VALID") {
        //         $paymentTrxObj->status = "success";
        //         $orderObj->is_paid     = true;
        //     } elseif ($status === "FAILED"){
        //         $paymentTrxObj->status = "failed";
        //     } else {
        //         $paymentTrxObj->status = "cancel";
        //     }

        //     $paymentTrxObj->save();
        //     $orderObj->save();
        // }

        if ($type === 'success') {
            // return success view
            return 'Success';
        } elseif ($type === 'fail') {
            // return failed view
            return 'Failed';
        } elseif ($type === 'cancel'){
            // return cancel view
            return 'Cancel';
        } elseif ($type === 'ipn') {
            // return IPN view
            return 'IPN';
        } else {
            // return failed view
            return 'Failed';
        }
    }
}
