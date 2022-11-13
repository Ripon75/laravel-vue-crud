<?php

use App\UtilClasses\Bkash;
use App\UtilClasses\Nagad;
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

// bKash payment gateway test
Route::get('/bkash/test', function() {
    $bakash = new Bkash();

    return $bakash->getToken();
});

// Nagad pg test
Route::get('/nagad/test', function() {
    $nagad = new Nagad();

    // return $nagad->generateRandomString();

    // return $nagad->encryptDataWithPublicKey("I Love U");
    // return $nagad->decryptDataByPrivateKey();
     $_SESSION['orderId'] = "Medicart1";
    return $nagad->nagadPaymentRequest("Medicart1", 100);
});

// Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
