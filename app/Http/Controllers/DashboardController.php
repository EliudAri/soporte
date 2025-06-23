<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Soporte;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->hasRole('Administrador')) {
            // Conteo de soportes por estado
            $soportesPorEstado = Soporte::select('estado', DB::raw('count(*) as total'))
                                        ->groupBy('estado')
                                        ->pluck('total', 'estado');

            // Verificar si el rol Tecnico existe
            $rolTecnico = Role::where('name', 'Tecnico')->first();
            $totalTecnicos = $rolTecnico ? User::role('Tecnico')->count() : 0;

            $stats = [
                'total_clientes' => Cliente::count(),
                'total_tecnicos' => $totalTecnicos,
                'soportes_pendientes' => $soportesPorEstado->get('pendiente', 0),
                'soportes_en_proceso' => $soportesPorEstado->get('en_proceso', 0),
                'soportes_completados' => $soportesPorEstado->get('completado', 0),
                'soportes_cancelados' => $soportesPorEstado->get('cancelado', 0),
            ];

            // Últimos 5 soportes registrados
            $ultimosSoportes = Soporte::with('cliente')->latest()->take(5)->get();
            
            // Obtener los nombres de los estados del modelo Soporte
            $nombresEstados = Soporte::getEstados();

            return view('dashboardAdmin', compact('stats', 'ultimosSoportes', 'nombresEstados'));

        } elseif ($user->hasRole('Tecnico')) {
            return view('dashboardTecni');
        } elseif ($user->hasRole('User')) {
            return view('dashboardUser');
        } else {
            abort(403, 'No tienes acceso a ningún dashboard.');
        }
    }
}
