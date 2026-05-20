<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create([
            'tipo' => 'persona',
            'CIF/NIF' => '12345678A',
            'nombre' => 'Carlos García',
            'telefono' => 612345678,
            'direccion' => 'Calle Gran Vía 15',
        ]);

        Cliente::create([
            'tipo' => 'empresa',
            'CIF/NIF' => 'B23456789',
            'nombre' => 'Transportes López S.L.',
            'telefono' => 623456789,
            'direccion' => 'Avenida Constitución 8',
        ]);

        Cliente::create([
            'tipo' => 'persona',
            'CIF/NIF' => '87654321B',
            'nombre' => 'María Rodríguez',
            'telefono' => 634567890,
            'direccion' => 'Calle Luna 3',
        ]);
    }
}