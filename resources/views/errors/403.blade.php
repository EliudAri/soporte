<x-app-layout>
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- TailwindCSS CDN (solo para la vista de error) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lottie Player -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <style>
        body { background: linear-gradient(135deg, #f8fafc 0%, #dbeafe 100%); }
        .floating {
            animation: floating 2.5s ease-in-out infinite;
        }
        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-18px); }
        }
        .shake {
            animation: shake 0.7s cubic-bezier(.36,.07,.19,.97) both;
        }
        @keyframes shake {
            10%, 90% { transform: translateX(-2px); }
            20%, 80% { transform: translateX(4px); }
            30%, 50%, 70% { transform: translateX(-8px); }
            40%, 60% { transform: translateX(8px); }
        }
    </style>
    <div class="flex flex-col items-center justify-center w-full min-h-[80vh]">
        <div class="floating animate__animated animate__fadeInDown">
            <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_jtbfg2nb.json" background="transparent" speed="1" style="width: 220px; height: 220px;" loop autoplay></lottie-player>
        </div>
        <h1 class="text-6xl font-extrabold text-red-500 mt-4 animate__animated animate__heartBeat animate__delay-1s">403</h1>
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mt-2 animate__animated animate__fadeInUp animate__delay-1s">¡Acceso Denegado!</h2>
        <p class="text-gray-500 text-center mt-4 max-w-md animate__animated animate__fadeInUp animate__delay-2s">
            Ups... Parece que intentaste entrar a una zona prohibida.<br>
            No tienes permisos para acceder a esta página.<br>
            Si crees que esto es un error, contacta al soporte técnico.
        </p>
        <a href="/dashboard" class="mt-8 px-8 py-3 bg-blue-600 text-white rounded-full shadow-lg text-lg font-semibold hover:bg-blue-700 transition-all duration-200 shake animate__animated animate__fadeInUp animate__delay-3s">
            Volver al inicio
        </a>
        <div class="mt-10 animate__animated animate__fadeIn animate__delay-2s">
            <span class="inline-block bg-red-100 text-red-600 px-4 py-1 rounded-full text-sm font-medium shadow">Ruta equivocada</span>
        </div>
        <footer class="mt-12 text-gray-400 text-xs animate__animated animate__fadeIn animate__delay-3s">
            Soporte Técnico FixView &copy; {{ date('Y') }}
        </footer>
    </div>
</x-app-layout>