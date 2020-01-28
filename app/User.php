<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cmgmyr\Messenger\Traits\Messagable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable
{
    use Notifiable , Messagable , HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function findForPassport($username)
    {
        return $this->where('phone_number', $username)->first();
    }

    public function validateForPassportPasswordGrant($password)
    {
        return (Hash::check($password, $this->OTP));
    }
    // this is hook slack url
    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
    }
}
