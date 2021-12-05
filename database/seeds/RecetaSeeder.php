<?php

use Illuminate\Database\Seeder;
use  Illuminate\Support\Facades\DB;

class RecetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recetas')->insert(
            [
                    'nombre' => '9',
                    'ingredientes' => 'dwd',
                    'preparacion' => 'wd',
                    'img' => 'wd',
                    'pais' => 'Mexicana',
                
            ]
        );

        DB::table('recetas')->insert(
            [
                    'nombre' => '8',
                    'ingredientes' => 'dwd',
                    'preparacion' => 'wd',
                    'img' => 'wd',
                    'pais' => 'Mexicana',
                
            ]
        );
    }
}
