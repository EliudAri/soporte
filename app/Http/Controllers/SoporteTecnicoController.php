<?php

namespace App\Http\Controllers;

use App\Models\Soporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SoporteTecnicoController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Soporte $soporte)
    {
        $estados = Soporte::getEstados();
        return view('soportes_Tecni.edit', compact('soporte', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Soporte $soporte)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,en_proceso,completado,cancelado',
            'diagnostico_tecnico' => 'required|string',
            'costo_estimado' => 'nullable|numeric|min:0',
            'evidencia_tecnico.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only('estado', 'diagnostico_tecnico');

        // Limpiar y preparar el costo estimado
        if ($request->filled('costo_estimado')) {
            $costo = $request->input('costo_estimado');
            // Eliminar puntos de miles y reemplazar comas de decimales por puntos
            $data['costo_estimado'] = str_replace(',', '.', str_replace('.', '', $costo));
        } else {
            $data['costo_estimado'] = null;
        }

        // Asignar el técnico actual si no hay uno asignado
        if (!$soporte->tecnico_id) {
            $data['tecnico_id'] = Auth::id();
        }
        
        // Procesar nuevas fotos de evidencia del tecnico
        if ($request->hasFile('evidencia_tecnico')) {
            $evidencia = $soporte->evidencia_tecnico ?? [];
            foreach ($request->file('evidencia_tecnico') as $foto) {
                $path = $foto->store('soportes/evidencia', 'public');
                $evidencia[] = $path;
            }
            $data['evidencia_tecnico'] = $evidencia;
        }

        $soporte->update($data);

        return redirect()->route('soportes.show', $soporte)
            ->with('success', 'Diagnóstico actualizado exitosamente.');
    }
}
