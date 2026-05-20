<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'coche_id',
        'cliente_id',
        'proveedor_id',
        'nombre_cliente',
        'email_cliente',
        'nombre_tarjeta',
        'numero_tarjeta',
        'expiracion',
        'cv',
        'precio',
        'accion',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'precio' => 'decimal:2',
    ];

    public function coche(): BelongsTo
    {
        return $this->belongsTo(Coche::class);
    }

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedore::class, 'proveedor_id');
    }
}
