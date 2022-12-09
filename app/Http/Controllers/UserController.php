<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\Apply_User;
use App\Models\ApplyStatuses;
use App\Models\Role;
use App\Models\Skill_User;
use App\Models\Specialization_User;
use App\Models\User;
use App\Models\Zoom_Api;
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

    function getMetting($response) // возвращаем инфу про митинг
    {
        return "Meeting ID: ". $response->id."<br>"."Time: "	
        . $response->start_time."<br>"."Topic: "	. 
        $response->topic."<br>"."Join URL: ". $response->join_url .
        "<a href='". $response->join_url ."'>Open URL</a>"."<br>"."Meeting Password: ". $response->password;
    }

    public function review($myId, $anotherId)
    {
        echo 'review from '. $myId . ' to '. $anotherId;
    }

    public function send($myId, $anotherId)
    {
        if(Auth::check())
        {
            // - Пользователь авторизован
            if(Auth::user()->id == $myId)
            {
                $me = User::findOrFail($myId);

                $myApplies = $me->applies();
                $myAppliesCount = $myApplies->count();
                $i = 0;
                $hasFreshApplyAlready = false;

                while($i < $myAppliesCount && !$hasFreshApplyAlready)
                {
                    if($myApplies[$i]->status != ApplyStatuses::STATUSES['ended'])
                        $hasFreshApplyAlready = true;
                    else
                        $i++;
                }

                if(!$hasFreshApplyAlready)
                {
                    $newApply = new Apply;
                    $newApply->id = null;
                    $newApply->status = ApplyStatuses::STATUSES['sended'];
                    $newApply->save();


                    $newApplyUser = new Apply_User;
                    $newApplyUser->id = null;
                    $newApplyUser->customer_id = $myId;
                    $newApplyUser->specialist_id = $anotherId;
                    $newApplyUser->apply_id = $newApply->id;
                    $newApplyUser->created_at = time();
                    $newApplyUser->updated_at = time();
                    $newApplyUser->save();
                    return view('components.user.applies.sended.sended'); 
                }
                else
                {
                    return view('components.user.applies.notsended.already-has-active-session');
                }


            }
            else abort(404);
        }
        else abort(404);
        /*
        $zoom_meeting = new Zoom_Api();

        // входные данные
        $data = array();
        $data['topic'] 		= 'Consultation'; // название конференции
        $data['start_date'] = date('Y-m-d\TH:i:s', strtotime("2022-12-12T12:00"));
        $data['duration'] 	= 60; // продолжительность
        $data['type'] 		= 2;
        $password = function() // функция генерации пароля
        {
        $label = ["q","w","e","r","t", "y", "u", "i","o","p","a","s","d","f","g","h","j","k","l","z","x","c","v","b","n","m"];
        return "".rand(10,99).$label[rand(0, 25)].rand(10,99);;
        };
        $data['password'] 	= $password(); //пароль


        $response = $zoom_meeting->createMeeting($data);//создаём митинг
        // print_r($response);
        // echo "<br>";
        // if (isset($response->id))
        // 	echo 'sozdano';
        // else
        // 	echo 'net';
        //echo (isset($response->id));
        echo "<br>";
        echo $this->getMetting($response); // выводим митинг на экран
        */
    }

    public function showConsultations($id)
    {
        $title = "";
        $user = User::findOrFail($id);
        if(Auth::check())
        {
            if(Auth::user()->id == $id)
            {
                if(!empty($user->name))
                {
                    //echo 'name';
                    $title .= $user->name;
                }
                else 
                {
                    $title .= $user->email;
                }
            }
            else abort(404);
        }
        else abort(404);

        return view('components.user.consultations', ['user' => $user, 'title' => $title]);
    }
}
