<?php

use Livewire\Volt\Component;
use App\Models\Reserva;
use Carbon\Carbon;
use App\Models\Transaccion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; // Asegúrate de que esta línea esté presente
use App\Mail\ReservaCitaMail; // Cambiado de ReservaCita a ReservaCitaMail


new class extends Component
{
    public $coche;
    public $selectedDate;
    public $selectedTime = null;
    public $nombre_cliente = '';
    public $telefono = '';
    public $email = '';
    public $showModal = false;
    public $esCompra = false; // Propiedad para identificar si el flujo es de compra o reserva

    public function mount($coche)
    {
        $this->coche = $coche;
        $this->selectedDate = Carbon::today()->format('Y-m-d');

        if (auth()->check()) {
            $this->nombre_cliente = auth()->user()->name;
            $this->email = auth()->user()->email;
        }
    }

    protected function rules()
    {
        return [
            'selectedDate' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) {
                    if (date('N', strtotime($value)) > 5) { // 6 para Sábado, 7 para Domingo
                        $fail('Las citas solo se pueden reservar de lunes a viernes.');
                    }
                },
            ],
            'selectedTime' => 'required',
            'nombre_cliente' => 'required|string|max:255',
            'telefono' => 'required|numeric|digits:9',
            'email' => [
                'required',
                'email',
                'max:255',
                function ($attribute, $value, $fail) {
                    $exists = Reserva::where('coche_id', $this->coche->id)
                        ->where('email', $value)
                        ->exists();
                    if ($exists) {
                        $fail('Usted ya tiene una reserva activa para este vehículo.');
                    }
                },
            ],
        ];
    }

    // Propiedad computada para obtener los slots disponibles
    public function getAvailableTimeSlotsProperty()
    {
        $slots = collect([]);
        $date = Carbon::parse($this->selectedDate);

        // Rango Mañana: 08:00 - 13:00
        for ($hour = 8; $hour <= 12; $hour++) {
            $slots->push(sprintf('%02d:00', $hour));
        }
        $slots->push('13:00');

        // Rango Tarde: 17:00 - 20:00
        for ($hour = 17; $hour <= 19; $hour++) {
            $slots->push(sprintf('%02d:00', $hour));
        }
        $slots->push('20:00');

        // Filtrar slots que ya han pasado si la fecha seleccionada es hoy
        // Usamos now() que respeta la zona horaria configurada en config/app.php
        if (Carbon::parse($this->selectedDate)->isToday()) {
            $currentTime = now()->startOfMinute(); 
            
            $slots = $slots->filter(function($slot) use ($date, $currentTime) {
                $slotDateTime = Carbon::parse($date->format('Y-m-d') . ' ' . $slot)->startOfMinute();
                return $slotDateTime->gt($currentTime);
            });
        }
        // Obtener slots ya reservados para este coche y fecha
        $bookedSlots = Reserva::where('coche_id', $this->coche->id)
                                  ->where('fecha', $this->selectedDate)
                                  ->pluck('hora')
                                  ->map(fn($time) => Carbon::parse($time)->format('H:i'))
                                  ->toArray();

        $availableSlots = $slots->filter(function($slot) use ($bookedSlots) {
            return !in_array($slot, $bookedSlots);
        })->values()->sort();

        return $availableSlots;
    }

    public function updatedSelectedDate()
    {
        $this->selectedTime = null; // Reiniciar la hora seleccionada cuando cambia la fecha
        $this->resetValidation('selectedDate', 'selectedTime'); // Limpiar errores de validación de fecha/hora
    }

    public function selectTime($time)
    {
        $this->selectedTime = $time;
        $this->resetValidation('selectedTime'); // Limpiar error de validación de hora
    }

    public function openModal()
    {
        $this->showModal = true;
        // Asegurarse de que los slots más recientes se carguen al abrir, y la fecha sea la actual
        $this->selectedDate = Carbon::today()->format('Y-m-d');
        $this->selectedTime = null;

        if (auth()->check()) {
            $this->nombre_cliente = auth()->user()->name;
            $this->email = auth()->user()->email;
        }

        $this->resetValidation(); // Limpiar cualquier error de validación previo
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['selectedDate', 'selectedTime', 'nombre_cliente', 'telefono', 'email']);
        $this->resetValidation();
    }

    public function reservar()
    {
        $this->validate();
        
        try {
            $reserva = DB::transaction(function () {
                // Verificación de disponibilidad dentro de la transacción
                $isBooked = Reserva::where('coche_id', $this->coche->id)
                    ->where('fecha', $this->selectedDate)
                    ->where('hora', $this->selectedTime)
                    ->exists();

                if ($isBooked) {
                    throw new \Exception('Lo sentimos, esta hora acaba de ser reservada.');
                }

                return Reserva::create([
                    'coche_id' => $this->coche->id,
                    'fecha' => $this->selectedDate,
                    'hora' => $this->selectedTime,
                    'nombre_cliente' => $this->nombre_cliente,
                    'telefono' => $this->telefono,
                    'email' => $this->email,
                ]);
            });

            // Enviar correo al cliente
            Mail::to($reserva->email)->send(new ReservaCitaMail($reserva));

            // Enviar correo a todos los administradores
            $admins = User::where('rol', 'admin')->get();
            if ($admins->isNotEmpty()) {
                Mail::to($admins)->send(new ReservaCitaMail($reserva));
            }

            $fechaFmt = Carbon::parse($this->selectedDate)->format('d/m/Y');
            session()->flash('success', "¡Vehículo reservado con éxito para el $fechaFmt a las $this->selectedTime!");
            
            return $this->redirect(route('coches.show', $this->coche->id), navigate: true);

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return;
        }
    }
}; ?>

<div class="w-full sm:w-auto">
    <!-- Botón para abrir modal -->
    <button wire:click="openModal"
        class="w-full sm:w-auto text-white mb-2 sm:mb-0 sm:mt-0 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none flex items-center justify-center">
        Reservar cita para ver el coche
    </button>

    <!-- Modal usando Alpine.js para transiciones suaves -->
    <div x-data="{ open: @entangle('showModal') }" x-show="open" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="open = false"></div>

            <div class="relative bg-white dark:bg-gray-800 rounded-lg max-w-lg w-full p-6 shadow-xl border dark:border-gray-700">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Reservar Cita</h3>

                <!-- Inmagen del coche -->
                <div class="mb-6 flex items-center gap-4 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-100 dark:border-gray-600">
                    <img 
                        class="w-24 h-16 object-cover rounded-md shadow-sm" 
                        src="{{ $coche->imagen ? asset('storage/' . $coche->imagen) : 'https://via.placeholder.com/300x200?text=Sin+foto' }}" 
                        alt="{{ $coche->marca }} {{ $coche->modelo }}" 
                    />
                    <div>
                        <p class="font-bold text-gray-900 dark:text-white">{{ $coche->marca }} {{ $coche->modelo }}</p>
                        <p class="text-sm text-indigo-600 dark:text-indigo-400 font-semibold">{{ number_format($coche->precio_compra * 1.10, 0, ',', '.') }} €</p>
                    </div>
                </div>

                @if (session()->has('error'))
                    <div class="p-3 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">{{ session('error') }}</div>
                @endif

                <!-- Campos de cliente -->
                <div class="space-y-4 mb-4">
                    <div>
                        <label for="nombre_cliente" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre completo <span class="text-red-500">*</span></label>
                        <input wire:model="nombre_cliente" type="text" id="nombre_cliente" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Tu nombre">
                        @error('nombre_cliente') <span class="text-red-600 dark:text-red-400 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono <span class="text-red-500">*</span></label>
                        <input wire:model="telefono" type="text" id="telefono" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Ej: 612345678">
                        @error('telefono') <span class="text-red-600 dark:text-red-400 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email <span class="text-red-500">*</span></label>
                        <input wire:model="email" type="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="tu@email.com">
                        @error('email') <span class="text-red-600 dark:text-red-400 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Selector de fecha -->
                <div class="mb-4">
                    <label for="selectedDate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha de la cita <span class="text-red-500">*</span></label>
                    <input type="date" id="selectedDate" wire:model.live="selectedDate" min="{{ Carbon::today()->format('Y-m-d') }}"
                           class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('selectedDate') <span class="text-red-600 dark:text-red-400 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Selector de horas (Grid) -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Horas disponibles <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-3 gap-2 max-h-48 overflow-y-auto p-1">
                        @forelse($this->availableTimeSlots as $slot)
                            <button wire:click="selectTime('{{ $slot }}')"
                                    type="button"
                                    class="py-2 text-sm font-medium rounded-md border transition-colors
                                    {{ $selectedTime === $slot
                                        ? 'bg-indigo-600 text-white border-indigo-600'
                                        : 'bg-gray-100 text-gray-700 border-gray-300 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600' }}">
                                {{ $slot }}
                            </button>
                        @empty
                            <p class="col-span-3 text-sm text-gray-500 text-center py-4">No hay horarios disponibles para esta fecha.</p>
                        @endforelse
                    </div>
                    @error('selectedTime') <span class="text-red-600 dark:text-red-400 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <button @click="open = false" wire:click="closeModal"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300">
                        Cancelar
                    </button>
                    <button wire:click="reservar"
                            class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 disabled:opacity-50"
                            @if(!$selectedTime) disabled @endif>
                        Confirmar Reserva
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
