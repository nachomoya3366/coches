<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>
<footer class="bg-white border-t border-gray-200">
  <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-6 py-6 text-sm text-gray-600 lg:flex-row lg:px-8">
    
    <!-- Logo + copyright -->
    <div class="flex items-center gap-x-3">
      <a href="{{ route('welcome') }}">
        <img src="{{ asset('storage/img/logo.png') }}" alt="logo" class="h-11 w-auto" />
      </a>
      <p>&copy; {{ date('Y') }}. Todos los derechos reservados.</p>
    </div>

    <!-- Links -->
    <div class="flex items-center gap-x-6">
      <a href="{{ route('welcome') }}" class="font-medium text-gray-600 hover:text-indigo-600 transition">
        Inicio
      </a>

      <a href="{{ route('sobre-nosotros') }}" class="font-medium text-gray-600 hover:text-indigo-600 transition">
        Sobre Nosotros
      </a>
    </div>
    
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
