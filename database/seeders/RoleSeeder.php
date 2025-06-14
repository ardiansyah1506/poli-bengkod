<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'admin'],
            ['nama' => 'dokter'],
            ['nama' => 'pasien']
        ];

        foreach($data as $d){
            Role::create([
                'nama' => $d['nama'],
                ]);
        }
    }
}
