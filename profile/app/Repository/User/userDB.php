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

    public function updateData()
    {
    }
}
