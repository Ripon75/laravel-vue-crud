<?php

use Illuminate\Support\Facades\Route;
// use App\UtilClasses\SMSGateway;
use App\UtilClasses\SSLGateway;

// sms gateway test route
// Route::get('/sms/send', function() {
//     $smsGateway = new SMSGateway();
//     return $smsGateway->sendByREVE('01764997485', 'I Love you jan');
// });

// payment gateway test route
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
        return redirect()->route('callback.payment_ssl',['fail']);
    }

});

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
