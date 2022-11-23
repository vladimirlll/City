<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Role;
use App\Models\Skill;

class Skill_UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $skillsCount =      Skill::all()->count();
        $specialistsCount = User::where('role_id', '=', 
                            Role::where('name', '=', 'Специалист')->get()[0]->id)->get()->count();

        return [
            //
            'skill_id' => rand(1, $skillsCount),
            'specialist_id' => rand(1, $specialistsCount),
            'created_at' => time(),
            'updated_at' => time(),
        ];
    }
}
