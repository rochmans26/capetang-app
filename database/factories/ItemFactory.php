<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_item' => $this->faker->name(),
            'stok_item' => $this->faker->numberBetween(1, 100),
            'deskripsi_item' => $this->faker->sentence(rand(6, 20)),
            'point_item' => $this->faker->numberBetween(1000, 10000),
            'foto_item' => null,
        ];
    }
}
