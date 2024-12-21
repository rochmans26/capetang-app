<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quest>
 */
class QuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $waktuMulai = fake()->dateTimeBetween('-6 month', now());
        $waktuBerakhir = fake()->dateTimeBetween($waktuMulai, now()->addMonths(3));

        return [
            'nama_quest' => fake()->name(),
            'deskripsi' => fake()->sentence(rand(6, 20)),
            'waktu_mulai' => $waktuMulai,
            'waktu_berakhir' => $waktuBerakhir,
            'point' => fake()->randomNumber(rand(2, 3)),
        ];
    }
}
