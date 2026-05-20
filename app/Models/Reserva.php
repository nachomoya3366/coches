<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'coche_id',
        'fecha', // Asegurarse de que 'fecha' sea fillable
        'hora',  // Asegurarse de que 'hora' sea fillable
        'nombre_cliente',
        'telefono',
        'email',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function coche()
    {
        return $this->belongsTo(Coche::class);
    }
}
