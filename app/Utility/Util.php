<?php

namespace App\Utility;

class Util
{
    public static function response($data, $message, $code)
    {
        return response()->json([
            'result'  => $data,
            'message' => $message,
            'code'    => $code,
            'success' => true
        ]);
    }

    public static function error($data, $message, $code)
    {
        return response()->json([
            'result'  => $data,
            'message' => $message,
            'code'    => $code,
            'success' => false
        ]);
    }
}