<!DOCTYPE html>
<html lang="es" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - {{ config('app.name') }}</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('storage/img/logo.png') }}" alt="Logo" class="mx-auto w-auto h-[100px]" />
            </a>
            <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-gray-900">
                ¿Olvidó su contraseña?
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                No hay problema. Indíquenos su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña.
            </p>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <!-- Estado de la sesión (Mensaje de éxito) -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 p-3 bg-green-50 rounded-lg border border-green-200">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" class="space-y-6" novalidate>
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900">Correo electrónico <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 @error('email') outline-red-500 @else outline-gray-300 @enderror placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors">
                        Enviar enlace de recuperación
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">
                    &larr; Volver al inicio de sesión
                </a>
            </p>
        </div>
    </div>
</body>
</html>