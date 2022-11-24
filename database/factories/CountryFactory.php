<?php

namespace Database\Factories;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = FakerFactory::create('ru_RU');
        return [
            //
            'name' => $faker->unique()->country(),
            'created_at' => time(),
            'updated_at' => time(),
        ];
    }
}
