<?php

namespace Database\Factories;

use App\Models\Apply;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Role;

class Apply_UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $customersCount =   User::where('role_id', '=', 
                            Role::where('name', '=', 'Заказчик')->get()[0]->id)->get()->count();
        $specialistsCount = User::where('role_id', '=', 
                            Role::where('name', '=', 'Специалист')->get()[0]->id)->get()->count();

        $appliesCount =     Apply::all()->count();
        return [
            //
            'customer_id' => rand(1, $customersCount),
            'specialist_id' => rand(1, $specialistsCount),
            'apply_id' => rand(1, $appliesCount),
            'created_at' => time(),
            'updated_at' => time(),
        ];
    }
}
