<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;

class SignupController extends Controller
{
    //
    public function show()
    {
        return view('components.signup.page', ['isAlreadySignUp' => false]);
    }

    public function register(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        
        $roleId = 0;
        // Получение выбранной роли пользователем
        $choosenRole = $request->input('role');
        $roleId = Roles::ROLES[$choosenRole];

        if(DB::table('users')->where('email', $email)->get()->count() == 0)
        {
            // Нет пользователя с таким email

            $className = "App\\Models\\";
            $className .= ucfirst(Roles::getNameOfNum($roleId));
            $newUser = new $className();
            $newUser->email = $email;
            $newUser->password = Hash::make($password);
            $newUser->role_id = $roleId;
            $newUser->created_at = time();
            $newUser->updated_at = time();
            $newUser->save();
            $newUser = User::getInstance($newUser->id);

            $credentials = $request->validate
            (
                [
                    'email' => ['required', 'email'],
                    'password' => ['required'],
                ]
            );

            if (Auth::attempt($credentials, false)) 
            {

                $request->session()->regenerate();

                return redirect()->route('home');
            }
            return back();
        }
        else
        {
            return back()->with('isAlreadySignUp', true);
            //return view('components.signup', ['isAlreadySignUp' => true]);
        }
    }
}
