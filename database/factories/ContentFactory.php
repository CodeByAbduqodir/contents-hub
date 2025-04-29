<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Content;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    protected $model = Content::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['video', 'book', 'audio']),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph, 
            'url' => $this->faker->optional()->url, 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}