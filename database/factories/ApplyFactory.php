<?php

namespace Database\Factories;

use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $platformsCount = Platform::all()->count();
        return [
            //
            'platform_id' => rand(1, $platformsCount),
            'connect_time' => $this->faker->dateTime(),
            'status' => rand(0, 2),
            'customer_rate' => rand(0, 10),
            'specialist_rate' => rand(0, 10),
            'customer_comment' => $this->faker->text(240),
            'specialist_comment' => $this->faker->text(240),
            'created_at' => time(),
            'updated_at' => time(),
        ];
    }
}
