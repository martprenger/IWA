<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class geolocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Get the current database connection name
                $connection = config('database.default');

                // Get the connection configuration
                $config = config("database.connections.{$connection}");
        
                // Build the DSN string
                $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['database']}";
        
                // Create PDO connection
                $pdo = new \PDO($dsn, $config['username'], $config['password']);
        
                // Path to your SQL file
                $sqlFile1 = database_path('IWA-data/geolocation1.sql');
                $sqlFile2 = database_path('IWA-data/geolocation2.sql');
        
                // Read SQL file content
                $sql1 = file_get_contents($sqlFile1);
                $sql2 = file_get_contents($sqlFile2);
        
                // Execute SQL queries
                $pdo->exec($sql1);
                $pdo->exec($sql2);
    }
}
