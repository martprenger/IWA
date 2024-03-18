<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'description' => 'Een admin kan accounts aanmaken en rollen toewijzen.'
            ],
            [
                'name' => 'Administratief medewerker',
                'description' => 'Een administratief medewerker kan API keys aanmaken en data hieraan toewijzen.'
            ],
            [
                'name' => 'Wetenschappelijk medewerker',
                'description' => 'Een wetenschappelijk medewerker kan weerstations monitoren een aanpassen.'
            ]
        ]);
    }
}
