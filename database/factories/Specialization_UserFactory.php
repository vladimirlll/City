<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class Specialization_UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $specializationsCount = Specialization::all()->count();
        $specialistsCount = User::where('role_id', '=', 
                            Role::where('name', '=', 'Специалист')->get()[0]->id)->get()->count();

        return [
            //
            'specialization_id' => rand(1, $specializationsCount),
            'specialist_id' => rand(1, $specialistsCount),
            'created_at' => time(),
            'updated_at' => time(),
        ];
    }
}
