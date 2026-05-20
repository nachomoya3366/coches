<x-mail::message>
# ¡Enhorabuena por su nuevo vehículo!

Hola **{{ $transaccion->cliente->nombre }}**,

@if($transaccion->coche->imagen)
<img src="{{ $message->embed(storage_path('app/public/' . $transaccion->coche->imagen)) }}" alt="Foto del {{ $transaccion->coche->marca }}" style="width: 100%; max-width: 500px; border-radius: 12px; margin-bottom: 20px; display: block;">
@endif

Se ha confirmado con éxito la compra de su vehículo. Aquí tiene los detalles:

- **Vehículo:** {{ $transaccion->coche->marca }} {{ $transaccion->coche->modelo }}
- **Nombre:** {{ $transaccion->cliente->nombre }}
- **Teléfono:** {{ $transaccion->cliente->telefono }}
- **Dirección:** {{ $transaccion->cliente->direccion }}
- **Precio Final:** {{ number_format($transaccion->precio, 0, ',', '.') }} €
- **Fecha de Compra:** {{ \Carbon\Carbon::parse($transaccion->fecha)->format('d/m/Y') }}

<x-mail::button :url="route('coches.show', $transaccion->coche->id)">
Ver detalles del vehículo
</x-mail::button>

**Punto de Entrega**
Te esperamos en nuestras instalaciones para recoger tu nuevo coche:

<x-mail::button :url="'https://www.google.com/maps/search/?api=1&query=37.98102101535536,-3.80156895132321'" color="success">
Cómo llegar
</x-mail::button>

Gracias por confiar en nosotros.

Saludos,
El equipo de ventas.
</x-mail::message>
