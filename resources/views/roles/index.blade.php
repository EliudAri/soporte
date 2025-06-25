<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-2 sm:space-y-0">
            <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>
            <a href="{{ route('roles.create') }}" class="inline-block px-4 py-2 rounded-lg bg-blue-500 hover:bg-blue-700 text-white font-semibold shadow transition text-sm sm:text-base">Crear Nuevo Rol</a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                            <th class="hidden sm:table-cell px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permisos</th>
                                            <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($roles as $role)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $role->name }}
                                                </td>
                                                <td class="hidden sm:table-cell px-3 py-4">
                                                    <div class="flex flex-wrap gap-1">
                                                        @foreach($role->permissions as $permission)
                                                            <span class="bg-gray-200 text-gray-800 text-xs font-semibold px-2 py-1 rounded">
                                                                {{ $permission->name }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="px-3 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                    <div class="flex flex-col sm:flex-row gap-2 justify-center">
                                                        <a href="{{ route('roles.edit', $role) }}" class="inline-flex items-center justify-center px-3 py-1.5 rounded bg-blue-100 text-blue-700 font-semibold hover:bg-blue-200 transition text-xs sm:text-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2m-1 0v14m-7-7h14" />
                                                            </svg>
                                                            Editar
                                                        </a>
                                                        <form action="{{ route('roles.destroy', $role) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="inline-flex items-center justify-center px-3 py-1.5 rounded bg-red-100 text-red-700 font-semibold hover:bg-red-200 transition text-xs sm:text-sm" onclick="return confirm('¿Estás seguro de eliminar este rol?')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                                Eliminar
                                                            </button>
                                                        </form>
                                                    </div>
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
        </div>
    </div>
</x-app-layout> 