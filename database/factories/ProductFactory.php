<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::where('role_id', 3)->inRandomOrder()->first()->id,
            'name' => $this->faker->paragraph(1),
            'slug' => Str::slug($this->faker->paragraph(1)),
            'description' => $this->faker->paragraph(3),
            'image' => 'https://source.unsplash.com/random',
            'stock' => rand(0, 100),
            'price' => rand(1000, 50000),
        ];
    }
}
