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