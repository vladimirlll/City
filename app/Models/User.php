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
        return $this->belongsTo(Role::class);
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

    public function applies()
    {
        $applyUserCol = null;
        if($this->role->name == 'customer')
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
}
