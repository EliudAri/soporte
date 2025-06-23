<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FixView</title>
   
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-gray-50 text-gray-800">
        <div class="min-h-screen flex flex-col">
            <!-- Header -->
            <header class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center py-4">
                        <!-- Logo -->
                        <div class="flex items-center space-x-3">
                             <img src="{{ asset('storage/img/Circle.png') }}" alt="Logo FixView" class="h-10 w-auto"/>
                             <span class="text-2xl font-bold text-gray-900 tracking-tight">FixView</span>
                        </div>

                        <!-- Navigation -->
                        <nav class="hidden md:flex items-center space-x-2">
                             @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors">Iniciar Sesión</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-2 px-4 py-2 rounded-md text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-transform transform hover:scale-105">Registrarse</a>
                                    @endif
                                @endauth
                            @endif
                        </nav>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-grow flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-16">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 tracking-tight">
                        <span class="block">Sigue el estado de tu</span>
                        <span class="block text-indigo-600 mt-1">reparación en tiempo real.</span>
                    </h1>
                    <p class="mt-5 max-w-md mx-auto text-lg text-gray-500 sm:text-xl md:mt-6">
                        Ingresa tu código de seguimiento para ver cada paso del proceso de soporte de tu equipo.
                    </p>

                    <!-- Tracking Form -->
                    <div class="mt-10 max-w-md mx-auto">
                        <form action="#" method="GET" class="sm:flex sm:gap-3">
                            <div class="w-full">
                                <label for="tracking_code" class="sr-only">Código de seguimiento</label>
                                <input type="text" name="tracking_code" id="tracking_code" class="block w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Ingresa tu código aquí">
            </div>
                            <div class="mt-3 sm:mt-0 sm:shrink-0">
                                <button type="submit" class="w-full flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Buscar
                                </button>
            </div>
                        </form>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white mt-8">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <p class="text-center text-sm text-gray-500">
                        &copy; {{ date('Y') }} FixView. Todos los derechos reservados.
                    </p>
            </div>
            </footer>
        </div>
    </body>
</html>
