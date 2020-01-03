<?php

namespace App\Repository\User;

use Illuminate\Support\Facades\Hash;

use App\User;

class userDB implements userInterFace
{
    public function register()
    {
    }

    public static function updateOTP($phoneNumber, $OTPCode)
    {
        $user = new User();
        $toUpdateOTP = $user::where('phone_number', $phoneNumber)->first();
        $toUpdateOTP->OTP = Hash::make($OTPCode);
        return $toUpdateOTP->save();
    }

    public static function ifUserExistByPhoneNumber($phoneNumber)
    {
        $user = new User();
        return $user::where('phone_number', $phoneNumber)->exists();
    }

    public static function getUserData($phoneNumber)
    {
        $user = new User();
        return $user::where('phone_number', $phoneNumber)->first();
    }

    public function updateData()
    {
    }
}
