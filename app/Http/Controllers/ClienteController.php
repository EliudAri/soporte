<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function buscar(Request $request)
    {
        $query = trim(strtolower($request->input('query')));
        $cliente = Cliente::whereRaw('LOWER(TRIM(numero_identificacion)) = ?', [$query])
            ->orWhereRaw('LOWER(TRIM(telefono)) = ?', [$query])
            ->orWhereRaw('LOWER(TRIM(correo)) = ?', [$query])
            ->first();

        if ($cliente) {
            return response()->json(['found' => true, 'cliente' => $cliente]);
        } else {
            return response()->json(['found' => false]);
        }
    }
}
