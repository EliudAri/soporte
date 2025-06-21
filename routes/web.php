<?php

use Illuminate\Support\Facades\Route;

use \App\Models\User;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SoporteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SoporteTecnicoController;
use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return view('welcome');
    // return view('auth.login');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // FUNCION DASHBOARD SEGUN EL ROL DEL USUARIO
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user && $user->hasRole('Administrador')) {
            return view('dashboardAdmin');
        } elseif ($user && $user->hasRole('Tecnico')) {
            return view('dashboardTecni');
        } elseif ($user && $user->hasRole('User')) {
            return view('dashboardUser');
        } else {
            abort(403, 'No tienes acceso a ningún dashboard.');
        }
    })->middleware('can:dashboard')->name('dashboard');


    //-----------RUTAS PARA EL MENU, ESTO LLAMA A LAS VISTAS QUE SE CREAN EN LA CARPETA MENU-----------

    // DATO IMPORTANTE, DONDE ESTA EL ROUTE::GET ESE NOMBRE DE /crear-areas es peronalizable, LO QUE NO SE CAMBIA ES LA RUTA REAL QUE ES EL RETURN VIEW QUE ESE SI ES LA RUTA REAL, AH Y EL NOMBRE QUE SE LE COLOCA EN NAME crearAreas


    Route::get('/usuarios', function () {
        $usuarios = User::all();
        return view('menu.usuarios', compact('usuarios'));
    })->middleware('can:usuarios')->name('usuarios');

    Route::get('/soporte', function () {
        return view('menu.soporte');
    })->middleware('can:soporte')->name('soporte');




    //-----------RUTAS QUE MANEJAN LOS DATOS COMO LOS METODOS DE CREATE, STORE, SHOW, EDIT, UPDATE, DESTROY, INDEX-----------


    // Rutas para roles
    Route::get('/roles', [RoleController::class, 'index'])->middleware('can:roles.index')->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->middleware('can:roles.create')->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->middleware('can:roles.store')->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->middleware('can:roles.edit')->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->middleware('can:roles.update')->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->middleware('can:roles.destroy')->name('roles.destroy');

    // Rutas para usuarios
    Route::get('/usuarios', [UserController::class, 'index'])->middleware('can:usuarios.index')->name('usuarios.index');
    Route::get('/usuarios/create', [UserController::class, 'create'])->middleware('can:usuarios.create')->name('usuarios.create');
    Route::post('/usuarios', [UserController::class, 'store'])->middleware('can:usuarios.create')->name('usuarios.store');
    Route::get('/usuarios/{usuario}/edit', [UserController::class, 'edit'])->middleware('can:usuarios.edit')->name('usuarios.edit');
    Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->middleware('can:usuarios.update')->name('usuarios.update');

    // Rutas para soportes
    Route::get('/soportes', [SoporteController::class, 'index'])->middleware('can:soportes.index')->name('soportes.index');
    Route::get('/soportes/create', [SoporteController::class, 'create'])->middleware('can:soportes.create')->name('soportes.create');
    Route::post('/soportes', [SoporteController::class, 'store'])->middleware('can:soportes.create')->name('soportes.store');
    Route::get('/soportes/{soporte}', [SoporteController::class, 'show'])->middleware('can:soportes.show')->name('soportes.show');
    Route::get('/soportes/{soporte}/edit', [SoporteController::class, 'edit'])->middleware('can:soportes.edit')->name('soportes.edit');
    Route::put('/soportes/{soporte}', [SoporteController::class, 'update'])->middleware('can:soportes.update')->name('soportes.update');
    Route::delete('/soportes/{soporte}', [SoporteController::class, 'destroy'])->middleware('can:soportes.destroy')->name('soportes.destroy');

    
     // Rutas para soportes_Tecni
     Route::get('/soportes_Tecni', [SoporteTecnicoController::class, 'index'])->middleware('can:soportes_Tecni.index')->name('soportes_Tecni.index');
     Route::get('/soportes_Tecni/create', [SoporteTecnicoController::class, 'create'])->middleware('can:soportes_Tecni.create')->name('soportes_Tecni.create');
     Route::post('/soportes_Tecni', [SoporteTecnicoController::class, 'store'])->middleware('can:soportes_Tecni.create')->name('soportes_Tecni.store');
     Route::get('/soportes_Tecni/{soporte}', [SoporteTecnicoController::class, 'show'])->middleware('can:soportes_Tecni.show')->name('soportes_Tecni.show');
     Route::get('/soportes_Tecni/{soporte}/edit', [SoporteTecnicoController::class, 'edit'])->middleware('can:soportes_Tecni.edit')->name('soportes_Tecni.edit');
     Route::put('/soportes_Tecni/{soporte}', [SoporteTecnicoController::class, 'update'])->middleware('can:soportes_Tecni.update')->name('soportes_Tecni.update');
     Route::delete('/soportes_Tecni/{soporte}', [SoporteTecnicoController::class, 'destroy'])->middleware('can:soportes_Tecni.destroy')->name('soportes_Tecni.destroy');




    
    //-----------FIN RUTAS QUE MANEJAN LOS DATOS-----------

    // Route::get('/home', [HomeController::class, 'redirect'])->name('home');

    Route::get('/clientes/buscar', [ClienteController::class, 'buscar'])->name('clientes.buscar');
});

// Proteger el registro para que solo el admin pueda acceder
Route::get('register', function () {
    abort(403, 'No tienes acceso perro.');
})->name('register');
Route::post('register', function () {
    abort(403);
});
