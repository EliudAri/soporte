<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Soporte extends Model
{
    protected $fillable = [
        'nombre_completo',
        'numero_identificacion',
        'telefono_whatsapp',
        'correo_electronico',
        'tipo_equipo',
        'marca_modelo',
        'serial_imei',
        'accesorios_entregados',
        'condicion_fisica',
        'estado_encendido',
        'fotos_estado',
        'descripcion_problema',
        'tipo_servicio',
        'equipo_arranca',
        'pantalla_fallos',
        'teclado_puertos_funcionando',
        'sistema_operativo_inicia',
        'software_malicioso_lentitud',
        'observaciones_adicionales',
        'recomendaciones_inmediatas',
        'estado',
        'user_id'
    ];

    protected $casts = [
        'fotos_estado' => 'array',
        'equipo_arranca' => 'boolean',
        'pantalla_fallos' => 'boolean',
        'teclado_puertos_funcionando' => 'boolean',
        'sistema_operativo_inicia' => 'boolean',
        'software_malicioso_lentitud' => 'boolean',
    ];

    // Relación con el usuario que creó el soporte
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Métodos de acceso para los tipos de servicio
    public static function getTiposServicio(): array
    {
        return [
            'mantenimiento_preventivo' => 'Mantenimiento Preventivo',
            'mantenimiento_correctivo' => 'Mantenimiento Correctivo',
            'instalacion_software' => 'Instalación de Software',
            'diagnostico' => 'Diagnóstico',
            'otros' => 'Otros'
        ];
    }

    // Métodos de acceso para los estados
    public static function getEstados(): array
    {
        return [
            'pendiente' => 'Pendiente',
            'en_proceso' => 'En Proceso',
            'completado' => 'Completado',
            'cancelado' => 'Cancelado'
        ];
    }

    // Métodos de acceso para los tipos de equipo
    public static function getTiposEquipo(): array
    {
        return [
            'laptop' => 'Laptop',
            'pc' => 'PC de Escritorio',
            'impresora' => 'Impresora',
            'celular' => 'Celular',
            'tablet' => 'Tablet',
            'servidor' => 'Servidor',
            'otros' => 'Otros'
        ];
    }
}
