<?php

namespace App\Repository;

interface UserRepository
{
    public function registerUSer($name, $familyName, $phoneNumber, $email);

    public function updateOTP($phoneNumber, $OTPCode);

    public function updateData();

    public function ifUserExistByPhoneNumber($phoneNumber);

    public function getUserData($phoneNumber , $OTP);

}
