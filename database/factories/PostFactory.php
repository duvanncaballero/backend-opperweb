<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id'   => Category::factory(),
            'title'         => $this->faker->unique()->word(50),
            'content'       => $this->faker->text(),
        ];
    }
}
