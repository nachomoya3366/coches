<?php

use Livewire\Volt\Component;
use App\Models\Coche;
use App\Models\Cliente;
use Carbon\Carbon;
use App\Models\Pago;
use App\Models\Transacciones;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompraCocheMail;

new class extends Component
{
    public $coche;
    public $showModal = false;

    // Datos del formulario (Transacción + Pago)
    public $nombre_cliente = '';
    public $email_cliente = '';
    public $nombre_tarjeta = '';
    public $numero_tarjeta = '';
    public $tipo = 'particular';
    public $cif_nif = '';
    public $telefono = '';
    public $direccion = '';
    public $expiracion = '';
    public $cv = '';
    
    // Campos informativos para la transacción (pueden ser editables si se desea)
    public $proveedor = 'Concesionario Principal';
    public $accion = 'Venta Directa';

    public function mount($coche)
    {
        $this->coche = $coche;

        if (auth()->check()) {
            $this->nombre_cliente = auth()->user()->name;
            $this->email_cliente = auth()->user()->email;
        }
    }

    public function openModal()
    {
        if ($this->coche->estado === 'vendido') return;
        $this->showModal = true;

        if (auth()->check()) {
            $this->nombre_cliente = auth()->user()->name;
            $this->email_cliente = auth()->user()->email;
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['nombre_cliente', 'email_cliente', 'nombre_tarjeta', 'numero_tarjeta', 'expiracion', 'cv', 'tipo', 'cif_nif', 'telefono', 'direccion']);
        $this->resetValidation();
    }

    public function comprar()
    {
        $this->validate([
            'nombre_cliente' => 'required|string|min:3|max:100',
            'email_cliente'  => 'required|email|max:255',
            'nombre_tarjeta' => 'required|string|min:3',
            'tipo'           => 'required|string',
            'cif_nif'        => 'required|string|max:20',
            'telefono'       => 'required|string|max:20',
            'direccion'      => 'required|string|max:255',
            'numero_tarjeta' => 'required|digits:16',
            'expiracion'     => 'required|regex:/^[0-9]{2}\/[0-9]{2}$/',
            'cv'             => 'required|digits:3',
        ], [], [
            'nombre_cliente' => 'nombre',
            'email_cliente' => 'correo electrónico',
            'cif_nif' => $this->tipo === 'particular' ? 'NIF' : 'CIF',
            'telefono' => 'teléfono',
            'direccion' => 'dirección',
            'numero_tarjeta' => 'número de tarjeta',
            'expiracion' => 'fecha de expiración',
        ]);

        try {
            $transaccion = DB::transaction(function () {
                // 0. Buscar o Crear Cliente
                $user = User::where('email', $this->email_cliente)->first();
                if (!$user) {
                    $user = User::create([
                        'name' => $this->nombre_cliente,
                        'email' => $this->email_cliente,
                    ]);
                }

                // 1. Crear el Cliente
                $cliente = Cliente::create([
                    'tipo' => $this->tipo,
                    'CIF/NIF' => $this->cif_nif,
                    'nombre' => $this->nombre_cliente,
                    'telefono' => $this->telefono,
                    'direccion' => $this->direccion,
                ]);

                // 2. Crear el Pago
                Pago::create([
                    'coche_id' => $this->coche->id,
                    'nombre_cliente' => $this->nombre_cliente,
                    'email_cliente' => $this->email_cliente,
                    'nombre_tarjeta' => $this->nombre_tarjeta,
                    'numero_tarjeta' => substr($this->numero_tarjeta, -4), // Por seguridad, solo guardamos los últimos 4
                    'expiracion' => $this->expiracion,
                    'cv' => $this->cv,
                    'accion' => $this->accion,
                    'precio' => $this->coche->precio_compra * 1.10,
                    'fecha' => now()
                ]);

                

                // 3. Crear la Transacción
                $t = Transacciones::create([
                    'coche_id'     => $this->coche->id,
                    'proveedor_id' => $this->coche->proveedor_id ?? $this->coche->proveedore_id,
                    'cliente_id'   => $cliente->id,
                    'accion'       => 'venta',
                    'precio'       => $this->coche->precio_compra * 1.10, 
                    'fecha'        => now(),
                ]);

                // 4. Actualizar estado del coche
                $this->coche->update(['estado' => 'vendido']);

                return $t;
            });

            // Enviar correo al cliente
            Mail::to($this->email_cliente)->send(new CompraCocheMail($transaccion));

            // Enviar correo a todos los administradores
            $admins = User::where('rol', 'admin')->get();
            if ($admins->isNotEmpty()) {
                Mail::to($admins)->send(new CompraCocheMail($transaccion));
            }

            session()->flash('success', '¡Vehículo comprado con éxito!');
            return $this->redirect(route('coches.show', $this->coche->id), navigate: true);

        } catch (\Exception $e) {
            session()->flash('error', 'Error al procesar la compra: ' . $e->getMessage());
        }
    }
}; ?>

<div class="w-full sm:w-auto">
    <button wire:click="openModal" 
        @if($coche->estado === 'vendido') disabled @endif
        class="w-full sm:w-auto text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed">
        {{ $coche->estado === 'vendido' ? 'Vendido' : 'Comprar' }}
    </button>

    <div x-data="{ open: @entangle('showModal') }" x-show="open" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="open = false"></div>

            <div class="relative bg-white dark:bg-gray-800 rounded-lg max-w-lg w-full p-6 shadow-xl border dark:border-gray-700">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Confirmar Compra y Pago</h3>

                <!-- Resumen de Transacción (Coche, Proveedor, Precio, Fecha) -->
                <div class="mb-6 flex items-center gap-4 p-4 bg-indigo-50 dark:bg-gray-700/50 rounded-lg border border-indigo-100 dark:border-gray-600">
                    <img class="w-24 h-16 object-cover rounded-md shadow-sm" src="{{ $coche->imagen ? asset('storage/' . $coche->imagen) : 'https://via.placeholder.com/300x200' }}" alt="">
                    <div class="grid grid-cols-2 gap-x-4 gap-y-1 w-full text-xs sm:text-sm">
                        <p class="text-gray-600 dark:text-gray-400">Vehículo: <span class="font-bold text-gray-900 dark:text-white">{{ $coche->marca }} {{ $coche->modelo }}</span></p>
                        <p class="text-gray-600 dark:text-gray-400 text-right">Total: <span class="font-bold text-indigo-600 dark:text-indigo-400">{{ number_format($coche->precio_compra * 1.10, 0, ',', '.') }} €</span></p>
                        <p class="text-gray-600 dark:text-gray-400">Operación: <span class="font-medium text-gray-900 dark:text-white">{{ $accion }}</span></p>
                        <p class="text-gray-600 dark:text-gray-400 text-right">Fecha: <span class="font-medium text-gray-900 dark:text-white">{{ now()->format('d/m/Y') }}</span></p>
                    </div>
                </div>

                <div class="space-y-6 max-h-[60vh] overflow-y-auto px-1">
                    <!-- Sección 1: Datos de la Transacción -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-indigo-600 dark:text-indigo-400 text-xs uppercase tracking-widest border-b pb-2">Información del Cliente</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de Cliente <span class="text-red-500">*</span></label>
                            <select wire:model.live="tipo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-sm">
                                    <option value="particular">Particular</option>
                                    <option value="empresa">Empresa</option>
                                </select>
                                @error('tipo') <span class="text-red-600 dark:text-red-400 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>
                            <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $tipo === 'particular' ? 'NIF' : 'CIF' }} <span class="text-red-500">*</span></label>
                                <input wire:model="cif_nif" type="text" placeholder="Ej: 12345678Z" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-sm">
                                @error('cif_nif') <span class="text-red-600 dark:text-red-400 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre del Cliente <span class="text-red-500">*</span></label>
                            <input wire:model="nombre_cliente" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-sm">
                            @error('nombre_cliente') <span class="text-red-600 dark:text-red-400 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email del Cliente <span class="text-red-500">*</span></label>
                                <input wire:model="email_cliente" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-sm">
                                @error('email_cliente') <span class="text-red-600 dark:text-red-400 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono <span class="text-red-500">*</span></label>
                                <input wire:model="telefono" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-sm">
                                @error('telefono') <span class="text-red-600 dark:text-red-400 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dirección <span class="text-red-500">*</span></label>
                            <input wire:model="direccion" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-sm">
                            @error('direccion') <span class="text-red-600 dark:text-red-400 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Sección 2: Datos del Pago -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-indigo-600 dark:text-indigo-400 text-xs uppercase tracking-widest border-b pb-2">Detalles del Pago Seguro</h4>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Titular de la tarjeta <span class="text-red-500">*</span></label>
                            <input wire:model="nombre_tarjeta" type="text" placeholder="Nombre de la tarjeta" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-sm">
                            @error('nombre_tarjeta') <span class="text-red-600 dark:text-red-400 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Número de tarjeta <span class="text-red-500">*</span></label>
                            <input wire:model="numero_tarjeta" type="text" maxlength="16" placeholder="0000 0000 0000 0000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-sm">
                            @error('numero_tarjeta') <span class="text-red-600 dark:text-red-400 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Caducidad (MM/AA) <span class="text-red-500">*</span></label>
                                <input wire:model="expiracion" type="text" placeholder="12/25" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-sm">
                                @error('expiracion') <span class="text-red-600 dark:text-red-400 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">CVC <span class="text-red-500">*</span></label>
                                <input wire:model="cv" type="text" maxlength="3" placeholder="123" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-sm">
                                @error('cv') <span class="text-red-600 dark:text-red-400 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-4 border-t dark:border-gray-700 flex justify-end gap-3">
                    <button @click="open = false" wire:click="closeModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300">
                        Cancelar
                    </button>
                    <button wire:click="comprar" class="px-6 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 shadow-md flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        Pagar {{ number_format($coche->precio_compra * 1.10, 0, ',', '.') }} €
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
