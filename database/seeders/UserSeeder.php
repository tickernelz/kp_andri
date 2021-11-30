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
        ])->assignRole('Kader');
    }
}
