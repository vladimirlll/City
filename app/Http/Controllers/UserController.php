<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Skill_User;
use App\Models\Specialization_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
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

    private function getItemsToAdd(array $selectedItems, Collection $userItems) : array
    {
        $toAdd = array();

        foreach($selectedItems as $selected)
        {
            if($userItems->doesntContain(function($value, $key) use($selected)
            {
                return $value == $selected;
            }))
                $toAdd[] = $selected;
        }

        return $toAdd;
    }

    private function getItemsToDelete($selectedItems, Collection $userItems) : array 
    {
        $toDelete = array();

        foreach($userItems as $existingItem)
        {
            if(!in_array($existingItem, $selectedItems))
                $toDelete[] = $existingItem;
        }

        return $toDelete;
    }

    private function addSkills(User $user, array $skillsIds)
    {
        foreach($skillsIds as $skillId)
        {
            $newSkillUser = new Skill_User;
            $newSkillUser->id = null;
            $newSkillUser->skill_id = $skillId;
            $newSkillUser->specialist_id = $user->id;
            $newSkillUser->created_at = time();
            $newSkillUser->updated_at = time();
            $newSkillUser->save();
        }
    }

    private function deleteSkills(User $user, array $skillIds)
    {
        foreach($skillIds as $skillId)
        {
            Skill_User::where('skill_id', $skillId)->where('specialist_id', $user->id)->delete();
        }
    }

    private function addSpecs(User $user, array $specsIds)
    {
        foreach($specsIds as $specId)
        {
            $newSpecUser = new Specialization_User();
            $newSpecUser->id = null;
            $newSpecUser->specialization_id = $specId;
            $newSpecUser->specialist_id = $user->id;
            $newSpecUser->created_at = time();
            $newSpecUser->updated_at = time();
            $newSpecUser->save();
        }
    }

    private function deleteSpecs(User $user, array $specsIds)
    {
        foreach($specsIds as $specId)
        {
            Specialization_User::where('specialization_id', $specId)->where('specialist_id', $user->id)->delete();
        }
    }

    public function save($id, Request $request)
    {
        if(Auth::check())
        {
            // - Пользователь авторизован
            if(Auth::user()->id == $id)
            {
                // - Сохраняем того пользователя, который сейчас авторизован
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
                $user->city_id = is_null($request->input('city'))? null : $request->input('city')[0];
                $user->birth_date = $request->input('bday');

                if($user->role_id == Role::where('name', '=', 'specialist')->get()[0]->id)
                {
                    // Сохраняем специалиста
                    $user->portfolio = $validated['portfolio'];
                    $selectedSkills = $request->input('skill') ?? array();
                    $selectedSpecs = $request->input('spec') ?? array();
                    $userSkills = Skill_User::where('specialist_id', '=', $user->id)->get()->pluck('skill_id');
                    $userSpecs = Specialization_User::where('specialist_id', '=', $user->id)->get()->pluck('specialization_id');

                    $skillsToAdd = $this->getItemsToAdd($selectedSkills, $userSkills);
                    $skillsToDelete = $this->getItemsToDelete($selectedSkills, $userSkills);

                    $specsToAdd = $this->getItemsToAdd($selectedSpecs, $userSpecs);
                    $specsToDelete = $this->getItemsToDelete($selectedSpecs, $userSpecs);

                    $this->addSkills($user, $skillsToAdd);
                    $this->deleteSkills($user, $skillsToDelete);
                    $this->addSpecs($user, $specsToAdd);
                    $this->deleteSpecs($user, $specsToDelete);

                    //dump($userSpecs);
                    //dump($userSkills);

                    //dump($this->getItemsToAdd($selectedSkills, $userSkills));
                    //dump($this->getItemsToDelete($selectedSkills, $userSkills));


                    /*if($selectedSkills != null)
                    {
                        // Есть выбранные навыки
                        $userSkills = Skill_User::where('specialist_id', '=', $user->id)->get();
                        foreach($selectedSkills as $skill)
                        {
                            echo "Обрабатываем скилл - " . $skill . "<br>";
                            $isAlreadyHas = false;
                            $i = 0;
                            $userSkillsCount = count($userSkills);
                            while($i < $userSkillsCount && !$isAlreadyHas)
                            {
                                echo "Сверяем с юзерским скиллом - " . $userSkills[$i]->skill_id . ": ";
                                if($userSkills[$i]->skill_id == $skill)
                                {
                                    echo "Совпадает с обрабатываемым, поэтому не добавляем дубликат <br>";
                                    $isAlreadyHas = true;
                                }
                                else
                                {
                                    echo "Не совпадает <br>";
                                }
                                ++$i;
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
                    }

                    if($selectedSpecs != null)
                    {
                        // Есть выбранные специальности
                        $userSpecs = Specialization_User::where('specialist_id', '=', $user->id)->get();
                        foreach($selectedSpecs as $spec)
                        {
                            echo "Обрабатываем специальность - " . $spec . "<br>";
                            $isAlreadyHas = false;
                            $i = 0;
                            $userSpecsCount = count($userSpecs);
                            while($i < $userSpecsCount && !$isAlreadyHas)
                            {
                                echo "Сверяем с юзерской специальностью - " . $userSpecs[$i]->specialization_id . ": ";
                                if($userSpecs[$i]->specialization_id == $spec)
                                {
                                    echo "Совпадает с обрабатываемой, поэтому не добавляем дубликат <br>";
                                    $isAlreadyHas = true;
                                }
                                else
                                {
                                    echo "Не совпадает <br>";
                                }
                                ++$i;
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
                    }*/
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
