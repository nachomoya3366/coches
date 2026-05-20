<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'tipo',
        'CIF/NIF',
        'nombre',
        'telefono',
        'direccion',
    ];
}
