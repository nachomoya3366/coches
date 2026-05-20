<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <x-header-cliente />

    <main class="py-10">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="space-y-6 px-4 sm:px-0">

                @if (session('success'))
                    <div class="rounded-xl bg-green-50 p-4 border border-green-200">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="bg-white shadow sm:rounded-xl overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900">Información Personal</h3>
                        <p class="mt-1 text-sm text-gray-600">Actualiza tu información básica de contacto.</p>
                        <form action="{{ route('mi.perfil.update') }}" method="POST" class="mt-6 space-y-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="mt-1 block w-full rounded-xl border @error('name') border-red-500 @else border-gray-300 @enderror px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                @error('name')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="mt-1 block w-full rounded-xl border @error('email') border-red-500 @else border-gray-300 @enderror px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                @error('email')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-end pt-2">
                                <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 transition">
                                    Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="bg-white shadow sm:rounded-xl overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900">Seguridad</h3>
                        <p class="mt-1 text-sm text-gray-600">Cambie su contraseña actual por una nueva.</p>

                        <form action="{{ route('mi.password.update') }}" method="POST" class="mt-6 space-y-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700">Contraseña Actual</label>
                                <input type="password" name="current_password" id="current_password" class="mt-1 block w-full rounded-xl border @error('current_password') border-red-500 @else border-gray-300 @enderror px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                @error('current_password')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Nueva Contraseña</label>
                                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-xl border @error('password') border-red-500 @else border-gray-300 @enderror px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                @error('password')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Nueva Contraseña</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-xl border @error('password_confirmation') border-red-500 @else border-gray-300 @enderror px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                @error('password_confirmation')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 transition">
                                    Actualizar Contraseña
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="flex justify-center pb-10">
                    <a href="{{ route('mi.perfil') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                        &larr; Volver a mi perfil
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
