<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalle del Soporte') }}
            </h2>
            <div class="flex space-x-2">
                @can('soportes.edit')
                <a href="{{ route('soportes.edit', $soporte) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Editar') }}
                </a>
                @endcan
                <a href="{{ route('soportes.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Volver') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Estado del soporte -->
                    <div class="mb-6">
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                            {{ $soporte->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $soporte->estado === 'en_proceso' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $soporte->estado === 'completado' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $soporte->estado === 'cancelado' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ $estados[$soporte->estado] ?? $soporte->estado }}
                        </span>
                        <span class="ml-4 text-sm text-gray-500">
                            Creado el {{ $soporte->created_at->format('d/m/Y H:i') }}
                        </span>
                    </div>

                    <!-- 1. Datos del Cliente -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                            1. Datos del Cliente
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nombre completo</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $soporte->cliente->nombres ?? '' }} {{ $soporte->cliente->apellidos ?? '' }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Número de identificación</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $soporte->cliente->numero_identificacion ?? 'No especificado' }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Teléfono / WhatsApp</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $soporte->cliente->telefono ?? '' }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $soporte->cliente->correo ?? '' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Datos del Dispositivo -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                            2. Datos del Dispositivo
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tipo de equipo</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $tiposEquipo[$soporte->tipo_equipo] ?? $soporte->tipo_equipo }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Marca y modelo</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $soporte->marca_modelo }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Serial o IMEI</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $soporte->serial_imei ?: 'No especificado' }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Estado de encendido</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $soporte->estado_encendido === 'enciende' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $soporte->estado_encendido === 'enciende' ? 'Enciende' : 'No enciende' }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        @if($soporte->accesorios_entregados)
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Accesorios entregados</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $soporte->accesorios_entregados }}</p>
                        </div>
                        @endif

                        @if($soporte->condicion_fisica)
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Condición física actual</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $soporte->condicion_fisica }}</p>
                        </div>
                        @endif

                        @if($soporte->fotos_estado && count($soporte->fotos_estado) > 0)
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Fotos del estado actual</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
                                @foreach($soporte->fotos_estado as $foto)
                                <div class="relative">
                                    <img src="{{ Storage::url($foto) }}" alt="Foto del dispositivo"
                                        class="w-full h-32 object-cover rounded-lg cursor-pointer"
                                        onclick="openImageModal('{{ Storage::url($foto) }}')">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- 3. Motivo de la entrega -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                            3. Motivo de la entrega
                        </h3>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Descripción del problema</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $soporte->descripcion_problema }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tipo de servicio solicitado</label>
                            <p class="mt-1">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $soporte->tipo_servicio === 'mantenimiento_preventivo' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $soporte->tipo_servicio === 'mantenimiento_correctivo' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $soporte->tipo_servicio === 'instalacion_software' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $soporte->tipo_servicio === 'diagnostico' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $soporte->tipo_servicio === 'otros' ? 'bg-gray-100 text-gray-800' : '' }}">
                                    {{ $tiposServicio[$soporte->tipo_servicio] ?? $soporte->tipo_servicio }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- 4. Checklist Técnico -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                            4. Checklist Técnico
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center">
                                <div class="w-4 h-4 rounded-full mr-3 {{ $soporte->equipo_arranca ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                <span class="text-sm text-gray-900">
                                    ¿Equipo arranca?
                                    <span class="ml-2 font-semibold {{ $soporte->equipo_arranca ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $soporte->equipo_arranca ? 'Sí' : 'No' }}
                                    </span>
                                </span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 rounded-full mr-3 {{ $soporte->pantalla_fallos ? 'bg-red-500' : 'bg-green-500' }}"></div>
                                <span class="text-sm text-gray-900">
                                    ¿Pantalla presenta fallos?
                                    <span class="ml-2 font-semibold {{ $soporte->pantalla_fallos ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $soporte->pantalla_fallos ? 'Sí' : 'No' }}
                                    </span>
                                </span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 rounded-full mr-3 {{ $soporte->teclado_puertos_funcionando ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                <span class="text-sm text-gray-900">
                                    ¿Teclado / Puertos funcionando?
                                    <span class="ml-2 font-semibold {{ $soporte->teclado_puertos_funcionando ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $soporte->teclado_puertos_funcionando ? 'Sí' : 'No' }}
                                    </span>
                                </span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 rounded-full mr-3 {{ $soporte->sistema_operativo_inicia ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                <span class="text-sm text-gray-900">
                                    ¿Sistema operativo inicia correctamente?
                                    <span class="ml-2 font-semibold {{ $soporte->sistema_operativo_inicia ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $soporte->sistema_operativo_inicia ? 'Sí' : 'No' }}
                                    </span>
                                </span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 rounded-full mr-3 {{ $soporte->software_malicioso_lentitud ? 'bg-red-500' : 'bg-green-500' }}"></div>
                                <span class="text-sm text-gray-900">
                                    ¿Hay software malicioso o lentitud?
                                    <span class="ml-2 font-semibold {{ $soporte->software_malicioso_lentitud ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $soporte->software_malicioso_lentitud ? 'Sí' : 'No' }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Observaciones adicionales -->
                    @if($soporte->observaciones_adicionales || $soporte->recomendaciones_inmediatas)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                            5. Observaciones adicionales
                        </h3>

                        @if($soporte->observaciones_adicionales)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Notas adicionales</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $soporte->observaciones_adicionales }}</p>
                        </div>
                        @endif

                        @if($soporte->recomendaciones_inmediatas)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Recomendaciones inmediatas</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $soporte->recomendaciones_inmediatas }}</p>
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- 6. Diagnóstico y Seguimiento Técnico -->
                    @if($soporte->diagnostico_tecnico)
                    <div class="mb-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                            6. Diagnóstico y Seguimiento Técnico
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Técnico Asignado</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $soporte->tecnico->name ?? 'No asignado' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Costo Estimado</label>
                                <p class="mt-1 text-sm text-gray-900">${{ number_format($soporte->costo_estimado, 2) ?? 'No especificado' }}</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Diagnóstico del Técnico</label>
                            <p class="mt-1 text-sm text-gray-900 bg-gray-50 p-3 rounded-md">{{ $soporte->diagnostico_tecnico }}</p>
                        </div>
                        
                        @if($soporte->evidencia_tecnico && count($soporte->evidencia_tecnico) > 0)
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Evidencia del técnico</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
                                @foreach($soporte->evidencia_tecnico as $foto)
                                <div class="relative">
                                    <img src="{{ Storage::url($foto) }}" alt="Evidencia del técnico"
                                        class="w-full h-32 object-cover rounded-lg cursor-pointer"
                                        onclick="openImageModal('{{ Storage::url($foto) }}')">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Footer con info y botón de diagnóstico -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tique Creado por</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $soporte->user->name ?? 'N/A' }}</p>
                            </div>
                            @role('Admin|Tecnico')
                                <a href="{{ route('tecnico.soportes.diagnostico', $soporte) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    {{ __('Gestionar Diagnóstico') }}
                                </a>
                            @endrole
                            <div class="text-right">
                                <label class="block text-sm font-medium text-gray-700">Última actualización</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $soporte->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para ver imágenes -->
    <div id="imageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <img id="modalImage" src="" alt="Imagen ampliada" class="w-full h-auto rounded">
                <div class="mt-4">
                    <button onclick="closeImageModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        // Cerrar modal al hacer clic fuera de la imagen
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });
    </script>
</x-app-layout>