<?php

use Illuminate\Database\Seeder;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
    	DB::table('main_services')->delete();

    	$hovedfager = [
            ['id' => 1, 'hovedfag' => 'Anleggsgartnerer'],
            ['id' => 2, 'hovedfag' => 'Blikkenslagere'],
            ['id' => 3, 'hovedfag' => 'Elektrikker'],
            ['id' => 4, 'hovedfag' => 'Glassarbeidere'],
            ['id' => 5, 'hovedfag' => 'Interiør Arkitekter'],
            ['id' => 6, 'hovedfag' => 'Malere'],
            ['id' => 7, 'hovedfag' => 'Maskinentreprenører'],
            ['id' => 8, 'hovedfag' => 'Murere'],
            ['id' => 9, 'hovedfag' => 'Rengjørere'],
            ['id' => 10, 'hovedfag' => 'Rørleggere'],
            ['id' => 11, 'hovedfag' => 'Skadedyrbekjempelse'],
            ['id' => 12, 'hovedfag' => 'Tømrer/snekker'],
            ['id' => 13, 'hovedfag' => 'Vaktmestere'],
            ['id' => 14, 'hovedfag' => 'Snekker'],
            ['id' => 15, 'hovedfag' => 'Gartner'],
        ];

        DB::table('main_services')->insert($hovedfager);
    }
}
