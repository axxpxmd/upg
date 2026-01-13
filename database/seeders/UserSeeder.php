<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Opd;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'username' => 'admin',
            'password' => Hash::make('asdfasdf'),
            'nama' => 'admin',
            'role' => 'admin',
            'jabatan' => 'staff',
            'opd_id' => 10,
            'nik' => null,
            'email' => null,
            'no_hp' => null,
        ]);
    }
}
