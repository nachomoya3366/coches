<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coche;
use App\Models\Proveedore;

class CocheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proveedores = Proveedore::all();

        Coche::create([
            'imagen' => 'img/toyota.png',
            'matricula' => '1234ABC',
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
            'color' => 'Blanco',
            'año' => 2020,
            'kilometros' => 45000,
            'combustible' => 'gasolina',
            'proveedore_id' => $proveedores[0]->id,
            'precio_compra' => 10000,
            'estado' => 'stock',
        ]);

        Coche::create([
            'imagen' => 'img/bmwserie3.png',
            'matricula' => '5678DEF',
            'marca' => 'BMW',
            'modelo' => 'Serie 3',
            'color' => 'Negro',
            'año' => 2022,
            'kilometros' => 15000,
            'combustible' => 'diesel',
            'proveedore_id' => $proveedores[1]->id,
            'precio_compra' => 20000,
            'estado' => 'stock',
        ]);

        Coche::create([
            'imagen' => 'img/audiA4.png',
            'matricula' => '9999XYZ',
            'marca' => 'Audi',
            'modelo' => 'A4',
            'color' => 'Rojo',
            'año' => 2021,
            'kilometros' => 30000,
            'combustible' => 'gasolina',
            'proveedore_id' => $proveedores[2]->id,
            'precio_compra' => 25000,
            'estado' => 'vendido',
        ]);
    }
}
