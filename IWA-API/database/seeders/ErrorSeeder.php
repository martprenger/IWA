<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StationError;

class ErrorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate sample data and insert into station_error table
        StationError::create([
            'station_name' => '1',
            'error' => 'Error 1',
            'count' => 3,
        ]);

        StationError::create([
            'station_name' => '2',
            'error' => 'Error 2',
            'count' => 5,
        ]);

        // Add more sample data as needed
    }
}
