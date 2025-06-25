<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-2 sm:space-y-0">
            <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
                {{ __('Usuarios') }}
            </h2>
            @can('usuarios.create')
            <a href="{{ route('usuarios.create') }}" class="inline-block px-4 py-2 rounded-lg bg-indigo-600 text-white font-semibold shadow hover:bg-indigo-700 transition text-sm sm:text-base">Crear Usuario</a>
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
                                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th class="hidden sm:table-cell px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="hidden md:table-cell px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email Verificado</th>
                                    <th class="hidden lg:table-cell px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                                    <th class="hidden xl:table-cell px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creado</th>
                                    <th class="hidden xl:table-cell px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actualizado</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                                    <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($usuarios as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-3 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-700">{{ $user->id }}</td>
                                    <td class="px-3 py-4 whitespace-nowrap text-xs sm:text-sm font-semibold text-gray-900">{{ $user->name }}</td>
                                    <td class="hidden sm:table-cell px-3 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-700">{{ $user->email }}</td>
                                    <td class="hidden md:table-cell px-3 py-4 whitespace-nowrap text-xs sm:text-sm">
                                        @if($user->email_verified_at)
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">Verificado</span>
                                        @else
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-800">No verificado</span>
                                        @endif
                                    </td>
                                    <td class="hidden lg:table-cell px-3 py-4 whitespace-nowrap">
                                        <img src="{{ $user->profile_photo_url }}" alt="Foto de perfil" class="h-8 w-8 sm:h-10 sm:w-10 rounded-full shadow border border-gray-200 object-cover">
                                    </td>
                                    <td class="hidden xl:table-cell px-3 py-4 whitespace-nowrap text-xs text-gray-500">{{ date('d/m/Y H:i', strtotime($user->created_at)) }}</td>
                                    <td class="hidden xl:table-cell px-3 py-4 whitespace-nowrap text-xs text-gray-500">{{ date('d/m/Y H:i', strtotime($user->updated_at)) }}</td>
                                    <td class="px-3 py-4 whitespace-nowrap text-xs sm:text-sm">
                                        @if($user->roles->count())
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-indigo-100 text-indigo-800">
                                            {{ $user->roles->pluck('name')->join(', ') }}
                                        </span>
                                        @else
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-500">Sin rol</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap text-center">
                                        @can('usuarios.edit')
                                        <a href="{{ route('usuarios.edit', $user) }}" class="inline-block px-3 py-1.5 rounded bg-yellow-400 text-white font-semibold hover:bg-yellow-500 transition text-xs sm:text-sm">Editar</a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>