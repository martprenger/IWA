<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class nearestlocationSeeder extends Seeder
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
                        $sqlFile = database_path('IWA-data/nearestlocation.sql');
                
                        // Read SQL file content
                        $sql = file_get_contents($sqlFile);
                
                        // Execute SQL queries
                        $pdo->exec($sql);
    }
}
