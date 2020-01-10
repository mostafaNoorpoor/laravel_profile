<?php

namespace App\Repository;

use App\User;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class UserImplement implements UserRepository
{
    protected $user ;
    public function __construct(User $user)
    {
        $this->user = $user ;
    }

    public function registerUSer($name, $familyName, $phoneNumber, $email)
    {

    }

    public function updateOTP($phoneNumber, $OTPCode)
    {

    }

    public function ifUserExistByPhoneNumber($phoneNumber)
    {

    }

    public function getUserData($phoneNumber , $OTP)
    {
        if ($userData = $this->user::where('phone_number', $phoneNumber)->first()){

            if (Hash::check($OTP, $userData->OTP)) {

                // hash checked and it is match

                $success = '1';

            } else {

                // hash checked and it not match

                $success = '2';

            }

        } else {

            // user not found with this number --> call register screen

            $success = '3';
        }

        return $success ;

    }

    public function updateData()
    {

    }
}
