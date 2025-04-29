<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Society;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Society>
 */
class SocietyFactory extends Factory
{
    protected $model = Society::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'url' => $this->faker->optional()->url,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}