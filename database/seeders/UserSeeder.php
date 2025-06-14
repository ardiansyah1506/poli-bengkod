<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'email' => 'admin@example.com',
                'role' => 'admin',
                'password' => bcrypt('password')
            ],
            [
                'email' => 'dokter@example.com',
                'role' => 'dokter', // role dokter
                'password' => bcrypt('password')
            ],
            [
                'email' => 'pasien@example.com',
                'role' => 'pasien', // role pasien
                'password' => bcrypt('password')
            ],
        ];

        foreach($data as $d){
            User::create([
                'role' => $d['role'],
                'email' => $d['email'],
                'password' => $d['password'],
                ]);
        }
    }
}
