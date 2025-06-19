<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Soporte;
use App\Models\User;

class SoporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener el primer usuario disponible
        $user = User::first();
        
        if (!$user) {
            $this->command->error('No hay usuarios en la base de datos. Cree un usuario primero.');
            return;
        }

        // Crear algunos soportes de prueba
        Soporte::create([
            'nombre_completo' => 'Juan Pérez',
            'numero_identificacion' => '12345678',
            'telefono_whatsapp' => '3001234567',
            'correo_electronico' => 'juan.perez@email.com',
            'tipo_equipo' => 'laptop',
            'marca_modelo' => 'HP Pavilion 15',
            'serial_imei' => 'HP123456789',
            'accesorios_entregados' => 'Cargador, mouse inalámbrico',
            'condicion_fisica' => 'Ligero rayón en la tapa',
            'estado_encendido' => 'enciende',
            'descripcion_problema' => 'La laptop se apaga inesperadamente después de 30 minutos de uso',
            'tipo_servicio' => 'mantenimiento_correctivo',
            'equipo_arranca' => true,
            'pantalla_fallos' => false,
            'teclado_puertos_funcionando' => true,
            'sistema_operativo_inicia' => true,
            'software_malicioso_lentitud' => false,
            'observaciones_adicionales' => 'Cliente menciona que el problema comenzó hace una semana',
            'recomendaciones_inmediatas' => 'Verificar temperatura del procesador y limpiar ventiladores',
            'estado' => 'pendiente',
            'user_id' => $user->id,
        ]);

        Soporte::create([
            'nombre_completo' => 'María García',
            'numero_identificacion' => '87654321',
            'telefono_whatsapp' => '3007654321',
            'correo_electronico' => 'maria.garcia@email.com',
            'tipo_equipo' => 'pc',
            'marca_modelo' => 'Dell OptiPlex 7090',
            'serial_imei' => 'DELL987654321',
            'accesorios_entregados' => 'Monitor, teclado, mouse',
            'condicion_fisica' => 'En buen estado',
            'estado_encendido' => 'no_enciende',
            'descripcion_problema' => 'La computadora no enciende, no hay señal de vida',
            'tipo_servicio' => 'diagnostico',
            'equipo_arranca' => false,
            'pantalla_fallos' => false,
            'teclado_puertos_funcionando' => false,
            'sistema_operativo_inicia' => false,
            'software_malicioso_lentitud' => false,
            'observaciones_adicionales' => 'Cliente dice que hubo un apagón y desde entonces no funciona',
            'recomendaciones_inmediatas' => 'Verificar fuente de poder y placa base',
            'estado' => 'en_proceso',
            'user_id' => $user->id,
        ]);

        Soporte::create([
            'nombre_completo' => 'Carlos Rodríguez',
            'numero_identificacion' => '11223344',
            'telefono_whatsapp' => '3001122334',
            'correo_electronico' => 'carlos.rodriguez@email.com',
            'tipo_equipo' => 'celular',
            'marca_modelo' => 'Samsung Galaxy S21',
            'serial_imei' => 'SAMSUNG123456789',
            'accesorios_entregados' => 'Cargador, funda protectora',
            'condicion_fisica' => 'Pantalla rota, esquina superior derecha',
            'estado_encendido' => 'enciende',
            'descripcion_problema' => 'Pantalla rota después de una caída, necesita reemplazo',
            'tipo_servicio' => 'mantenimiento_correctivo',
            'equipo_arranca' => true,
            'pantalla_fallos' => true,
            'teclado_puertos_funcionando' => true,
            'sistema_operativo_inicia' => true,
            'software_malicioso_lentitud' => false,
            'observaciones_adicionales' => 'El teléfono funciona perfectamente, solo necesita cambio de pantalla',
            'recomendaciones_inmediatas' => 'Cotizar repuesto original Samsung',
            'estado' => 'completado',
            'user_id' => $user->id,
        ]);

        $this->command->info('Soportes de prueba creados exitosamente.');
    }
}
