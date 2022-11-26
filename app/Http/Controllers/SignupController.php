<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;

class SignupController extends Controller
{
    //
    public function show()
    {
        return view('components.signup', ['isAlreadySignUp' => false]);
    }

    public function register(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        
        $roleId = 0;
        // Получение выбранной роли пользователем
        $choosenRole = $request->input('role');
        foreach ($choosenRole as $roleName => $value) 
        {
            $roleId = Roles::ROLES[$roleName];
        }

        if(User::where('email', '=', $email)->get()->count() == 0)
        {
            // Нет пользователя с таким email
            $newUser = new User();
            $newUser->email = $email;
            $newUser->password = $password;
            $newUser->role_id = $roleId;
            $newUser->created_at = time();
            $newUser->updated_at = time();
            $newUser->save();
            return redirect()->route('home');
        }
        else
        {
            return view('components.signup', ['isAlreadySignUp' => true]);
        }
    }
}
