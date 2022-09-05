<?php

namespace App\Utility;

class Util
{
    public static function response($result, $message, $code = 200)
    {
        // return response()->json([
        //     'result'  => $data,
        //     'msg'     => $message,
        //     'code'    => $code,
        //     'success' => true
        // ]);
        $response = [
            'success' => true,
            'result'  => $result,
            'msg'     => $message,
            'code'    => $code
        ];
        return response()->json($response, 200);
    }

    public static function error($result, $message, $code = 202)
    {
        // return response()->json([
        //     'result'  => $data,
        //     'msg'     => $message,
        //     'code'    => $code,
        //     'success' => false
        // ]);

        $response = [
            'success' => false,
            'result'  => $result,
            'msg'     => $message,
            'code'    => $code
        ];
        return response()->json($response, 200);
    }
}