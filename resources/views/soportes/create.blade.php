<x-app-layout>
    <x-slot name="header">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-2 sm:space-y-0">
        <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
            {{ __('Recepción de Dispositivo') }}
        </h2>
        <div class="flex space-x-2">
            <a href="{{ route('soportes.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm sm:text-base">
                {{ __('Volver') }}
            </a>
        </div>
    </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-4 sm:p-6">
                    <form action="{{ route('soportes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- 1. Datos del Cliente -->
                        <div class="mb-6 sm:mb-8">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-3 sm:mb-4 border-b pb-2">
                                1. Datos del Cliente
                            </h3>
                            <input type="hidden" id="cliente_id" name="cliente_id" value="">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="sm:col-span-2">
                                    <x-label for="numero_identificacion" value="Número de identificación *" />
                                    <div class="relative">
                                        <x-input id="numero_identificacion" type="tel" name="numero_identificacion"
                                            class="mt-1 block w-full" value="{{ old('numero_identificacion') }}" required autocomplete="off" />
                                        <div id="results" class="absolute z-10 w-full bg-white rounded-md shadow-lg mt-1 hidden"></div>
                                    </div>
                                    <x-input-error for="numero_identificacion" class="mt-2" />
                                </div>
                                <div>
                                    <x-label for="nombres" value="Nombres *" />
                                    <x-input id="nombres" type="text" name="nombres"
                                        class="mt-1 block w-full" value="{{ old('nombres') }}" required />
                                    <x-input-error for="nombres" class="mt-2" />
                                </div>
                                <div>
                                    <x-label for="apellidos" value="Apellidos *" />
                                    <x-input id="apellidos" type="text" name="apellidos"
                                        class="mt-1 block w-full" value="{{ old('apellidos') }}" required />
                                    <x-input-error for="apellidos" class="mt-2" />
                                </div>
                                <div>
                                    <x-label for="telefono" value="Teléfono / WhatsApp *" />
                                    <x-input id="telefono" type="tel" name="telefono"
                                        class="mt-1 block w-full" value="{{ old('telefono') }}" required />
                                    <x-input-error for="telefono" class="mt-2" />
                                </div>
                                <div>
                                    <x-label for="correo" value="Correo electrónico *" />
                                    <x-input id="correo" type="email" name="correo"
                                        class="mt-1 block w-full" value="{{ old('correo') }}" required />
                                    <x-input-error for="correo" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- 2. Datos del Dispositivo -->
                        <div class="mb-6 sm:mb-8">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-3 sm:mb-4 border-b pb-2">
                                2. Datos del Dispositivo
                            </h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <x-label for="tipo_equipo" value="Tipo de equipo *" />
                                    <select id="tipo_equipo" name="tipo_equipo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                        <option value="">Seleccione un tipo</option>
                                        @foreach($tiposEquipo as $key => $value)
                                        <option value="{{ $key }}" {{ old('tipo_equipo') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="tipo_equipo" class="mt-2" />
                                </div>

                                <div>
                                    <x-label for="marca_modelo" value="Marca y modelo *" />
                                    <x-input id="marca_modelo" type="text" name="marca_modelo"
                                        class="mt-1 block w-full" value="{{ old('marca_modelo') }}" required />
                                    <x-input-error for="marca_modelo" class="mt-2" />
                                </div>

                                <div>
                                    <x-label for="serial_imei" value="Serial o IMEI" />
                                    <x-input id="serial_imei" type="text" name="serial_imei"
                                        class="mt-1 block w-full" value="{{ old('serial_imei') }}" />
                                    <x-input-error for="serial_imei" class="mt-2" />
                                </div>

                                <div>
                                    <x-label for="estado_encendido" value="Estado de encendido *" />
                                    <select id="estado_encendido" name="estado_encendido" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                        <option value="">Seleccione estado</option>
                                        <option value="enciende" {{ old('estado_encendido') == 'enciende' ? 'selected' : '' }}>Enciende</option>
                                        <option value="no_enciende" {{ old('estado_encendido') == 'no_enciende' ? 'selected' : '' }}>No enciende</option>
                                    </select>
                                    <x-input-error for="estado_encendido" class="mt-2" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <x-label for="accesorios_entregados" value="Accesorios entregados (cargador, mouse, funda, etc.)" />
                                <textarea id="accesorios_entregados" name="accesorios_entregados" rows="3"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('accesorios_entregados') }}</textarea>
                                <x-input-error for="accesorios_entregados" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-label for="condicion_fisica" value="Condición física actual (rayones, pantalla rota, etc.)" />
                                <textarea id="condicion_fisica" name="condicion_fisica" rows="3"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('condicion_fisica') }}</textarea>
                                <x-input-error for="condicion_fisica" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-label for="fotos_estado" value="Fotos del estado actual" />
                                <input id="fotos_estado" type="file" name="fotos_estado[]" multiple
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    accept="image/*" />
                                <p class="mt-1 text-xs sm:text-sm text-gray-500">Puede seleccionar múltiples imágenes</p>
                                <x-input-error for="fotos_estado" class="mt-2" />
                            </div>
                        </div>

                        <!-- 3. Motivo de la entrega -->
                        <div class="mb-6 sm:mb-8">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-3 sm:mb-4 border-b pb-2">
                                3. Motivo de la entrega
                            </h3>

                            <div class="mb-4">
                                <x-label for="descripcion_problema" value="Descripción del problema que reporta el cliente *" />
                                <textarea id="descripcion_problema" name="descripcion_problema" rows="4"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('descripcion_problema') }}</textarea>
                                <x-input-error for="descripcion_problema" class="mt-2" />
                            </div>

                            <div>
                                <x-label for="tipo_servicio" value="Tipo de servicio solicitado *" />
                                <select id="tipo_servicio" name="tipo_servicio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                    <option value="">Seleccione un servicio</option>
                                    @foreach($tiposServicio as $key => $value)
                                    <option value="{{ $key }}" {{ old('tipo_servicio') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-input-error for="tipo_servicio" class="mt-2" />
                            </div>
                        </div>

                        <!-- 4. Checklist Técnico -->
                        <div class="mb-6 sm:mb-8">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-3 sm:mb-4 border-b pb-2">
                                4. Checklist Técnico
                            </h3>
                            <p class="mb-2 text-xs sm:text-sm text-gray-500">Marca la casilla si la respuesta es <span class="font-semibold">SÍ</span>. Si no marcas, se asume que <span class="font-semibold">NO</span> está funcionando correctamente o presenta el problema.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="flex items-center">
                                    <input id="equipo_arranca" type="checkbox" name="equipo_arranca" value="1"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                        {{ old('equipo_arranca') ? 'checked' : '' }}>
                                    <label for="equipo_arranca" class="ml-2 block text-sm text-gray-900">
                                        ¿Equipo arranca?
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input id="pantalla_fallos" type="checkbox" name="pantalla_fallos" value="1"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                        {{ old('pantalla_fallos') ? 'checked' : '' }}>
                                    <label for="pantalla_fallos" class="ml-2 block text-sm text-gray-900">
                                        ¿Pantalla presenta fallos?
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input id="teclado_puertos_funcionando" type="checkbox" name="teclado_puertos_funcionando" value="1"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                        {{ old('teclado_puertos_funcionando') ? 'checked' : '' }}>
                                    <label for="teclado_puertos_funcionando" class="ml-2 block text-sm text-gray-900">
                                        ¿Teclado / Puertos funcionando?
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input id="sistema_operativo_inicia" type="checkbox" name="sistema_operativo_inicia" value="1"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                        {{ old('sistema_operativo_inicia') ? 'checked' : '' }}>
                                    <label for="sistema_operativo_inicia" class="ml-2 block text-sm text-gray-900">
                                        ¿Sistema operativo inicia correctamente?
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input id="internet_wifi_funcionando" type="checkbox" name="internet_wifi_funcionando" value="1"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                        {{ old('internet_wifi_funcionando') ? 'checked' : '' }}>
                                    <label for="internet_wifi_funcionando" class="ml-2 block text-sm text-gray-900">
                                        ¿Internet/WiFi funcionando?
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input id="programas_aplicaciones_instaladas" type="checkbox" name="programas_aplicaciones_instaladas" value="1"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                        {{ old('programas_aplicaciones_instaladas') ? 'checked' : '' }}>
                                    <label for="programas_aplicaciones_instaladas" class="ml-2 block text-sm text-gray-900">
                                        ¿Programas/aplicaciones instaladas?
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input id="virus_malware_detectado" type="checkbox" name="virus_malware_detectado" value="1"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                        {{ old('virus_malware_detectado') ? 'checked' : '' }}>
                                    <label for="virus_malware_detectado" class="ml-2 block text-sm text-gray-900">
                                        ¿Virus/malware detectado?
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input id="disco_duro_ruidos" type="checkbox" name="disco_duro_ruidos" value="1"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                        {{ old('disco_duro_ruidos') ? 'checked' : '' }}>
                                    <label for="disco_duro_ruidos" class="ml-2 block text-sm text-gray-900">
                                        ¿Disco duro hace ruidos?
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-end">
                            <a href="{{ route('soportes.index') }}" class="inline-flex justify-center items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs sm:text-sm text-gray-700 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs sm:text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                                Crear Soporte
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('numero_identificacion');
            const resultsContainer = document.getElementById('results');
            const clienteIdInput = document.getElementById('cliente_id');
            const nombresInput = document.getElementById('nombres');
            const apellidosInput = document.getElementById('apellidos');
            const telefonoInput = document.getElementById('telefono');
            const correoInput = document.getElementById('correo');

            let searchTimeout;

            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const query = searchInput.value;

                if (query.length < 2) {
                    resultsContainer.classList.add('hidden');
                    return;
                }

                searchTimeout = setTimeout(() => {
                    fetch(`/clientes/buscar?query=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            resultsContainer.innerHTML = '';
                            resultsContainer.classList.remove('hidden');

                            if (data.length > 0) {
                                data.forEach(cliente => {
                                    const resultItem = document.createElement('div');
                                    resultItem.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                                    resultItem.textContent = `${cliente.nombres} ${cliente.apellidos} (${cliente.numero_identificacion})`;
                                    resultItem.addEventListener('click', function() {
                                        clienteIdInput.value = cliente.id;
                                        nombresInput.value = cliente.nombres;
                                        apellidosInput.value = cliente.apellidos;
                                        searchInput.value = cliente.numero_identificacion;
                                        telefonoInput.value = cliente.telefono;
                                        correoInput.value = cliente.correo;
                                        resultsContainer.innerHTML = '';
                                        resultsContainer.classList.add('hidden');
                                    });
                                    resultsContainer.appendChild(resultItem);
                                });
                            } else {
                                resultsContainer.innerHTML = '<div class="p-2 text-gray-500">No se encontraron clientes.</div>';
                            }
                        })
                        .catch(error => console.error('Error en fetch:', error));
                }, 300); // Debounce para no saturar con peticiones
            });

            // Ocultar resultados si se hace clic fuera
            document.addEventListener('click', function(e) {
                if (!resultsContainer.contains(e.target) && e.target !== searchInput) {
                    resultsContainer.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>