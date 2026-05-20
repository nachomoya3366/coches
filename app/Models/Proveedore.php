<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model
{
    protected $table = 'proveedores';

    protected $fillable = [
        'tipo',
        'CIF/NIF',
        'nombre',
        'telefono',
        'direccion',
    ];

    public function coches() {
        return $this->hasMany(Coche::class);
    }
}
