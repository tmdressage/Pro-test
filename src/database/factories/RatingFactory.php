<?php

namespace Database\Factories;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'user_id' => $this->faker->numberBetween(22, 31),
            'shop_id' => $this->faker->numberBetween(1, 20),
            'rating' => $this->faker->numberBetween(1, 5),
            'text' => $this->faker->realText(80),
            'image' => $this->faker->imageUrl(300, 300),
        ];
    }
}
