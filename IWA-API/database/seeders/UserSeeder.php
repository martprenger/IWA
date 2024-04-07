<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Using Eloquent Model
        User::create([
            'id' => 1,
            'name' => 'jankees pieter',
            'email' => 'jankees@gmail.com',
            'worker_type' => 'admin',
            'password' => Hash::make('password'), // Use Hash::make to hash the password
        ]);

    }
}
