<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $citiesCount = City::all()->count();
        $rolesCount = Role::all()->count();

        $roleId = rand(1, $rolesCount);
        $portfolio =    $roleId == Role::where('name', '=', 'Специалист')->get()[0]->id ? 
                        $this->faker->text(400) : "";

        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $this->faker->password(6, 30),
            'name' => $this->faker->name(),
            'surname' => $this->faker->lastName(),
            'patronymic' => $this->faker->name(),
            'birth_date' => $this->faker->date(),
            'about' => $this->faker->text(250),
            'portfolio' => $portfolio,
            'city_id' => rand(1, $citiesCount),
            'role_id' => rand(1, $rolesCount),
        ];
    }

    /**
     * 
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function specialist()
    {
        $roleId = Role::where('name', '=', 'Специалист')->get()[0]->id;
        return $this->state(function (array $attributes) use($roleId) 
        {
            return 
            [
                'role_id' => $roleId,
            ];
        });
    }

    public function customer()
    {
        $roleId = Role::where('name', '=', 'Заказчик')->get()[0]->id;
        return $this->state(function (array $attributes) use ($roleId)
        {
            return 
            [
                'role_id' => $roleId,
            ];
        });
    }
}
