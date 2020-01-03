<?php

namespace App\Repository\generateToken;

class Passport
{
    protected $secret_token;
    protected $client_id ;

    public static function createTokenPassport($phoneNumber , $OTP)
    {
        $secret_token = 'zaqk2PoAj38leCfqykIwXgR5Uy5JQNW3l2DjZgen';
        $client_id = '2';
        $guzzle = new \GuzzleHttp\Client;

        $response = $guzzle->post(url('/oauth/token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $client_id,
                'client_secret' => $secret_token,
                'username'      => $phoneNumber,
                'password'      => $OTP
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
