<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coche extends Model
{
    protected $fillable = [
        'imagen',
        'matricula',
        'marca',
        'modelo',
        'color',
        'año',
        'kilometros',
        'combustible',
        'proveedore_id',
        'precio_compra',
        'estado'
    ];

    public function proveedor() {
        return $this->belongsTo(Proveedore::class, 'proveedore_id');
    }

    public function transacciones() {
        return $this->hasMany(Transacciones ::class, 'coche_id');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
