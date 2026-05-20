<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Coche;
use App\Models\Proveedore;
use App\Models\Cliente;

class Transacciones extends Model
{
     protected $casts = [
        'fecha' => 'datetime',
    ];

    protected $fillable = [
        'coche_id',
        'proveedor_id',
        'cliente_id',
        'accion',
        'precio',
        'fecha',
    ];

    public function coche() {
        return $this->belongsTo(Coche::class);
    }

    public function proveedor() {
        return $this->belongsTo(Proveedore::class);
    }

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }
}
