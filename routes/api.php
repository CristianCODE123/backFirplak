<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PODController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\guiasTransporte;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/clientes', [ClienteController::class, 'index']);
Route::post('/pods', [PODController::class, 'store']);
Route::get('/pods', [PODController::class, 'index']);

Route::post('/getPedidosLinea/{pedidoId}', [PedidoController::class, 'indexLinea']);

Route::get('/getPedidos', [PedidoController::class, 'index']);
Route::post('/pedidos', [PedidoController::class, 'store']);
Route::get('/productos', [ProductoController::class, 'index']);
Route::post('/crearPedido/{pedidoId}', [PedidoController::class, 'crearLineaPedido']);
Route::get('/PedidosConLineas', [PedidoController::class, 'consultarPedidosConLineas']);
Route::post('/DocumentosEntrega', [PedidoController::class, 'obtenerDocumentosEntrega']);
Route::post('subirDocEntrega/{id}', [PedidoController::class, 'subirFotoDocumento']);


Route::post('/guiastransporte', [guiasTransporte::class, 'store']);
Route::get('/guiastransporte', [guiasTransporte::class, 'index']);