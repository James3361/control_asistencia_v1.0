<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institucion;

class InstitucionSeeder extends Seeder
{
    public function run(): void
    {
        Institucion::firstOrCreate(
            ['nombre' => 'Complejo Educativo Doctor Ottoniel Guglietta Armas'],
            [
                'codigo' => 'CEDOGA',
                'direccion' => 'Dirección del complejo educativo',
            ]
        );
    }
}
