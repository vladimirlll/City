<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Specialist extends User
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';

    public function getRoleName() { return "Специалист"; }

    public static function getAllBuilder()
    {
        return Specialist::where('role_id', Roles::ROLES['specialist']);
    }

    public function getMySpecializations()
    {
        $specializationsOfUserConnectors = Specialization_User::where('specialist_id', '=', $this->id)->get();
        $specializations = collect();
        foreach($specializationsOfUserConnectors as $connector)
        {
            $spec = Specialization::find($connector->specialization_id);
            $specializations->push($spec);
        }

        return $specializations;
    }

    public function getMySkills()
    {
        $skillsOfUserConnectors = Skill_User::where('specialist_id', '=', $this->id)->get();
        $skills = collect();
        foreach ($skillsOfUserConnectors as $skillOfUserConnector) 
        {
            $skill = Skill::find($skillOfUserConnector->skill_id);
            $skills->push($skill);
        }

        return $skills;
    }
}
