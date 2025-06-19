# Sistema de Recepción de Dispositivos - Soporte Técnico

## Descripción
Sistema completo para la gestión de recepción de dispositivos en un taller de soporte técnico. Permite registrar, gestionar y dar seguimiento a todos los equipos que ingresan para mantenimiento o reparación.

## Características Principales

### 📋 Formulario de Recepción Completo
- **Datos del Cliente**: Nombre, identificación, teléfono, correo
- **Datos del Dispositivo**: Tipo, marca, modelo, serial, accesorios, condición física
- **Motivo de Entrega**: Descripción del problema y tipo de servicio
- **Checklist Técnico**: Evaluación inicial del equipo
- **Observaciones**: Notas adicionales y recomendaciones
- **Subida de Fotos**: Galería de imágenes del estado actual

### 🎯 Tipos de Servicio Soportados
- Mantenimiento Preventivo
- Mantenimiento Correctivo
- Instalación de Software
- Diagnóstico
- Otros

### 📱 Tipos de Equipos
- Laptop
- PC de Escritorio
- Impresora
- Celular
- Tablet
- Servidor
- Otros

### 📊 Estados de Seguimiento
- Pendiente
- En Proceso
- Completado
- Cancelado

## Instalación y Configuración

### 1. Requisitos Previos
- PHP 8.1 o superior
- Composer
- MySQL/MariaDB
- Laravel 10+

### 2. Instalación
```bash
# Clonar el proyecto
git clone [url-del-repositorio]

# Instalar dependencias
composer install

# Configurar variables de entorno
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate

# Configurar base de datos en .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=soporte
DB_USERNAME=root
DB_PASSWORD=

# Ejecutar migraciones
php artisan migrate

# Crear enlace simbólico para storage
php artisan storage:link

# Ejecutar seeders (opcional - datos de prueba)
php artisan db:seed --class=SoporteSeeder
```

### 3. Configuración de Permisos
El sistema utiliza Spatie Laravel Permission. Asegúrate de que los usuarios tengan los permisos necesarios:
- `soporte` - Para acceder al módulo de soportes
- `soportes.index` - Para ver la lista
- `soportes.create` - Para crear nuevos soportes
- `soportes.edit` - Para editar soportes
- `soportes.destroy` - Para eliminar soportes

## Uso del Sistema

### 1. Crear Nuevo Soporte
1. Navegar a **Soportes** en el menú principal
2. Hacer clic en **"Nuevo Soporte"**
3. Completar todos los campos requeridos:
   - **Datos del Cliente**: Información de contacto completa
   - **Datos del Dispositivo**: Especificaciones técnicas
   - **Motivo**: Descripción detallada del problema
   - **Checklist**: Evaluación técnica inicial
   - **Fotos**: Subir imágenes del estado actual
4. Hacer clic en **"Crear Soporte"**

### 2. Gestionar Soportes Existentes
- **Ver Lista**: Todos los soportes con filtros por estado
- **Ver Detalle**: Información completa del soporte
- **Editar**: Modificar información y actualizar estado
- **Eliminar**: Remover soportes (con confirmación)

### 3. Seguimiento de Estados
- **Pendiente**: Recién recibido, pendiente de revisión
- **En Proceso**: En reparación/mantenimiento
- **Completado**: Trabajo terminado, listo para entrega
- **Cancelado**: Trabajo cancelado por el cliente

## Estructura de Archivos

```
app/
├── Http/Controllers/
│   └── SoporteController.php    # Controlador principal
├── Models/
│   └── Soporte.php              # Modelo con relaciones y métodos
└── View/Components/
    └── ...                      # Componentes de vista

database/
├── migrations/
│   └── create_soportes_table.php # Estructura de la base de datos
└── seeders/
    └── SoporteSeeder.php        # Datos de prueba

resources/views/
├── soportes/
│   ├── index.blade.php          # Lista de soportes
│   ├── create.blade.php         # Formulario de creación
│   ├── edit.blade.php           # Formulario de edición
│   └── show.blade.php           # Vista de detalle
└── menu/
    └── soporte.blade.php        # Menú principal

routes/
└── web.php                      # Rutas del sistema
```

## Base de Datos

### Tabla: soportes
- `id` - Identificador único
- `nombre_completo` - Nombre del cliente
- `numero_identificacion` - ID del cliente (opcional)
- `telefono_whatsapp` - Teléfono de contacto
- `correo_electronico` - Email del cliente
- `tipo_equipo` - Tipo de dispositivo
- `marca_modelo` - Marca y modelo
- `serial_imei` - Número de serie (opcional)
- `accesorios_entregados` - Accesorios incluidos
- `condicion_fisica` - Estado físico del equipo
- `estado_encendido` - Si enciende o no
- `fotos_estado` - Array de rutas de fotos
- `descripcion_problema` - Problema reportado
- `tipo_servicio` - Tipo de servicio solicitado
- `equipo_arranca` - Checklist técnico
- `pantalla_fallos` - Checklist técnico
- `teclado_puertos_funcionando` - Checklist técnico
- `sistema_operativo_inicia` - Checklist técnico
- `software_malicioso_lentitud` - Checklist técnico
- `observaciones_adicionales` - Notas adicionales
- `recomendaciones_inmediatas` - Recomendaciones
- `estado` - Estado del soporte
- `user_id` - Técnico responsable
- `created_at` - Fecha de creación
- `updated_at` - Fecha de última actualización

## Características Técnicas

### Validaciones
- Campos requeridos validados en el servidor
- Validación de tipos de archivo para imágenes
- Validación de formatos de email y teléfono

### Seguridad
- Autenticación requerida para todas las operaciones
- Validación de permisos por rol
- Sanitización de datos de entrada
- Protección CSRF en formularios

### Almacenamiento de Archivos
- Imágenes almacenadas en `storage/app/public/soportes/fotos/`
- Enlace simbólico configurado para acceso público
- Soporte para múltiples imágenes por soporte

### Interfaz de Usuario
- Diseño responsive con Tailwind CSS
- Componentes reutilizables de Laravel Jetstream
- Modal para visualización de imágenes
- Indicadores visuales de estado

## Mantenimiento

### Backup de Datos
```bash
# Exportar base de datos
mysqldump -u root -p soporte > backup_soporte.sql

# Backup de imágenes
tar -czf fotos_soporte.tar.gz storage/app/public/soportes/
```

### Logs
- Los logs se almacenan en `storage/logs/laravel.log`
- Errores de validación y excepciones son registrados

### Actualizaciones
```bash
# Actualizar dependencias
composer update

# Ejecutar nuevas migraciones
php artisan migrate

# Limpiar caché si es necesario
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Soporte y Contacto

Para soporte técnico o consultas sobre el sistema:
- Revisar los logs en `storage/logs/`
- Verificar permisos de usuario
- Comprobar configuración de base de datos
- Validar enlace simbólico de storage

## Licencia

Este proyecto está bajo la licencia MIT. Ver archivo LICENSE para más detalles. 