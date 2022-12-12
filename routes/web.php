<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\PedidoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('auth.login');
});

/*Route::get('producto/index', [ProductoController::class, 'index']);*/

//Route::get('formulario/create', [ProductoController::class, 'create']);
//Route::get('formulario/edit', [ProductoController::class, 'edit']);
//Route::get('producto/administrador', [ProductoController::class, 'lista']);

Auth::routes();


route::group(['middelware' => 'auth'], function(){
    Route::get('/', [ProductoController::class, 'lista']);
    Route::get('/home', [ProductoController::class, 'lista']);
    Route::resource('/producto', ProductoController::class);
    Route::get('/producto/lista', [ProductoController::class, 'lista']);
    
    

    //Route::get('/', [MesaController::class, 'lista']);
    Route::get('/mesas/lista', [MesaController::class, 'lista']);
    Route::resource('/mesas', MesaController::class);

    //Route::get('/', [LocalController::class, 'lista']);
    Route::get('/local/lista', [LocalController::class, 'lista']);
    Route::resource('/local', LocalController::class);

    //Route::get('/', [PedidoController::class, 'lista']);
    Route::get('/pedidos/lista', [PedidoController::class, 'lista']);
    Route::resource('/pedidos', PedidoController::class);

    //rutas de vistas de alimentos
    Route::get('/home/bebida', [ProductoController::class, 'bebida']);
    Route::get('/home/alcohol', [ProductoController::class, 'alcohol']);
    Route::get('/home/ensalada', [ProductoController::class, 'ensalada']);
    Route::get('/home/postre', [ProductoController::class, 'postre']);

});



