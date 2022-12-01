<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        if(User::where('email', '=', $email)->get()->count() == 0)
        {
            // Нет пользователя с таким email
            $newUser = new User();
            $newUser->email = $email;
            $newUser->password = Hash::make($password);
            $newUser->role_id = $roleId;
            $newUser->created_at = time();
            $newUser->updated_at = time();
            $newUser->save();
            $newUser = User::where('email', '=', $email)->get()[0];
            Auth::login($newUser);
            return redirect()->route('home');
        }
        else
        {
            return view('components.signup', ['isAlreadySignUp' => true]);
        }
    }
}
