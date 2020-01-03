<?php

namespace App\Repository\User;

interface userInterFace
{
    public function register();

    public static function updateOTP($phoneNumber, $OTPCode);

    public function updateData();

    public static function ifUserExistByPhoneNumber($phoneNumber);

    public static function getUserData($phoneNumber);
}
