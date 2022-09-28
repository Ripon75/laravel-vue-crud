<?php

use Illuminate\Support\Facades\Route;
use App\UtilClasses\SMSGateway;

Route::get('/sms/send', function() {
    $smsGateway = new SMSGateway();
    return $smsGateway->sendByREVE('01764997485', 'I Love you jan');
});

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
