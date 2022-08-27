<?php

namespace App\Utility;

class Util
{
    public static function response($data, $message, $code = 200)
    {
        return response()->json([
            'result'  => $data,
            'msg'     => $message,
            'code'    => $code,
            'success' => true
        ]);
    }

    public static function error($data, $message, $code = 202)
    {
        return response()->json([
            'result'  => $data,
            'msg'     => $message,
            'code'    => $code,
            'success' => false
        ]);
    }
}