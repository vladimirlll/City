<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\Apply_User;
use App\Models\ApplyStatuses;
use App\Models\Auth;
use App\Models\Role;
use App\Models\Skill_User;
use App\Models\Specialization_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    
    public function show(Request $request, $id)
    {
        if(Auth::check())
        {
            $user = User::getInstance($id);
    
            $title = $user->getOutName();
    
            return view('components.user.page', ['user' => $user, 'title' => $title]);
        }
        else return redirect()->route('login');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $title = $user->getOutName();

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

    public function send($myId, $anotherId)
    {
        if(Auth::check())
        {
            // - Пользователь авторизован
            if(Auth::user()->id == $myId)
            {
                $me = User::findOrFail($myId);

                $myApplies = $me->getApplies();
                $myAppliesCount = $myApplies->count();
                $i = 0;
                $hasFreshApplyAlready = false;

                while($i < $myAppliesCount && !$hasFreshApplyAlready)
                {
                    if($myApplies[$i]->status != ApplyStatuses::STATUSES['ended'] && $myApplies[$i]->apply_user()->specialist_id == $anotherId)
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
    }

    public function showConsultations($id)
    {
        $user = User::findOrFail($id);
        if(Auth::check())
        {
            if(Auth::user()->id == $id)
            {
                $title = $user->getOutName();

                return view('components.user.consultations', ['user' => $user, 'title' => $title]);
            }
            else abort(404);
        }
        else abort(404);
        
    }
}
