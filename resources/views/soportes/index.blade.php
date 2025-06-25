<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-2 sm:space-y-0">
            <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
                {{ __('Soportes') }}
            </h2>
            @can('soportes.create')
                <a href="{{ route('soportes.create') }}" class="inline-block px-4 py-2 rounded-lg bg-indigo-600 text-white font-semibold shadow hover:bg-indigo-700 transition text-sm sm:text-base">Nuevo Soporte</a>
            @endcan
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto py-6 sm:py-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                                    <th class="hidden sm:table-cell px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dispositivo</th>
                                    <th class="hidden md:table-cell px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo Servicio</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="hidden lg:table-cell px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                    <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($soportes as $soporte)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-3 py-4 whitespace-nowrap font-mono text-xs sm:text-sm text-indigo-700">{{ $soporte->codigo_seguimiento }}</td>
                                        <td class="px-3 py-4 whitespace-nowrap text-xs sm:text-sm">
                                            <div class="font-semibold text-gray-900">{{ $soporte->cliente->nombres ?? 'Sin cliente' }} {{ $soporte->cliente->apellidos ?? '' }}</div>
                                            <div class="text-xs text-gray-500">{{ $soporte->cliente->telefono ?? '' }}</div>
                                        </td>
                                        <td class="hidden sm:table-cell px-3 py-4 whitespace-nowrap text-xs sm:text-sm">
                                            <div class="font-medium text-gray-900">{{ $soporte->tipo_equipo }}</div>
                                            <div class="text-xs text-gray-500">{{ $soporte->marca_modelo }}</div>
                                        </td>
                                        <td class="hidden md:table-cell px-3 py-4 whitespace-nowrap text-xs sm:text-sm">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ $soporte->tipo_servicio === 'mantenimiento_preventivo' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $soporte->tipo_servicio === 'mantenimiento_correctivo' ? 'bg-red-100 text-red-800' : '' }}
                                                {{ $soporte->tipo_servicio === 'instalacion_software' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $soporte->tipo_servicio === 'diagnostico' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $soporte->tipo_servicio === 'otros' ? 'bg-gray-100 text-gray-800' : '' }}">
                                                {{ \App\Models\Soporte::getTiposServicio()[$soporte->tipo_servicio] ?? $soporte->tipo_servicio }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-4 whitespace-nowrap text-xs sm:text-sm">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ $soporte->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $soporte->estado === 'en_proceso' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $soporte->estado === 'completado' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $soporte->estado === 'cancelado' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ \App\Models\Soporte::getEstados()[$soporte->estado] ?? $soporte->estado }}
                                            </span>
                                        </td>
                                        <td class="hidden lg:table-cell px-3 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500">{{ $soporte->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-3 py-4 whitespace-nowrap text-center">
                                            <div class="flex flex-col sm:flex-row gap-1 sm:gap-2 justify-center">
                                                @can('soportes.show')
                                                    <a href="{{ route('soportes.show', $soporte) }}" class="inline-flex items-center justify-center gap-1 px-2 py-1.5 rounded-lg bg-blue-100 text-blue-700 font-semibold shadow-sm hover:bg-blue-200 transition text-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                        Ver
                                                    </a>
                                                @endcan
                                                <a href="{{ route('soportes_Tecni.edit', $soporte) }}" class="inline-flex items-center justify-center gap-1 px-2 py-1.5 rounded-lg bg-yellow-100 text-yellow-800 font-semibold shadow-sm hover:bg-yellow-200 transition text-xs">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 21l3-1.5L15 21l-.75-4M4 4h16v2a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" /></svg>
                                                    Diag.
                                                </a>
                                                @can('soportes.edit')
                                                    <a href="{{ route('soportes.edit', $soporte) }}" class="inline-flex items-center justify-center gap-1 px-2 py-1.5 rounded-lg bg-green-100 text-green-800 font-semibold shadow-sm hover:bg-green-200 transition text-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2m-1 0v14m-7-7h14" /></svg>
                                                        Editar
                                                    </a>
                                                @endcan
                                                @can('soportes.destroy')
                                                    <form action="{{ route('soportes.destroy', $soporte) }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea eliminar este soporte?')" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center justify-center gap-1 px-2 py-1.5 rounded-lg bg-red-100 text-red-700 font-semibold shadow-sm hover:bg-red-200 transition text-xs">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                            Elim.
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-3 py-4 text-center text-sm text-gray-500">No hay soportes registrados</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        @if($soportes->hasPages())
            <div class="mt-4 px-4 sm:px-0">
                {{ $soportes->links() }}
            </div>
        @endif
    </div>
</x-app-layout>