<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengaduan>
 */
class PengaduanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagePath = $faker->image('public/storage/feedback', 400, 300, null, false);

        return [
            'nomor' => rand(1,9999),
            'kontak' => rand(1,9999999),
            'nama' => fake()->name(),
            'alamatTinggal' => fake()->address(),
            'deskripsi' => fake()->paragraph(),
            'lokasi' => fake()->address(),
        ];
    }
}
