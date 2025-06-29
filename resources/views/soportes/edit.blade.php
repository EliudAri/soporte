<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Soporte') }}
        </h2>
        <div class="flex space-x-2">
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
                    <form action="{{ route('soportes.update', $soporte) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- 1. Datos del Cliente -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                                1. Datos del Cliente
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-label value="Nombre completo" />
                                    <x-input type="text" value="{{ $soporte->cliente->nombres ?? '' }}" readonly class="mt-1 block w-full" />
                                </div>
                                <div>
                                    <x-label value="Apellidos" />
                                    <x-input type="text" value="{{ $soporte->cliente->apellidos ?? '' }}" readonly class="mt-1 block w-full" />
                                </div>
                                <div>
                                    <x-label value="Número de identificación" />
                                    <x-input type="text" value="{{ $soporte->cliente->numero_identificacion ?? '' }}" readonly class="mt-1 block w-full" />
                                </div>
                                <div>
                                    <x-label value="Teléfono / WhatsApp" />
                                    <x-input type="text" value="{{ $soporte->cliente->telefono ?? '' }}" readonly class="mt-1 block w-full" />
                                </div>
                                <div>
                                    <x-label value="Correo electrónico" />
                                    <x-input type="text" value="{{ $soporte->cliente->correo ?? '' }}" readonly class="mt-1 block w-full" />
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
                                    <x-label for="tipo_equipo" value="Tipo de equipo *" />
                                    <select id="tipo_equipo" name="tipo_equipo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                        <option value="">Seleccione un tipo</option>
                                        @foreach($tiposEquipo as $key => $value)
                                            <option value="{{ $key }}" {{ old('tipo_equipo', $soporte->tipo_equipo) == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="tipo_equipo" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-label for="marca_modelo" value="Marca y modelo *" />
                                    <x-input id="marca_modelo" type="text" name="marca_modelo" 
                                             class="mt-1 block w-full" value="{{ old('marca_modelo', $soporte->marca_modelo) }}" required />
                                    <x-input-error for="marca_modelo" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-label for="serial_imei" value="Serial o IMEI" />
                                    <x-input id="serial_imei" type="text" name="serial_imei" 
                                             class="mt-1 block w-full" value="{{ old('serial_imei', $soporte->serial_imei) }}" />
                                    <x-input-error for="serial_imei" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-label for="estado_encendido" value="Estado de encendido *" />
                                    <select id="estado_encendido" name="estado_encendido" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                        <option value="">Seleccione estado</option>
                                        <option value="enciende" {{ old('estado_encendido', $soporte->estado_encendido) == 'enciende' ? 'selected' : '' }}>Enciende</option>
                                        <option value="no_enciende" {{ old('estado_encendido', $soporte->estado_encendido) == 'no_enciende' ? 'selected' : '' }}>No enciende</option>
                                    </select>
                                    <x-input-error for="estado_encendido" class="mt-2" />
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <x-label for="accesorios_entregados" value="Accesorios entregados (cargador, mouse, funda, etc.)" />
                                <textarea id="accesorios_entregados" name="accesorios_entregados" rows="3" 
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('accesorios_entregados', $soporte->accesorios_entregados) }}</textarea>
                                <x-input-error for="accesorios_entregados" class="mt-2" />
                            </div>
                            
                            <div class="mt-4">
                                <x-label for="condicion_fisica" value="Condición física actual (rayones, pantalla rota, etc.)" />
                                <textarea id="condicion_fisica" name="condicion_fisica" rows="3" 
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('condicion_fisica', $soporte->condicion_fisica) }}</textarea>
                                <x-input-error for="condicion_fisica" class="mt-2" />
                            </div>
                            
                            <!-- Mostrar fotos existentes -->
                            @if($soporte->fotos_estado && count($soporte->fotos_estado) > 0)
                                <div class="mt-4">
                                    <x-label value="Fotos actuales" />
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
                                        @foreach($soporte->fotos_estado as $foto)
                                            <div class="relative">
                                                <img src="{{ Storage::url($foto) }}" alt="Foto del dispositivo" 
                                                     class="w-full h-32 object-cover rounded-lg">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            <div class="mt-4">
                                <x-label for="fotos_estado" value="Agregar nuevas fotos" />
                                <input id="fotos_estado" type="file" name="fotos_estado[]" multiple 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                       accept="image/*" />
                                <p class="mt-1 text-sm text-gray-500">Puede seleccionar múltiples imágenes</p>
                                <x-input-error for="fotos_estado" class="mt-2" />
                            </div>
                        </div>

                        <!-- 3. Motivo de la entrega -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                                3. Motivo de la entrega
                            </h3>
                            
                            <div class="mb-4">
                                <x-label for="descripcion_problema" value="Descripción del problema que reporta el cliente *" />
                                <textarea id="descripcion_problema" name="descripcion_problema" rows="4" 
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('descripcion_problema', $soporte->descripcion_problema) }}</textarea>
                                <x-input-error for="descripcion_problema" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-label for="tipo_servicio" value="Tipo de servicio solicitado *" />
                                <select id="tipo_servicio" name="tipo_servicio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                    <option value="">Seleccione un servicio</option>
                                    @foreach($tiposServicio as $key => $value)
                                        <option value="{{ $key }}" {{ old('tipo_servicio', $soporte->tipo_servicio) == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error for="tipo_servicio" class="mt-2" />
                            </div>
                        </div>

                        <!-- 4. Checklist Técnico -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                                4. Checklist Técnico
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center">
                                    <input id="equipo_arranca" type="checkbox" name="equipo_arranca" value="1" 
                                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" 
                                           {{ old('equipo_arranca', $soporte->equipo_arranca) ? 'checked' : '' }}>
                                    <label for="equipo_arranca" class="ml-2 block text-sm text-gray-900">
                                        ¿Equipo arranca?
                                    </label>
                                </div>
                                
                                <div class="flex items-center">
                                    <input id="pantalla_fallos" type="checkbox" name="pantalla_fallos" value="1" 
                                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" 
                                           {{ old('pantalla_fallos', $soporte->pantalla_fallos) ? 'checked' : '' }}>
                                    <label for="pantalla_fallos" class="ml-2 block text-sm text-gray-900">
                                        ¿Pantalla presenta fallos?
                                    </label>
                                </div>
                                
                                <div class="flex items-center">
                                    <input id="teclado_puertos_funcionando" type="checkbox" name="teclado_puertos_funcionando" value="1" 
                                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" 
                                           {{ old('teclado_puertos_funcionando', $soporte->teclado_puertos_funcionando) ? 'checked' : '' }}>
                                    <label for="teclado_puertos_funcionando" class="ml-2 block text-sm text-gray-900">
                                        ¿Teclado / Puertos funcionando?
                                    </label>
                                </div>
                                
                                <div class="flex items-center">
                                    <input id="sistema_operativo_inicia" type="checkbox" name="sistema_operativo_inicia" value="1" 
                                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" 
                                           {{ old('sistema_operativo_inicia', $soporte->sistema_operativo_inicia) ? 'checked' : '' }}>
                                    <label for="sistema_operativo_inicia" class="ml-2 block text-sm text-gray-900">
                                        ¿Sistema operativo inicia correctamente?
                                    </label>
                                </div>
                                
                                <div class="flex items-center">
                                    <input id="software_malicioso_lentitud" type="checkbox" name="software_malicioso_lentitud" value="1" 
                                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" 
                                           {{ old('software_malicioso_lentitud', $soporte->software_malicioso_lentitud) ? 'checked' : '' }}>
                                    <label for="software_malicioso_lentitud" class="ml-2 block text-sm text-gray-900">
                                        ¿Hay software malicioso o lentitud?
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Observaciones adicionales -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                                5. Observaciones adicionales
                            </h3>
                            
                            <div class="mb-4">
                                <x-label for="observaciones_adicionales" value="Notas adicionales del cliente o técnico" />
                                <textarea id="observaciones_adicionales" name="observaciones_adicionales" rows="3" 
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('observaciones_adicionales', $soporte->observaciones_adicionales) }}</textarea>
                                <x-input-error for="observaciones_adicionales" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-label for="recomendaciones_inmediatas" value="Recomendaciones inmediatas" />
                                <textarea id="recomendaciones_inmediatas" name="recomendaciones_inmediatas" rows="3" 
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('recomendaciones_inmediatas', $soporte->recomendaciones_inmediatas) }}</textarea>
                                <x-input-error for="recomendaciones_inmediatas" class="mt-2" />
                            </div>
                        </div>

                        <!-- Estado del soporte -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                                Estado del Soporte
                            </h3>
                            
                            <div>
                                <x-label for="estado" value="Estado *" />
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

                        <!-- Botones de acción -->
                        <div class="flex items-center justify-end mt-6">
                            <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                                {{ __('Cancelar') }}
                            </x-secondary-button>
                            <x-button>
                                {{ __('Actualizar Soporte') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 