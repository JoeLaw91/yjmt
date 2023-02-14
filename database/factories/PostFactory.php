<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
            'user_id'=> User::Factory(),
            'category_id'=>Category::Factory(),
            'title'=>$this->faker->sentence,
            'price'=>$this->faker->sentence,
            'body'=>$this->faker->paragraph
        ];
    }
}
