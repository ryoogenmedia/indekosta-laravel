<?php

namespace Database\Seeders;

use App\Models\Recomendation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecomendationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recomendations = [
            [
                'kost_id' => 1,
                'user_id' => 2,
                'rating' => 5,
                'nama' => 'bintang',
                'email' => 'feryfadulrahman@gmail.com',
                'ulasan' => 'bagus bangat!!',
            ]
        ];

        foreach ($recomendations as $rekomendasi) {
            Recomendation::create($rekomendasi);
        }
    }
}
