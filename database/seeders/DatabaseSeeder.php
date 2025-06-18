<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Eliud',
            'email' => 'eliudarias945@gmail.com',
            'password' => Hash::make('123456789'),
        ]);

       

        // Sincronizar permisos de vistas antes de asignar al rol
        Artisan::call('permissions:sync-views');

        // Crear el rol Administrador si no existe
        $adminRole = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);

        // Obtener todos los permisos y asignarlos al rol
        $allPermissions = Permission::pluck('name')->toArray();
        $adminRole->syncPermissions($allPermissions);

        // Asignar el rol al usuario Eliud
        $user = User::where('email', 'eliudarias945@gmail.com')->first();
        if ($user) {
            $user->assignRole('Administrador');
        }
    }
}
