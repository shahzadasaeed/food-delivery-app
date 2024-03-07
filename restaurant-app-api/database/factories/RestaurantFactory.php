<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'cuisine' => $this->faker->word,
            'rating' => $this->faker->randomFloat(1, 0, 5),
        ];
    }
}
