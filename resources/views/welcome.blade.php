<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/src/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <livewire:header-cliente />

    <main class="flex-grow">
    @yield('content')

{{-- Reservation Success Notification --}}
@if (session('success'))
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-init="setTimeout(() => show = false, 8000)"
        class="fixed top-5 right-5 z-[100] flex items-center p-5 mb-4 text-green-800 rounded-lg bg-white dark:bg-gray-800 dark:text-green-400 border border-green-200 shadow-2xl max-w-md" 
        role="alert"
    >
        <svg class="flex-shrink-0 w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ml-4">
            @php
                $isCompra = str_contains(session('success'), 'pago') || str_contains(session('success'), 'tuyo');
                $titulo = $isCompra ? '¡Compra Realizada!' : '¡Reserva Confirmada!';
            @endphp
            <p class="text-lg font-bold">{{ $titulo }}</p>
            <p class="text-base font-medium">
                {{ session('success') }}
            </p>
        </div>
        <button @click="show = false" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-100 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" aria-label="Close">
            <span class="sr-only">Cerrar</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
@endif

<section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
      <div>
        <!--<nav class="flex" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
              <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">
                <svg class="me-2.5 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                </svg>
                Inicio
              </a>
            </li>
            <li>
              <div class="flex items-center">
                <svg class="h-5 w-5 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                </svg>
                <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white md:ms-2">Productos</a>
              </div>
            </li>
            <li aria-current="page">
              <div class="flex items-center">
                <svg class="h-5 w-5 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                </svg>
                <span class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400 md:ms-2">Vehículos</span>
              </div>
            </li>
          </ol>
        </nav>--> 
        <h2 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Vehículos</h2>
      </div>
      <div class="flex items-center space-x-4">
        <button data-modal-toggle="filterModal" data-modal-target="filterModal" type="button" class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto">
          <svg class="-ms-0.5 me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z" />
          </svg>
          Filtros
          <svg class="-me-0.5 ms-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
          </svg>
        </button>
        <!--<button id="sortDropdownButton1" data-dropdown-toggle="dropdownSort1" type="button" class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto">
          <svg class="-ms-0.5 me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M7 4l3 3M7 4 4 7m9-3h6l-6 6h6m-6.5 10 3.5-7 3.5 7M14 18h4" />
          </svg>
          Ordenar por
          <svg class="-me-0.5 ms-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
          </svg>
        </button>
        <div id="dropdownSort1" class="z-50 hidden w-40 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" data-popper-placement="bottom">
          <ul class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400" aria-labelledby="sortDropdownButton">
            <li>
              <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"> The most popular </a>
            </li>
            <li>
              <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"> Newest </a>
            </li>
            <li>
              <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"> Increasing price </a>
            </li>
            <li>
              <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"> Decreasing price </a>
            </li>
            <li>
              <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"> No. reviews </a>
            </li>
            <li>
              <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"> Discount % </a>
            </li>
          </ul>
        </div>-->
      </div>
    </div>
    <div class="mb-4 grid w-full grid-cols-1 gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
        @forelse($coches as $coche)
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="w-full">
                <img 
                    class="mx-auto h-full object-contain"
                    src="{{ $coche->imagen ? asset('storage/' . $coche->imagen) : 'https://via.placeholder.com/300x200' }}"
                    alt="{{ $coche->marca }} {{ $coche->modelo }}"
                />
            </div>

            <div class="pt-6">

                <a href="{{ route('coches.show', $coche->id) }}" class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">
                    {{ $coche->marca }} {{ $coche->modelo }}
                </a>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ $coche->color }} • {{ $coche->año }} • {{ number_format($coche->kilometros) }} km
                </p>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ strtoupper($coche->combustible) }} • {{ $coche->matricula }}
                </p>

                <span class="mt-2 inline-block rounded bg-gray-100 px-2 py-1 text-xs font-medium 
                    {{ $coche->estado == 'stock' ? 'text-green-700' : 'text-red-700' }}">
                    {{ strtoupper($coche->estado) }}
                </span>

                <div class="mt-4 flex items-center justify-between gap-4">
                    <p class="text-2xl font-extrabold text-gray-900 dark:text-white">
                        {{ number_format($coche->precio_compra * 1.10, 0, ',', '.') }} €
                    </p>

                    <a href="{{ route('coches.show', $coche->id) }}"
                        class="inline-flex items-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                        Ver coche
                    </a>
                </div>

            </div>
        </div>
        @empty
            <div class="col-span-full flex w-full justify-center py-20">
                <div class="flex max-w-md flex-col items-center text-center">
                    <div class="mb-4 rounded-full bg-gray-100 p-6 dark:bg-gray-800">
                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        @if($filtrosActivos)
                            No hay resultados para el filtro aplicado
                        @else
                            No hay coches disponibles en este momento
                        @endif
                    </h3>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">
                        @if($filtrosActivos)
                            Prueba a ajustar tus criterios de búsqueda o limpiar los filtros para ver más opciones.
                        @else
                            Vuelve a consultarnos más tarde.
                        @endif
                    </p>
                    @if($filtrosActivos)
                        <a href="{{ route('welcome') }}" class="mt-6 inline-flex items-center justify-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                            Limpiar todos los filtros
                        </a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>
    <div class="mt-8">
        {{ $coches->appends(request()->query())->links() }}
    </div>
  </div>
  <form action="{{ url()->current() }}" method="get" id="filterModal" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0 md:h-full">
    <div class="relative h-full w-full max-w-xl md:h-auto">
      <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
        <div class="flex items-start justify-between rounded-t p-4 md:p-5">
          <h3 class="text-lg font-normal text-gray-500 dark:text-gray-400">Filtros de búsqueda</h3>
          <button type="button" class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="filterModal">
            <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
          </button>
        </div>
        <div class="px-4 md:px-5">
          <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="-mb-px flex flex-wrap text-center text-sm font-medium" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
              <li class="mr-1" role="presentation">
                <button class="inline-block pb-2 pr-1" id="brand-tab" data-tabs-target="#brand" type="button" role="tab" aria-controls="brand" aria-selected="true">Marca</button>
              </li>
              <li class="mr-1" role="presentation">
                <button class="inline-block px-2 pb-2 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300" id="advanced-filters-tab" data-tabs-target="#advanced-filters" type="button" role="tab" aria-controls="advanced-filters" aria-selected="false">Otros Filtros</button>
              </li>
            </ul>
          </div>
          <div id="myTabContent">
            <div class="grid grid-cols-2 gap-4 md:grid-cols-3" id="brand" role="tabpanel" aria-labelledby="brand-tab">
                @php
                    $marcas = ['Alfa Romeo', 'Audi', 'BMW', 'Citroen', 'Ferrari', 'Fiat', 'Ford', 'Honda', 'Hyundai', 'Jeep', 'Kia', 'Lamborghini', 'Land Rover', 'Mazda', 'Mercedes', 'Mini', 'Nissan', 'Opel', 'Peugeot', 'Porsche', 'Renault', 'Seat', 'Skoda', 'Subaru', 'Toyota', 'Volkswagen', 'Volvo'];
                @endphp
                @foreach ($marcas as $marca)
                <div class="flex items-center">
                    <input name="marca[]" id="brand-{{ Str::slug($marca) }}" type="checkbox" value="{{ $marca }}" 
                        {{ in_array($marca, (array) request('marca', [])) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-indigo-600 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-indigo-600" />
                    <label for="brand-{{ Str::slug($marca) }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> {{ $marca }} </label>
                </div>
                @endforeach
            </div>

            <div class="hidden space-y-4" id="advanced-filters" role="tabpanel" aria-labelledby="advanced-filters-tab">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
              <div class="space-y-2">
                <h6 class="text-sm font-medium text-gray-900 dark:text-white">Precio (€)</h6>
                <div class="flex items-center space-x-2">
                  <input type="number" name="min_price" value="{{ request('min_price') }}" min="0" step="500" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Mín">
                  <span class="text-gray-500">-</span>
                  <input type="number" name="max_price" value="{{ request('max_price') }}" min="0" step="500" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Máx">
                </div>
              </div>

              <!-- Kilometraje -->
              <div class="space-y-2">
                <h6 class="text-sm font-medium text-gray-900 dark:text-white">Kilómetros máximos</h6>
                <input type="number" name="max_km" value="{{ request('max_km') }}" min="0" step="10000" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Ej: 50000">
              </div>

              <!-- Año -->
              <div class="space-y-2">
                <h6 class="text-sm font-medium text-gray-900 dark:text-white">Año de fabricación</h6>
                <div class="flex items-center space-x-2">
                  <input type="number" name="min_year" value="{{ request('min_year') }}" min="1900" max="{{ date('Y') }}" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Desde">
                  <span class="text-gray-500">-</span>
                  <input type="number" name="max_year" value="{{ request('max_year') }}" min="1900" max="{{ date('Y') }}" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Hasta">
                </div>
              </div>

              <!-- Combustible -->
              <div class="space-y-2">
                <h6 class="text-sm font-medium text-gray-900 dark:text-white">Combustible</h6>
                <div class="grid grid-cols-2 gap-2">
                  @foreach(['Gasolina', 'Diésel'] as $fuel)
                  <div class="flex items-center">
                    <input name="combustible[]" id="fuel-{{ Str::slug($fuel) }}" type="checkbox" value="{{ strtolower($fuel) }}"
                      {{ in_array(strtolower($fuel), (array) request('combustible', [])) ? 'checked' : '' }}
                      class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                    <label for="fuel-{{ Str::slug($fuel) }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $fuel }}</label>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
              <!-- Color -->
              <div>
                <h6 class="mb-2 text-sm font-medium text-black dark:text-white">Color</h6>
                <div class="space-y-2">
                  @foreach(['Blanco', 'Negro', 'Gris', 'Azul', 'Rojo'] as $color)
                  <div class="flex items-center">
                    <input name="color[]" id="color-{{ Str::slug($color) }}" type="checkbox" value="{{ $color }}" 
                      {{ in_array($color, (array) request('color', [])) ? 'checked' : '' }}
                      class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                    <label for="color-{{ Str::slug($color) }}" class="ml-2 flex items-center text-sm text-gray-900 dark:text-gray-300">
                      <div class="mr-2 h-3 w-3 rounded-full border border-gray-200" style="background-color: {{ 
                          match($color) {
                            'Blanco' => '#ffffff',
                            'Negro' => '#000000',
                            'Gris' => '#808080',
                            'Azul' => '#0000ff',
                            'Rojo' => '#ff0000',
                            default => '#cccccc'
                          } 
                        }}"></div>
                      {{ $color }}
                    </label>
                  </div>
                  @endforeach
                </div>
            </div>
          </div>
        </div>
        </div>
        </div>
        <div class="flex items-center space-x-4 rounded-b p-4 dark:border-gray-600 md:p-5">
          <button type="submit" class="rounded-lg bg-indigo-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-600 dark:focus:ring-indigo-800">Mostrar resultados</button>
          <a href="{{ url()->current() }}" class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-indigo-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Limpiar filtros</a>
        </div>
      </div>
    </div>
  </form>
</section>
</main>

<livewire:footer-cliente />
<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
</body>
</html>