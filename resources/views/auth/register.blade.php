<!DOCTYPE html>
<html lang="es" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Coches</title>
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
      Crear una cuenta
    </h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

    <form action="{{ route('register') }}" method="POST" class="space-y-6" novalidate>
    @csrf

    <div>
      <label for="name" class="block text-sm font-medium text-gray-900">Nombre completo <span class="text-red-500">*</span></label>
      <div class="mt-2">
        <input id="name" name="name" type="text" 
          value="{{ old('name') }}"
          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 @error('name') outline-red-500 @else outline-gray-300 @enderror placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
      </div>
      @error('name')
        <p class="mt-2 text-sm text-red-600 font-medium"> {{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="email" class="block text-sm font-medium text-gray-900">Correo electrónico <span class="text-red-500">*</span></label>
      <div class="mt-2">
        <input id="email" name="email" type="email" 
          value="{{ old('email') }}"
          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 @error('email') outline-red-500 @else outline-gray-300 @enderror placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
      </div>
      @error('email')
        <p class="mt-2 text-sm text-red-600 font-medium"> {{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="password" class="block text-sm font-medium text-gray-900">Contraseña <span class="text-red-500">*</span></label>
      <div class="mt-2">
        <input id="password" name="password" type="password"
          minlength="8" maxlength="16"
          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 @error('password') outline-red-500 @else outline-gray-300 @enderror placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
      </div>
      @error('password')
        <p class="mt-2 text-sm text-red-600 font-medium"> {{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="password_confirmation" class="block text-sm font-medium text-gray-900">Confirmar contraseña <span class="text-red-500">*</span></label>
      <div class="mt-2">
        <input id="password_confirmation" name="password_confirmation" type="password"
          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
      </div>
    </div>

    <div>
      <button type="submit"
        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors">
        Crear cuenta
      </button>
    </div>
  </form>

    <p class="mt-10 text-center text-sm text-gray-500">
      ¿Ya tiene una cuenta?
      <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">
        Iniciar sesión
      </a>
    </p>

  </div>

</div>

<script>
    const password = document.getElementById('password');
    const confirm = document.getElementById('password_confirmation');

    function validatePassword() {
        if (password.value !== confirm.value) {
            confirm.setCustomValidity("Las contraseñas no coinciden");
        } else {
            confirm.setCustomValidity('');
        }
    }

    // Se ejecuta cada vez que el usuario escribe
    password.addEventListener('input', validatePassword);
    confirm.addEventListener('input', validatePassword);
</script>
</body>
</html>