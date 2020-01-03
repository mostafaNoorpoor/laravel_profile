<?php

namespace App\Repository\GeneralResponse;

class Response
{
    protected $message;
    protected $success;

    public static function success($message, $success)
    {
        //  return response()->json(['data' => $this->message], 200);
    }
    public static function fail($message, $success)
    {
        //  return response()->json(['data' => $this->message], 404);
    }
}
