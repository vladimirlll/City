<?php

namespace Database\Factories;

use App\Models\Country;
use Exception;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $countriesCount = Country::all()->count();
        if($countriesCount == 0) throw new Exception('Нет стран в базе данных');
        return [
            //
            'name' => $this->faker->city(),
            'country_id' => rand(1, $countriesCount),
            'created_at' => time(),
            'updated_at' => time(),
        ];
    }
}
