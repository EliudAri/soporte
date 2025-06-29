<?php

namespace App\Http\Controllers;

use App\Models\Soporte;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SoporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $soportes = Soporte::with(['user', 'cliente'])->latest()->paginate(10);
        return view('soportes.index', compact('soportes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiposEquipo = Soporte::getTiposEquipo();
        $tiposServicio = Soporte::getTiposServicio();
        return view('soportes.create', compact('tiposEquipo', 'tiposServicio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'numero_identificacion' => 'required|numeric',
            'telefono' => 'required|numeric',
            'correo' => 'required|email|max:255',
            'tipo_equipo' => 'required|string|max:255',
            'marca_modelo' => 'required|string|max:255',
            'serial_imei' => 'nullable|string|max:255',
            'accesorios_entregados' => 'nullable|string',
            'condicion_fisica' => 'nullable|string',
            'estado_encendido' => 'required|in:enciende,no_enciende',
            'descripcion_problema' => 'required|string',
            'tipo_servicio' => 'required|in:mantenimiento_preventivo,mantenimiento_correctivo,instalacion_software,diagnostico,otros',
            'equipo_arranca' => 'boolean',
            'pantalla_fallos' => 'boolean',
            'teclado_puertos_funcionando' => 'boolean',
            'sistema_operativo_inicia' => 'boolean',
            'software_malicioso_lentitud' => 'boolean',
            'observaciones_adicionales' => 'nullable|string',
            'recomendaciones_inmediatas' => 'nullable|string',
            'fotos_estado.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Si cliente_id viene, usarlo. Si no, buscar por identificación antes de crear cliente.
        if ($request->filled('cliente_id')) {
            $cliente_id = $request->cliente_id;
        } else {
            // La búsqueda debe ser estricta por número de identificación para evitar falsos positivos.
            $cliente = Cliente::where('numero_identificacion', $request->numero_identificacion)->first();
            
            if ($cliente) {
                // Si se encuentra un cliente, se usa su ID.
                $cliente_id = $cliente->id;
            } else {
                // Si no se encuentra, se crea un nuevo cliente.
                $cliente = Cliente::create([
                    'nombres' => $request->nombres,
                    'apellidos' => $request->apellidos,
                    'numero_identificacion' => $request->numero_identificacion,
                    'telefono' => $request->telefono,
                    'correo' => $request->correo,
                    'direccion' => $request->direccion ?? null,
                ]);
                $cliente_id = $cliente->id;
            }
        }

        $data = $request->except([
            'nombres',
            'apellidos',
            'numero_identificacion',
            'telefono',
            'correo',
            'direccion',
        ]);
        $data['user_id'] = Auth::id();
        $data['cliente_id'] = $cliente_id;
        $data['codigo_seguimiento'] = 'FXV-' . Str::upper(Str::random(8));
        
        // Forzar booleanos a false si no vienen en la request
        foreach ([
            'equipo_arranca',
            'pantalla_fallos',
            'teclado_puertos_funcionando',
            'sistema_operativo_inicia',
            'software_malicioso_lentitud'
        ] as $campo) {
            $data[$campo] = $request->has($campo) ? (bool)$request->input($campo) : false;
        }

        // Procesar fotos si se subieron
        if ($request->hasFile('fotos_estado')) {
            $fotos = [];
            foreach ($request->file('fotos_estado') as $foto) {
                $path = $foto->store('soportes/fotos', 'public');
                $fotos[] = $path;
            }
            $data['fotos_estado'] = $fotos;
        }

        Soporte::create($data);

        return redirect()->route('soportes.index')
            ->with('success', 'Soporte creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $soporte = Soporte::with('user')->findOrFail($id);
        $tiposEquipo = Soporte::getTiposEquipo();
        $tiposServicio = Soporte::getTiposServicio();
        $estados = Soporte::getEstados();
        
        return view('soportes.show', compact('soporte', 'tiposEquipo', 'tiposServicio', 'estados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $soporte = Soporte::findOrFail($id);
        $tiposEquipo = Soporte::getTiposEquipo();
        $tiposServicio = Soporte::getTiposServicio();
        $estados = Soporte::getEstados();
        
        return view('soportes.edit', compact('soporte', 'tiposEquipo', 'tiposServicio', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $soporte = Soporte::findOrFail($id);

        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'numero_identificacion' => 'nullable|numeric',
            'telefono' => 'required|numeric',
            'correo' => 'required|email|max:255',
            'tipo_equipo' => 'required|string|max:255',
            'marca_modelo' => 'required|string|max:255',
            'serial_imei' => 'nullable|string|max:255',
            'accesorios_entregados' => 'nullable|string',
            'condicion_fisica' => 'nullable|string',
            'estado_encendido' => 'required|in:enciende,no_enciende',
            'descripcion_problema' => 'required|string',
            'tipo_servicio' => 'required|in:mantenimiento_preventivo,mantenimiento_correctivo,instalacion_software,diagnostico,otros',
            'equipo_arranca' => 'boolean',
            'pantalla_fallos' => 'boolean',
            'teclado_puertos_funcionando' => 'boolean',
            'sistema_operativo_inicia' => 'boolean',
            'software_malicioso_lentitud' => 'boolean',
            'observaciones_adicionales' => 'nullable|string',
            'recomendaciones_inmediatas' => 'nullable|string',
            'estado' => 'required|in:pendiente,en_proceso,completado,cancelado',
            'fotos_estado.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        // Forzar booleanos a false si no vienen en la request
        foreach ([
            'equipo_arranca',
            'pantalla_fallos',
            'teclado_puertos_funcionando',
            'sistema_operativo_inicia',
            'software_malicioso_lentitud'
        ] as $campo) {
            $data[$campo] = $request->has($campo) ? (bool)$request->input($campo) : false;
        }

        // Actualizar datos del cliente asociado
        if($soporte->cliente) {
            $soporte->cliente->update([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'numero_identificacion' => $request->numero_identificacion,
                'telefono' => $request->telefono,
                'correo' => $request->correo,
            ]);
        }

        // Procesar nuevas fotos si se subieron
        if ($request->hasFile('fotos_estado')) {
            $fotos = $soporte->fotos_estado ?? [];
            foreach ($request->file('fotos_estado') as $foto) {
                $path = $foto->store('soportes/fotos', 'public');
                $fotos[] = $path;
            }
            $data['fotos_estado'] = $fotos;
        }

        $soporte->update($request->except(['nombres', 'apellidos', 'numero_identificacion', 'telefono', 'correo']));

        return redirect()->route('soportes.index')
            ->with('success', 'Soporte actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $soporte = Soporte::findOrFail($id);
        
        // Eliminar fotos del storage
        if ($soporte->fotos_estado) {
            foreach ($soporte->fotos_estado as $foto) {
                Storage::disk('public')->delete($foto);
            }
        }
        
        $soporte->delete();

        return redirect()->route('soportes.index')
            ->with('success', 'Soporte eliminado exitosamente.');
    }
}
