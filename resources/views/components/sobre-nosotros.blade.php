<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros - Coches</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <livewire:header-cliente />

    <main class="flex-grow">
    <div class="relative bg-gray-900">
        <div class="absolute inset-0 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c" alt="Background" class="h-full w-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/40"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8">
            <div class="max-w-2xl">
                <h2 class="text-base font-semibold leading-7 text-white sm:text-lg">Excelencia Automotriz</h2>
                <p class="mt-2 text-4xl font-bold tracking-tight text-white sm:text-6xl">Redefiniendo la compraventa de vehículos.</p>
                <p class="mt-6 text-lg leading-8 text-white">
                    Inspirados por el diseño de vanguardia de los grandes centros tecnológicos, hemos creado un espacio donde la transparencia y la calidad son nuestra prioridad absoluta.
                </p>
            </div>
        </div>
    </div>
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h3 class="text-2xl font-bold tracking-tight text-gray-900">Nuestra Sede: Un compromiso con el futuro</h3>
                <p class="mt-6 text-base leading-7 text-gray-600">
                    Ubicados en un entorno que respira innovación, nuestro showroom ha sido diseñado siguiendo los estándares de la arquitectura moderna. Creemos que la experiencia de adquirir un vehículo debe ser tan placentera como conducirlo.
                </p>
                <p class="mt-4 text-base leading-7 text-gray-600">
                    Utilizamos espacios abiertos y materiales sostenibles para que cada interacción sea clara, profesional y humana.
                </p>
                <div class="mt-8 flex gap-4">
                    <div class="flex flex-col border-l-2 border-indigo-600 pl-4">
                        <span class="text-2xl font-bold text-gray-900">+500</span>
                        <span class="text-sm text-gray-500">Vehículos Entregados</span>
                    </div>
                    <div class="flex flex-col border-l-2 border-indigo-600 pl-4">
                        <span class="text-2xl font-bold text-gray-900">98%</span>
                        <span class="text-sm text-gray-500">Clientes Satisfechos</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 sm:gap-6">
                <img src="https://images.unsplash.com/photo-1497366216548-37526070297c" alt="Interior Showroom Moderno" class="rounded-xl shadow-md object-cover h-64 w-full">
                <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174" alt="Espacios de Colaboración" class="rounded-xl shadow-md object-cover h-64 w-full mt-8">
            </div>
        </div>
    </div>
    <div class="bg-white py-24 border-y border-gray-200">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900">Nuestros Espacios</h2>
                <p class="mt-4 mb-4 text-lg text-gray-600">Un entorno diseñado para la toma de decisiones con total tranquilidad.</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="overflow-hidden rounded-2xl">
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab" alt="Arquitectura Exterior" class="h-80 w-full object-cover hover:scale-105 transition duration-500">
                </div>
                <div class="overflow-hidden rounded-2xl">
                    <img src="https://images.unsplash.com/photo-1431540015161-0bf868a2d407" alt="Interior Minimalista" class="h-80 w-full object-cover hover:scale-105 transition duration-500">
                </div>
                <div class="overflow-hidden rounded-2xl">
                    <img src="https://images.unsplash.com/photo-1497366811353-6870744d04b2" alt="Zona Lounge" class="h-80 w-full object-cover hover:scale-105 transition duration-500">
                </div>
                <div class="overflow-hidden rounded-2xl">
                    <img src="https://interiordesign.net/wp-content/uploads/2026/01/idx251201_Snohetta17-1-1024x683.jpg" alt="Espacios de Trabajo" class="h-80 w-full object-cover hover:scale-105 transition duration-500">
                </div>
                <div class="overflow-hidden rounded-2xl">
                    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c" alt="Innovación" class="h-80 w-full object-cover hover:scale-105 transition duration-500">
                </div>
                <div class="overflow-hidden rounded-2xl">
                    <img src="https://images.unsplash.com/photo-1460317442991-0ec209397118" alt="Fachada de Cristal" class="h-80 w-full object-cover hover:scale-105 transition duration-500">
                </div>
            </div>
        </div>
    </div>

    <div class="py-24 bg-gray-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900">Dónde nos encontramos</h2>
                <p class="mt-4 mb-4 text-lg text-gray-600">Te esperamos en nuestras instalaciones para ofrecerte la mejor atención personalizada.</p>
            </div>
            <div class="rounded-3xl overflow-hidden shadow-xl border border-gray-200">
                <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3144.833234159967!2d-3.8015689999999998!3d37.981021000000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzfCsDU4JzUxLjciTiAzwrA0OCcwNS43Ilc!5e0!3m2!1sen!2ses!4v1779185888546!5m2!1sen!2ses" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-6 py-24 text-center lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">¿Buscando tu próximo vehículo?</h2>
        <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-600">Visítanos en nuestras instalaciones y descubre una nueva forma de entender la automoción.</p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="{{ route('welcome') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Ver inventario</a>
        </div>
    </div>
    </main>

    <livewire:footer-cliente />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
</body>
</html>