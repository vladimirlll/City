<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Skill_User;
use App\Models\Specialization_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function show($id)
    {
        $title = "";
        $user = User::findOrFail($id);
        if(!empty($user->name))
        {
            //echo 'name';
            $title .= $user->name;
        }
        else 
        {
            $title .= $user->email;
        }

        return view('components.user.page', ['user' => $user, 'title' => $title]);
    }

    public function edit($id)
    {
        $title = "";
        $user = User::findOrFail($id);
        if(!empty($user->name))
        {
            $title .= $user->name;
        }
        else 
        {
            $title .= $user->email;
        }

        return view('components.user.edit', ['user' => $user, 'title' => $title]);
    }

    public function save($id, Request $request)
    {
        if(Auth::check())
        {
            if(Auth::user()->id == $id)
            {
                $validated = $request->validate
                (
                    [
                        'name' => 'max:20',
                        'surname' => 'max:20',
                        'patronymic' => 'max:20',
                        'about' => 'max:250',
                        'portfolio' => 'max:400'
                    ]
                );

                $user = User::findOrFail($id);
                $user->name = $validated['name'];
                $user->surname = $validated['surname'];
                $user->patronymic = $validated['patronymic'];
                $user->about = $validated['about'];
                $user->city_id = $request->input('city')[0];
                $user->birth_date = $request->input('bday');
                

                if($user->role_id == Role::where('name', '=', 'specialist')->get()[0]->id)
                {
                    $user->portfolio = $validated['portfolio'];
                    $selectedSkills = $request->input('skill');
                    $selectedSpecs = $request->input('spec');

                    $userSkills = Skill_User::where('specialist_id', '=', $user->id)->get();
                    foreach($selectedSkills as $skill)
                    {
                        $isAlreadyHas = false;
                        $i = 0;
                        $userSkillsCount = count($userSkills);
                        while($i < $userSkillsCount && !$isAlreadyHas)
                        {
                            if($userSkills[$i]->skill_id == $skill)
                            {
                                $isAlreadyHas = true;
                            }
                        }
                        if(!$isAlreadyHas)
                        {
                            $newSkillUser = new Skill_User;
                            $newSkillUser->id = null;
                            $newSkillUser->skill_id = $skill;
                            $newSkillUser->specialist_id = $user->id;
                            $newSkillUser->created_at = time();
                            $newSkillUser->updated_at = time();
                            $newSkillUser->save();
                        }
                    }

                    $userSpecs = Specialization_User::where('specialist_id', '=', $user->id)->get();
                    foreach($selectedSpecs as $spec)
                    {
                        $isAlreadyHas = false;
                        $i = 0;
                        $userSpecsCount = count($userSpecs);
                        while($i < $userSpecsCount && !$isAlreadyHas)
                        {
                            if($userSpecs[$i]->specialization_id == $spec)
                            {
                                $isAlreadyHas = true;
                            }
                        }
                        if(!$isAlreadyHas)
                        {
                            $newSpecUser = new Specialization_User();
                            $newSpecUser->id = null;
                            $newSpecUser->specialization_id = $spec;
                            $newSpecUser->specialist_id = $user->id;
                            $newSpecUser->created_at = time();
                            $newSpecUser->updated_at = time();
                            $newSpecUser->save();
                        }
                    }
                }
                $user->updated_at = time();
                $user->save();

                return back();
            }
            else
            {
                abort(404);
            }
        }
        else 
        {
            abort(404);            
        }


    }

    public function send($id)
    {
        echo 'send/' . $id;

    }
}
