<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Repository\generateToken\Passport;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'family_name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|string',
        ]);
        //$register = new UserRegister; must update class <<<<---
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
    public function logIn(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required|string',
            'OTP' => 'required|string',
        ]);
        $user = new User();
        $logIn = $user::where('phone_number', $request->phoneNumber)->first();
        if (Hash::check($request->OTP, $logIn->OTP)) {
            $generateGrantToken = new Passport;
            $tokens = $generateGrantToken::createTokenPassport($request->phoneNumber, $request->OTP);
            return $tokens;
        } else {
            return response()->json([
                'message' => 'not match'
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function userData(Request $request)
    {
        return response()->json($request->user());
    }
}
