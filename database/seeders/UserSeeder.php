<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nip' => '1234561',
            'nama' => 'Andri Admin',
            'email' => 'andri1@email.com',
            'hp' => '0812345671',
            'username' => 'andri1',
            'password' => bcrypt('123'),
        ])->assignRole('Admin');

        User::create([
            'nip' => '1234562',
            'nama' => 'Andri Kader',
            'email' => 'andri2@email.com',
            'hp' => '0812345672',
            'username' => 'andri2',
            'password' => bcrypt('123'),
        ])->assignRole('Kader');

        User::create([
            'nip' => '1234563',
            'nama' => 'Andri Pengguna',
            'email' => 'andri3@email.com',
            'hp' => '0812345673',
            'username' => 'andri3',
            'password' => bcrypt('123'),
        ])->assignRole('Pengguna');
    }
}
