<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Treatment;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $treatments = [
            [
                'paket' => 'Grooming Biasa',
                'harga' => '30000',
                'deskripsi' => 'fasilitas: mandi + gunting kuku + bersihin telinga + parfum ',
                'gambar' => ''
            ],
            [
                'paket' => 'Grooming Treatment Kutu',
                'harga' => '50000',
                'deskripsi' => 'fasilitas: mandi + treatment kutu + gunting kuku + bersihin telinga + parfum ',
                'gambar' => ''
            ],
            [
                'paket' => 'Grooming Treatment Jamur',
                'harga' => '60000',
                'deskripsi' => 'fasilitas: mandi + treatment jamur + gunting kuku + bersihin telinga + parfum ',
                'gambar' => ''
            ],
            [
                'paket' => 'Grooming Treatment Jamur+Kutu',
                'harga' => '70000',
                'deskripsi' => 'fasilitas: mandi + treatment jamur & kutu + gunting kuku + bersihin telinga + parfum ',
                'gambar' => ''
            ]
        ];
        
        foreach ($treatments as $treatmentData) {
            Treatment::create($treatmentData);
        }
    }
}