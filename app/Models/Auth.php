<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        else return null;
    }

    public static function attempt($credentials, $remember)
    {
        $builder = DB::table('users');

        foreach($credentials as $field => $val)
        {
            if($field != 'password' && $field != 'email') return false;
        }
        
        $builder->where('email', '=', $credentials['email']);
        $user = $builder->first();

        if(is_null($user)) return false;
        else
        {
            if(Hash::check($credentials['password'], $user->password))
            {
                session([Auth::AUTH_USER_KEY => $user->id]);
                return true;
            }
            return false;
        }
    }

    public static function logout()
    {
        session([Auth::AUTH_USER_KEY => null]);
    }
}
