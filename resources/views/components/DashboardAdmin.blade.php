<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <h1 class="text-2xl font-medium text-gray-900">
        Bienvenido al Dashboard Administrativo
    </h1>

    <p class="mt-2 text-gray-600">
        Aquí tienes un resumen rápido del estado del sistema.
    </p>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 p-6 lg:p-8">
    <!-- Tarjeta: Total Clientes -->
    <div class="flex items-center bg-white p-6 rounded-lg shadow-lg">
        <div>
            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.122-1.28-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.122-1.28.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
        </div>
        <div class="ml-4">
            <h2 class="text-lg font-semibold text-gray-900">{{ $stats['total_clientes'] }}</h2>
            <p class="mt-1 text-sm text-gray-600">Total de Clientes</p>
        </div>
    </div>

    <!-- Tarjeta: Total Técnicos -->
    <div class="flex items-center bg-white p-6 rounded-lg shadow-lg">
        <div>
            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
        <div class="ml-4">
            <h2 class="text-lg font-semibold text-gray-900">{{ $stats['total_tecnicos'] }}</h2>
            <p class="mt-1 text-sm text-gray-600">Técnicos Registrados</p>
        </div>
    </div>
    
    <!-- Tarjeta: Soportes Pendientes -->
    <div class="flex items-center bg-white p-6 rounded-lg shadow-lg">
        <div>
            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-yellow-500 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
        <div class="ml-4">
            <h2 class="text-lg font-semibold text-gray-900">{{ $stats['soportes_pendientes'] }}</h2>
            <p class="mt-1 text-sm text-gray-600">Soportes Pendientes</p>
        </div>
    </div>

    <!-- Tarjeta: Soportes en Proceso -->
    <div class="flex items-center bg-white p-6 rounded-lg shadow-lg">
        <div>
            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <div class="ml-4">
            <h2 class="text-lg font-semibold text-gray-900">{{ $stats['soportes_en_proceso'] }}</h2>
            <p class="mt-1 text-sm text-gray-600">Soportes en Proceso</p>
        </div>
    </div>

    <!-- Tarjeta: Soportes Completados -->
    <div class="flex items-center bg-white p-6 rounded-lg shadow-lg">
        <div>
            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <div class="ml-4">
            <h2 class="text-lg font-semibold text-gray-900">{{ $stats['soportes_completados'] }}</h2>
            <p class="mt-1 text-sm text-gray-600">Soportes Completados</p>
        </div>
    </div>

    <!-- Tarjeta: Soportes Cancelados -->
    <div class="flex items-center bg-white p-6 rounded-lg shadow-lg">
        <div>
            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-red-500 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
            </div>
        </div>
        <div class="ml-4">
            <h2 class="text-lg font-semibold text-gray-900">{{ $stats['soportes_cancelados'] }}</h2>
            <p class="mt-1 text-sm text-gray-600">Soportes Cancelados</p>
        </div>
    </div>
</div>

<!-- Últimos Soportes Registrados -->
<div class="p-6 lg:p-8 bg-white border-t border-gray-200">
    <h2 class="text-xl font-semibold text-gray-900">Últimos Soportes Registrados</h2>
    
    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cód. Seguimiento</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dispositivo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($ultimosSoportes as $soporte)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-700">{{ $soporte->codigo_seguimiento }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $soporte->cliente->nombres ?? 'N/A' }} {{ $soporte->cliente->apellidos ?? '' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $soporte->tipo_equipo }} - {{ $soporte->marca_modelo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                {{ $soporte->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $soporte->estado === 'en_proceso' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $soporte->estado === 'completado' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $soporte->estado === 'cancelado' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ $nombresEstados[$soporte->estado] ?? $soporte->estado }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $soporte->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('soportes.show', $soporte) }}" class="text-indigo-600 hover:text-indigo-900">Ver Detalles</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No hay soportes recientes.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


