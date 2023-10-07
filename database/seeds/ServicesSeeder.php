<?php

use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
    	DB::table('secondary_services')->delete();

    	$spesialiseringer = [
            ['id' => 1, 'mainservice_id' => 1, 'spesialisering' => 'Hage og park-anlegg'],
            ['id' => 2, 'mainservice_id' => 1, 'spesialisering' => 'Asfalt og betong arbeid'],
            ['id' => 3, 'mainservice_id' => 1, 'spesialisering' => 'Natursteins arbeid'],
            ['id' => 4, 'mainservice_id' => 1, 'spesialisering' => 'Plante og vegetasjons arbeid '],
            ['id' => 6, 'mainservice_id' => 2, 'spesialisering' => 'produksjon/verksted'],
            ['id' => 7, 'mainservice_id' => 2, 'spesialisering' => 'Montasje, tak og fasader'],
            ['id' => 8, 'mainservice_id' => 2, 'spesialisering' => 'Ventilasjon'],
            ['id' => 9, 'mainservice_id' => 2, 'spesialisering' => 'Isolasjon/mantling'],
            ['id' => 10, 'mainservice_id' => 2, 'spesialisering' => 'Interiør/utsmykking'],
            ['id' => 11, 'mainservice_id' => 3, 'spesialisering' => 'Automatiker'],
            ['id' => 12, 'mainservice_id' => 3, 'spesialisering' => 'Dataelektroniker'],
            ['id' => 13, 'mainservice_id' => 3, 'spesialisering' => 'Nymontasje bolig'],
            ['id' => 14, 'mainservice_id' => 3, 'spesialisering' => 'Service Bolig'],
            ['id' => 15, 'mainservice_id' => 3, 'spesialisering' => 'Service Industri'],
            ['id' => 16, 'mainservice_id' => 3, 'spesialisering' => 'Elektroreparatør'],
            ['id' => 17, 'mainservice_id' => 3, 'spesialisering' => 'Heismontør'],
            ['id' => 18, 'mainservice_id' => 3, 'spesialisering' => 'Kulde- og varmepumpemontør'],
            ['id' => 19, 'mainservice_id' => 3, 'spesialisering' => 'Marin'],
            ['id' => 20, 'mainservice_id' => 4, 'spesialisering' => 'Produksjon, alu, stål og plastrammer'],
            ['id' => 21, 'mainservice_id' => 4, 'spesialisering' => 'Glassverksted, montasje'],
            ['id' => 22, 'mainservice_id' => 4, 'spesialisering' => 'Glassblåser'],
            ['id' => 23, 'mainservice_id' => 4, 'spesialisering' => 'Montasje i transportmidler'],
            ['id' => 24, 'mainservice_id' => 6, 'spesialisering' => 'Fasader'],
            ['id' => 25, 'mainservice_id' => 6, 'spesialisering' => 'Interiør'],
            ['id' => 26, 'mainservice_id' => 6, 'spesialisering' => 'Tapetserer'],
            ['id' => 27, 'mainservice_id' => 6, 'spesialisering' => 'Gulvbellegg'],
            ['id' => 28, 'mainservice_id' => 7, 'spesialisering' => 'Graving'],
            ['id' => 29, 'mainservice_id' => 7, 'spesialisering' => 'Grunnarbeid'],
            ['id' => 30, 'mainservice_id' => 7, 'spesialisering' => 'Drenering'],
            ['id' => 31, 'mainservice_id' => 7, 'spesialisering' => 'Massetransport'],
            ['id' => 32, 'mainservice_id' => 7, 'spesialisering' => 'Riving'],
            ['id' => 33, 'mainservice_id' => 7, 'spesialisering' => 'Sprenging'],
            ['id' => 34, 'mainservice_id' => 7, 'spesialisering' => 'Brøyting'],
            ['id' => 35, 'mainservice_id' => 8, 'spesialisering' => 'Fasade, blokk og teglstein'],
            ['id' => 36, 'mainservice_id' => 8, 'spesialisering' => 'Flis, skifer og naturstein'],
            ['id' => 37, 'mainservice_id' => 8, 'spesialisering' => 'Våtroms arbeid'],
            ['id' => 38, 'mainservice_id' => 8, 'spesialisering' => 'Gulv avretting'],
            ['id' => 39, 'mainservice_id' => 8, 'spesialisering' => 'Betong og gulvstøp'],
            ['id' => 40, 'mainservice_id' => 9, 'spesialisering' => 'Private hjem'],
            ['id' => 41, 'mainservice_id' => 9, 'spesialisering' => 'Kontorer'],
            ['id' => 42, 'mainservice_id' => 9, 'spesialisering' => 'Produksjonplasser'],
            ['id' => 43, 'mainservice_id' => 9, 'spesialisering' => 'Matproduksjon/sanitær'],
            ['id' => 44, 'mainservice_id' => 9, 'spesialisering' => 'Vindus/fasader'],
            ['id' => 45, 'mainservice_id' => 10, 'spesialisering' => 'Service Bolig'],
            ['id' => 46, 'mainservice_id' => 10, 'spesialisering' => 'Nymontasje Bolig'],
            ['id' => 47, 'mainservice_id' => 10, 'spesialisering' => 'Vannboren varme'],
            ['id' => 48, 'mainservice_id' => 10, 'spesialisering' => 'Industri'],
            ['id' => 49, 'mainservice_id' => 10, 'spesialisering' => 'Vann og avløp'],
            ['id' => 50, 'mainservice_id' => 10, 'spesialisering' => 'Marin'],
            ['id' => 51, 'mainservice_id' => 12, 'spesialisering' => 'Nybygg'],
            ['id' => 52, 'mainservice_id' => 12, 'spesialisering' => 'Rehabiliterin'],
            ['id' => 53, 'mainservice_id' => 12, 'spesialisering' => 'Kjøkken montør'],
            ['id' => 54, 'mainservice_id' => 12, 'spesialisering' => 'Båtbygger'],
            ['id' => 55, 'mainservice_id' => 12, 'spesialisering' => 'Industrisnekker'],
            ['id' => 56, 'mainservice_id' => 12, 'spesialisering' => 'Møbelsnekker'],
            ['id' => 57, 'mainservice_id' => 12, 'spesialisering' => 'Tredreier'],
            ['id' => 58, 'mainservice_id' => 12, 'spesialisering' => 'Treskjærer'],
            ['id' => 59, 'mainservice_id' => 12, 'spesialisering' => 'Innredning/trapp'],
        ];

        DB::table('secondary_services')->insert($spesialiseringer);
    }
}
