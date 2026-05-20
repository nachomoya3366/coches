<x-mail::message>
# Detalles de la Reserva

Hola **{{ $reserva->nombre_cliente }}**,

@if($reserva->coche->imagen)
<img src="{{ $message->embed(storage_path('app/public/' . $reserva->coche->imagen)) }}" alt="Foto del {{ $reserva->coche->marca }}" style="width: 100%; max-width: 500px; border-radius: 12px; margin-bottom: 20px; display: block;">
@endif

Se ha registrado una cita para ver el siguiente vehículo:

- **Vehículo:** {{ $reserva->coche->marca }} {{ $reserva->coche->modelo }}
- **Fecha:** {{ \Carbon\Carbon::parse($reserva->fecha)->format('d/m/Y') }}
- **Hora:** {{ $reserva->hora }}
- **Nombre:** {{ $reserva->nombre_cliente }}
- **Teléfono**: {{ $reserva->telefono }}

<x-mail::button :url="route('coches.show', $reserva->coche->id)">
Ver Vehículo
</x-mail::button>

**Ubicación**
Puedes encontrarnos en la siguiente dirección:

<x-mail::button :url="'https://www.google.com/maps/search/?api=1&query=37.98102101535536,-3.80156895132321'" color="success">
Ver en Google Maps
</x-mail::button>

Gracias por confiar en nosotros.

Saludos,
El equipo de reservas.
</x-mail::message>
