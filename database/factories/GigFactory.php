<?php

namespace Database\Factories;

use App\Models\Gig;
use Illuminate\Database\Eloquent\Factories\Factory;

class GigFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gig::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'category_id' => rand(1, 10),
            'title' => $this->faker->title(),
            'about' => $this->faker->sentence(),
            'basic_price' => rand(1000, 120000),
            'basic_description' =>  $this->faker->sentence(),
            'standard_price' => rand(1000, 120000),
            'standard_description' =>  $this->faker->sentence(),
            'premium_price' => rand(1000, 120000),
            'premium_description' =>  $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
