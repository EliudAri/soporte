<?php

use Illuminate\Support\Facades\Route;

use \App\Models\User;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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


    //-----------FIN RUTAS QUE MANEJAN LOS DATOS-----------

    Route::get('/home', [HomeController::class, 'redirect'])->name('home');
});

// Proteger el registro para que solo el admin pueda acceder
Route::get('register', function () {
    abort(403);
})->name('register');
Route::post('register', function () {
    abort(403);
});
