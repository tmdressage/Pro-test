<?php

namespace Database\Factories;

use App\Models\Review;
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

            'user_id'=> $this->faker->numberBetween(1,10),
            'shop_id'=> $this->faker->numberBetween(1,20),
            'review' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->realText(80),
            'created_at' => $this->faker->dateTimeBetween('-2 week', '-1 week'),           
        ];
    }
 
}
