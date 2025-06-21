<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function buscar(Request $request)
    {
        $query = $request->input('query');
        if (!$query) {
            return response()->json([]);
        }

        $clientes = Cliente::where('nombres', 'LIKE', "%{$query}%")
            ->orWhere('apellidos', 'LIKE', "%{$query}%")
            ->orWhere('numero_identificacion', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        return response()->json($clientes);
    }
}
