<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedore;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proveedore::create([
            'tipo' => 'Concesionario',
            'CIF/NIF' => 'B12345678',
            'nombre' => 'AutoMadrid S.L.',
            'telefono' => 600123456,
            'direccion' => 'Calle Mayor 10',
        ]);

        Proveedore::create([
            'tipo' => 'Particular',
            'CIF/NIF' => '12345678A',
            'nombre' => 'Juan Pérez',
            'telefono' => 611223344,
            'direccion' => 'Calle Sol 5',
        ]);

        Proveedore::create([
            'tipo' => 'Empresa',
            'CIF/NIF' => 'B87654321',
            'nombre' => 'Cars Import S.L.',
            'telefono' => 622334455,
            'direccion' => 'Avenida Norte 22',
        ]);
    }
}
