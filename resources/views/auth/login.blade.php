<!DOCTYPE html>
<html lang="es" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
</head>
  <body class="h-full">
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <a href="{{ route('welcome') }}">
      <img src="{{ asset('/storage/img/logo.png')  }}" alt="Your Company" class="mx-auto w-[180px] h-[100px]" />
    </a>
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Inicie sesión en su cuenta</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form action="{{ route('login') }}" method="POST" class="space-y-6" novalidate>
      @csrf
      <div>
        <label for="email" class="block text-sm/6 font-medium text-gray-900">Correo electrónico <span class="text-red-500">*</span></label>
        <div class="mt-2">
          <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 @error('email') outline-red-500 @else outline-gray-300 @enderror placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
        </div>
        @error('email')
          <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Contraseña <span class="text-red-500">*</span></label>
          <div class="text-sm">
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">¿Olvidó su contraseña?</a>
            @endif
          </div>
        </div>
        <div class="mt-2">
          <input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 @error('password') outline-red-500 @else outline-gray-300 @enderror placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
        </div>
        @error('password')
          <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Iniciar sesión</button>
      </div>
    </form>

    <p class="mt-10 text-center text-sm/6 text-gray-500">
      ¿No tiene una cuenta?
      <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Regístrese</a>
    </p>
  </div>
</div>
</body>
</html>