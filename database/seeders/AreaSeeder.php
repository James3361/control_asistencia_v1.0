<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    public function run()
{
    $areas = ['Informática', 'Matemáticas', 'Idiomas', 'Ciencias', 'Historia'];
    
    foreach($areas as $area) {
        DB::table('matriculas')->updateOrInsert(
            ['area_formacion' => $area],
            ['area_formacion' => $area]
        );
    }
}

}
