<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticatableTrait;

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function role()
    {
        return Role::find($this->role_id);
    }

    public function skill_user()
    {
        return $this->belongsTo(Skill_User::class);
    }

    public function specialization_user()
    {
        return $this->belongsTo(Specialization_User::class);
    }

    public function apply_user()
    {
        return $this->belongsTo(Apply_User::class);
    }

    public function getApplies()
    {
        $applyUserCol = null;
        if($this->role()->name == 'customer')
        {
            $applyUserCol = Apply_User::where('customer_id', $this->id)->get();
        }
        else
        {
            $applyUserCol = Apply_User::where('specialist_id', $this->id)->get();
        }

        $applies = collect();
        foreach($applyUserCol as $applyUser)
        {
            $apply = Apply::find($applyUser->apply_id);
            $applies->push($apply);
        }

        return $applies;
    }

    public function getOutName() 
    {
        $result = "";
        if(!empty($this->surname) && !empty($this->name) && !empty($this->patronymic))
        {
            $result = $this->surname . " " . mb_substr($this->name, 0, 1, "UTF-8") . ". " . mb_substr($this->patronymic, 0, 1, "UTF-8") . ".";
        }
        else 
        {
            $result = $this->email;
        }
        return $result;
    }
}
