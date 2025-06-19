<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('soportes', function (Blueprint $table) {
            $table->id();
            
            // Datos del Cliente
            $table->string('nombre_completo');
            $table->string('numero_identificacion')->nullable();
            $table->string('telefono_whatsapp');
            $table->string('correo_electronico');
            
            // Datos del Dispositivo
            $table->string('tipo_equipo'); // Laptop, PC, Impresora, Celular, etc.
            $table->string('marca_modelo');
            $table->string('serial_imei')->nullable();
            $table->text('accesorios_entregados')->nullable(); // cargador, mouse, funda, etc.
            $table->text('condicion_fisica')->nullable(); // rayones, pantalla rota, etc.
            $table->enum('estado_encendido', ['enciende', 'no_enciende']);
            $table->json('fotos_estado')->nullable(); // galería de fotos
            
            // Motivo de la entrega
            $table->text('descripcion_problema');
            $table->enum('tipo_servicio', [
                'mantenimiento_preventivo',
                'mantenimiento_correctivo', 
                'instalacion_software',
                'diagnostico',
                'otros'
            ]);
            
            // Checklist Técnico
            $table->boolean('equipo_arranca')->default(false);
            $table->boolean('pantalla_fallos')->default(false);
            $table->boolean('teclado_puertos_funcionando')->default(false);
            $table->boolean('sistema_operativo_inicia')->default(false);
            $table->boolean('software_malicioso_lentitud')->default(false);
            
            // Observaciones adicionales
            $table->text('observaciones_adicionales')->nullable();
            $table->text('recomendaciones_inmediatas')->nullable();
            
            // Estado del soporte
            $table->enum('estado', ['pendiente', 'en_proceso', 'completado', 'cancelado'])->default('pendiente');
            
            // Usuario que creó el soporte
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soportes');
    }
};
