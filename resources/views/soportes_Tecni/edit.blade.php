<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Diagnóstico del Soporte') }} #{{ $soporte->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('soportes_Tecni.update', $soporte) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Información del Cliente y Dispositivo (solo lectura) -->
                        <div class="mb-8 p-4 border border-gray-200 rounded-lg bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                                Resumen del Caso
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div><strong>Cliente:</strong> {{ $soporte->cliente->nombres ?? '' }} {{ $soporte->cliente->apellidos ?? '' }}</div>
                                <div><strong>Identificación:</strong> {{ $soporte->cliente->numero_identificacion ?? '' }}</div>
                                <div><strong>Teléfono:</strong> {{ $soporte->cliente->telefono ?? '' }}</div>
                                <div><strong>Correo:</strong> {{ $soporte->cliente->correo ?? '' }}</div>
                                <div><strong>Dispositivo:</strong> {{ $soporte->marca_modelo }}</div>
                                <div><strong>Problema reportado:</strong> {{ $soporte->descripcion_problema }}</div>
                                <div><strong>Tipo de Servicio:</strong> {{ $soporte->tipo_servicio }}</div>
                            </div>
                        </div>

                        <!-- Diagnóstico y Gestión Técnica -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                                Diagnóstico y Gestión Técnica
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Estado del Soporte -->
                                <div>
                                    <x-label for="estado" value="Estado del Soporte *" />
                                    <select id="estado" name="estado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                        @foreach($estados as $key => $value)
                                        <option value="{{ $key }}" {{ old('estado', $soporte->estado) == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="estado" class="mt-2" />
                                </div>
                            </div>

                            <!-- Diagnóstico Técnico -->
                            <div class="mt-4">
                                <x-label for="diagnostico_tecnico" value="Diagnóstico Técnico *" />
                                <textarea id="diagnostico_tecnico" name="diagnostico_tecnico" rows="5"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('diagnostico_tecnico', $soporte->diagnostico_tecnico) }}</textarea>
                                <x-input-error for="diagnostico_tecnico" class="mt-2" />
                            </div>

                            <!-- Costo Estimado -->
                            <div class="mt-4">
                                <x-label for="costo_estimado" value="Costo Estimado" />
                                <x-input id="costo_estimado" type="number" name="costo_estimado" step="0.01"
                                    class="mt-1 block w-full" value="{{ old('costo_estimado', $soporte->costo_estimado) }}" />
                                <x-input-error for="costo_estimado" class="mt-2" />
                            </div>

                            <!-- Evidencia del Técnico (Fotos) -->
                            <div class="mt-4">
                                <!-- Mostrar evidencias existentes -->
                                @if($soporte->evidencia_tecnico && count($soporte->evidencia_tecnico) > 0)
                                <div class="mt-4">
                                    <x-label value="Evidencia actual" />
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
                                        @foreach($soporte->evidencia_tecnico as $foto)
                                        <div class="relative">
                                            <img src="{{ Storage::url($foto) }}" alt="Evidencia del técnico"
                                                class="w-full h-32 object-cover rounded-lg">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                <div class="mt-4">
                                    <x-label for="evidencia_tecnico" value="Agregar nueva evidencia (fotos)" />
                                    <input id="evidencia_tecnico" type="file" name="evidencia_tecnico[]" multiple
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        accept="image/*" />
                                    <p class="mt-1 text-sm text-gray-500">Puede seleccionar múltiples imágenes</p>
                                    <x-input-error for="evidencia_tecnico" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('soportes.show', $soporte) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                Cancelar
                            </a>
                            <x-button class="ml-4">
                                {{ __('Guardar Diagnóstico') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>