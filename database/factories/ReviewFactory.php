<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => User::factory()->create()->id,
            "film_id" => Film::factory()->create()->id,
            "rate" => $this->faker->randomNumber(1)
        ];
    }
}
