<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function show()
    {
        return view('components.login.page');
    }

    public function auth(Request $request)
    {
        
        $remember = (bool)$request->input('remember');

        $credentials = $request->validate
        (
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]
        );
        
        if (Auth::attempt($credentials, $remember)) 
        {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors
        (
            [
                'email' => 'The provided credentials do not match our records.',
            ]
        )->onlyInput('email');
    }
}
