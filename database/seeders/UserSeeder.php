<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'beby',
            'email' => 'beby@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'no_hp' => '0813272378',
            'alamat' => 'Purwokerto',
            
        ];

        

        // Masukkan data ke dalam database
        User::create($data);
    }
}
