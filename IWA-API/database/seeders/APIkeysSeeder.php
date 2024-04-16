<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class APIkeysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('APIkeys')->insert([
            'klantenID' => 1,
            'APIkey' => 'your-api-key',
            'actief' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Add more data if needed
    }
}
