<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Film::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'writer' => $this->faker->name() . " " . $this->faker->lastName(),
            'actors' => $this->faker->name() . " " . $this->faker->lastName() . " / " . $this->faker->name() . " " . $this->faker->lastName(),
            'director' => $this->faker->name() . " " . $this->faker->lastName(),
            'title' => $this->faker->title,
            'genre' => $this->faker->randomElements(["Action", "Comedy", "Sci-Fi", "Romantic", "Horror", "Crime"]),
            'published_at' => $this->faker->date(),
            'year' => $this->faker->year,
            'plot' => $this->faker->text,
            'country' => $this->faker->country,
            'language' => $this->faker->languageCode,
            'poster' => $this->faker->imageUrl(300, 445)
        ];
    }
}
