<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <x-header-cliente />

    <main class="py-10">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-4 py-8 sm:px-0">
                <div class="overflow-hidden bg-white shadow sm:rounded-xl">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900">Información del Perfil</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalles personales de tu cuenta.</p>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Nombre completo</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ auth()->user()->name }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Correo electrónico</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ auth()->user()->email }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Rol de usuario</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10 uppercase">
                                        {{ auth()->user()->rol ?? 'user' }}
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:px-6 text-right">
                        <a href="{{ route('mi.configuracion') }}" class="inline-flex justify-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 transition">
                            Configurar Cuenta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
