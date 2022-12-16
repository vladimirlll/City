<?php

namespace App\Models;

use Illuminate\Http\Request;

class Auth 
{
    public const AUTH_USER_KEY = "authUserId";

    public static function check()
    {
        return !(is_null(session(Auth::AUTH_USER_KEY)));
    }

    public static function user()
    {
        if(Auth::check())
        {
            $user = User::getInstance(session(Auth::AUTH_USER_KEY));
            return $user;
        }
    }
}
