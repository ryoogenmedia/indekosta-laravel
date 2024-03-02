<?php

namespace Database\Seeders;

use App\Models\Kost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kosts = [
            [
                'nama_kost' => 'kost ta',
                'alamat' => 'Jl tamalanrea, lorong 10',
                'deskripsi' => 'Kost aman, nyaman dan fasilitas lengkap jii',
                'harga' => '1000000',
            ]
        ];

        foreach ($kosts as $kost) {
            Kost::create($kost);
        }
    }
}
