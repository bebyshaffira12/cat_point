<?php

namespace Database\Seeders;

use App\Models\Service;
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
        $hotels = [
            [
                'paket_fluffy' => 'Paket Fluffy',
                'harga' => '15000',
                'deskripsi' => 'fasilitas: penginapan + kandang + litterbox + perawatan harian (sisir) + vitamin',
                'gambar' => ''
            ],
            [
                'paket_fluffy' => 'Paket Meow',
                'harga' => '20000',
                'deskripsi' => 'fasilitas: penginapan + kandang + litterbox + perawatan harian (sisir) + pakan + vitamin',
                'gambar' => ''
            ],
            [
                'paket_fluffy' => 'Paket Kitty',
                'harga' => '20000',
                'deskripsi' => 'fasilitas: penginapan + kandang + litterbox + perawatan harian (sisir) + pasir gumpal + vitamin',
                'gambar' => ''
            ],
            [
                'paket_fluffy' => 'Paket Paw',
                'harga' => '25000',
                'deskripsi' => 'fasilitas: penginapan + kandang + litterbox + perawatan harian (sisir) + pakan + pasir gumpal + vitamin',
                'gambar' => ''
            ]
        ];


        foreach ($hotels as $hotel) {
            Service::create($hotel);
        }
    }
}
