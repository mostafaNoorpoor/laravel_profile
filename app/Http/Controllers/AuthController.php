<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\UserRepository;

class AuthController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user )
    {
        $this->user = $user;
    }

    public function signUp(Request $request)
    {

    }

    public function logIn(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',
            'OTP' => 'required|string',
        ]);

        $logIn = $this->user->getUserData($request->phone_number , $request->OTP);

        if ($logIn['success'] == 1){

            // hash checked and it is match

            $token = Self::createTokenPassport($request->phone_number , $request->OTP);

        } else if ($logIn['success']  == 2){

            // hash checked and it not match

            $token= 'not match';

        } else if ($logIn['success']  == 3){

            // user not found with this number --> call register screen

            $token = 'user not found';

        }

        return $token ;

    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function createTokenPassport($phoneNumber, $OTP)
    {
        $guzzle = new \GuzzleHttp\Client;

        $secretToken = 'FWfJccIkeHz59KmJAGc1Wc5L3S3MvNIDEl7psH2U' ;

        $clientId = '2' ;

        $response = $guzzle->post(url('/oauth/token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $clientId,
                'client_secret' => $secretToken,
                'username'      => $phoneNumber,
                'password'      => $OTP
            ],
        ]);

        return $response ;
    }

    public function userData(Request $request)
    {
        return $request->user();
    }
}
