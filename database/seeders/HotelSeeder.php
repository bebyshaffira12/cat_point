<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Hotel;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Hotel::create([
            'paket_fluffy'=> 'Paket Fluffy',
            'harga'=> '15000',
            'deskripsi'=> 'fasillitas: penginapan + kandang + litterbox + perawata',
            'gambar'=>''
        ]);
    }
}
