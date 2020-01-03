<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Repository\Sms\SMSNotifierFactory;
use App\Repository\User\userDB;

class UserController extends Controller
{
    public function setOTP(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required|string',
        ]);
        $userFunctions = new userDB;
        $existUser = $userFunctions::getUserData($request->phoneNumber);
        if ($existUser) {
            $OTP_code = Self::codeGeneration(4);
            $sms = new SMSNotifierFactory($request->phoneNumber, $OTP_code);
            // if sms sent --> update query --> put if condition here * * * * * * * * * * * * * * * * * * * * * * *
            $OTP = $userFunctions::updateOTP($request->phoneNumber, $OTP_code);
            if ($OTP) {
                return response()->json(["sms code" => Hash::make($OTP_code), "status" => "sent successFully", "success" => "1"], 201);
            } else {
                return response()->json(["sms code" => Hash::make($OTP_code), "status" => "fail to update", "success" => "2"], 404);
            }

            // end if sms sent --> update query --> put if condition here * * * * * * * * * * * * * * * * * * * * * * *
        } else {
            return response()->json(["user" => "not exist"], 404);
        }
    }
    public function codeGeneration($count)
    {
        $characters = '123456789';
        $randomString = '';

        for ($i = 0; $i < $count; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }
}
