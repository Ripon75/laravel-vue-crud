<?php

use App\UtilClasses\Bkash;
use App\UtilClasses\SMSGateway;
use App\UtilClasses\SSLGateway;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\Frontend\AuthController;

// sms gateway test route
Route::get('/sms/send', function() {
    $smsGateway = new SMSGateway();
    return $smsGateway->sendByREVE('01764997485', 'Hello');
});

// ssl payment gateway test route
Route::get('/ssl/payment', function() {

    $sslGateway = new SSLGateway();

    $paymentResponse = $sslGateway->requestSession(
        100, 1, "ProductCategory", "Productname", "general",
        "Ripon", "ripon@gmail.com", "Malibagh", "City", "0000", "Bangladesh", "01764997485",
        3, ""
    );

    $paymentResponseStatus = $paymentResponse['status'];

    if ($paymentResponseStatus === 'SUCCESS') {
        $redirectGatewayURL = $paymentResponse['redirectGatewayURL'];
        // Redirect outside of my project route
        return redirect()->away($redirectGatewayURL);
    } else {
        return redirect()->route('callback.ssl.payment',['fail']);
    }
});

// bKash payment gateway tesy
// get token
Route::get('/bkash/payment/token', function() {
    $bakash = new Bkash();

    return $bakash->getToken();
});

// create payment
Route::get('/bkash/payment/create', function() {
    $bakash = new Bkash();

    $response = $bakash->createPayment('100', 1, '01764997485');

    if ($response['statusCode'] === '0000') {
        $bkashURL = $response['bkashURL'];

        return redirect()->away($bkashURL);
    } else {
        return "Failed";
    }
});

// create execute
Route::get('/bkash/payment/execute', function() {
    $bakash = new Bkash();

    return $bakash->executePayment();
});

// Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
