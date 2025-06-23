<div class="w-full sm:max-w-4xl bg-white shadow-2xl rounded-lg overflow-hidden flex flex-col md:flex-row">
    <!-- Panel Izquierdo: Branding y Bienvenida -->
    <div class="w-full md:w-1/2 bg-gradient-to-br from-indigo-600 to-blue-500 p-8 md:p-12 text-white flex flex-col justify-center items-center text-center">
        <a href="/" class="block mb-6 transition-transform transform hover:scale-110">
            <img src="{{ asset('storage/img/Circle.png') }}" alt="Logo FixView" class="h-16 w-auto mx-auto" />
        </a>
        <h1 class="text-3xl font-bold tracking-tight">Bienvenido a FixView</h1>
        <p class="mt-3 text-indigo-200 font-light">
            Tu centro de soporte técnico de confianza. Gestiona tus reparaciones de forma fácil y rápida.
        </p>
    </div>

    <!-- Panel Derecho: Formulario -->
    <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
        {{ $slot }}
    </div>
</div>
