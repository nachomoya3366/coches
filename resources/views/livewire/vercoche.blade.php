<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/src/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
  @livewireStyles

</head>
<body>
<livewire:header-cliente />
<section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">

      {{-- Notificación de Éxito Dinámica --}}
      @if (session('success'))
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 5000)"
            class="fixed top-0 left-0 w-full z-[100] bg-green-600 text-white p-5 text-center text-lg font-bold shadow-2xl" 
            role="alert"
        >
            <div class="flex justify-center items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
      @endif

      @if (session()->has('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 border border-red-200 dark:border-red-900" role="alert">
          <span class="font-medium">Aviso:</span> {{ session('error') }}
        </div>
      @endif

      <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
        <div class="shrink-0 max-w-md lg:max-w-lg mx-auto bg-gray-100 rounded-lg p-4 flex items-center">
          <img 
            class="w-full rounded-lg shadow-sm" 
            src="{{ $coche->imagen ? asset('storage/' . $coche->imagen) : 'https://via.placeholder.com/800x600?text=Coche+sin+foto' }}" 
            alt="{{ $coche->marca }} {{ $coche->modelo }}" 
          />
        </div>

        <div class="mt-6 sm:mt-8 lg:mt-0">
          <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
            {{ $coche->marca }} {{ $coche->modelo }}
          </h1>

          <div class="mt-4 flex items-center gap-4">
            <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                {{ number_format($coche->precio_compra * 1.10, 0, ',', '.') }} €
            </p>
            <span class="inline-block rounded bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">
                {{ strtoupper($coche->estado) }}
            </span>
          </div>

          <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
            <a
              href="javascript:history.back()"
              class="w-full sm:w-auto flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-indigo-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
              role="button"
            >
              <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4l4 4"/>
              </svg>
              Volver al listado
            </a>

            <livewire:reserva-cita :coche="$coche" />
            <livewire:comprar-coche :coche="$coche" />
          </div>

          <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

          <div class="grid grid-cols-2 gap-y-4 text-gray-500 dark:text-gray-400">
            <div>
                <p class="text-xs uppercase font-bold text-gray-400">Kilómetros</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ number_format($coche->kilometros) }} km</p>
            </div>
            <div>
                <p class="text-xs uppercase font-bold text-gray-400">Combustible</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ ucfirst($coche->combustible) }}</p>
            </div>
            <div>
                <p class="text-xs uppercase font-bold text-gray-400">Año</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $coche->año }}</p>
            </div>
            <div>
                <p class="text-xs uppercase font-bold text-gray-400">Color</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ ucfirst($coche->color) }}</p>
            </div>
            <div>
                <p class="text-xs uppercase font-bold text-gray-400">Matrícula</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $coche->matricula }}</p>
            </div>
          </div>
          
          <div class="mt-8">
              <p class="mb-6 text-gray-500 dark:text-gray-400">
                Vehículo en excelente estado, revisado por nuestros técnicos. Se entrega con garantía y mantenimiento al día.
              </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <livewire:footer-cliente />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
  <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
  @livewireScripts
</body>
</html>