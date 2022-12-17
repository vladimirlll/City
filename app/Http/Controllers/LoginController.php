<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function show()
    {
        $authUser = null;
        if(Auth::check()) $authUser = Auth::user();
        return view('components.login.page', ['authUser' => $authUser]);
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

            return redirect()->route('home');
        }

        return back()->withErrors
        (
            [
                'email' => 'The provided credentials do not match our records.',
            ]
        )->onlyInput('email');
        
    }
}
