<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Soportes') }}
            </h2>
            @can('soportes.create')
            <a href="{{ route('soportes.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Nuevo Soporte') }}
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cliente
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Dispositivo
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tipo Servicio
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($soportes as $soporte)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $soporte->cliente->nombres ?? 'Sin cliente' }} {{ $soporte->cliente->apellidos ?? '' }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $soporte->cliente->telefono ?? '' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $soporte->tipo_equipo }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $soporte->marca_modelo }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ $soporte->tipo_servicio === 'mantenimiento_preventivo' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $soporte->tipo_servicio === 'mantenimiento_correctivo' ? 'bg-red-100 text-red-800' : '' }}
                                                {{ $soporte->tipo_servicio === 'instalacion_software' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $soporte->tipo_servicio === 'diagnostico' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $soporte->tipo_servicio === 'otros' ? 'bg-gray-100 text-gray-800' : '' }}">
                                            {{ \App\Models\Soporte::getTiposServicio()[$soporte->tipo_servicio] ?? $soporte->tipo_servicio }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ $soporte->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $soporte->estado === 'en_proceso' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $soporte->estado === 'completado' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $soporte->estado === 'cancelado' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ \App\Models\Soporte::getEstados()[$soporte->estado] ?? $soporte->estado }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $soporte->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            @can('soportes.show')
                                            <a href="{{ route('soportes.show', $soporte) }}"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                Ver
                                            </a>
                                            @endcan
                                            
                                            <a href="{{ route('soportes_Tecni.edit', $soporte) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                Diagnosticar
                                            </a>
                                            
                                            @can('soportes.edit')
                                            <a href="{{ route('soportes.edit', $soporte) }}"
                                                class="text-green-600 hover:text-green-900">
                                                Editar
                                            </a>
                                            @endcan
                                            @can('soportes.destroy')
                                            <form action="{{ route('soportes.destroy', $soporte) }}" method="POST"
                                                onsubmit="return confirm('¿Está seguro de que desea eliminar este soporte?')"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    Eliminar
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        No hay soportes registrados
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($soportes->hasPages())
                    <div class="mt-4">
                        {{ $soportes->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>