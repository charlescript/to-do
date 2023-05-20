<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run()
    {
        //
        User::create([
            'name' => 'Charles Rocha',
            'email' => 'rochacharels150@gmail.com',
            'password' => Hash::make('123456')
        ]);

    }
}
