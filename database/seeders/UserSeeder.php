<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Lamba Octavian', 'email' => 'lambaoctavian17@gmail.com', 'password' => 'lodgrin2025'],
            ['name' => 'Lamba Gheorghe', 'email' => 'lambagheorghe@gmail.com', 'password' => 'lodgrin2025'],
        ];

        collect($data)->each(function ($factory) {

            $user = User::create([
                'name' => $factory['name'],
                'email' => $factory['email'],
                'password' => Hash::make($factory['password'])
            ]);
        });
    }
}
