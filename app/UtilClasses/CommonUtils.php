<?php

namespace App\UtilClasses;

class CommonUtils
{
    public static function response($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'result'  => $result,
            'msg'     => $message,
            'code'    => $code
        ];
        return response()->json($response, 200);
    }

    public static function error($result, $message, $code = 201)
    {
        $response = [
            'success' => false,
            'result'  => $result,
            'msg'     => $message,
            'code'    => $code
        ];
        return response()->json($response, 200);
    }
}