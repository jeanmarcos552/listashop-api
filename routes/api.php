<?php

use App\Http\Controllers\ItensController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListaController;
use App\Models\Itens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:api')->resource('/itens', ItensController::class);


// Puplic routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('itens', [ItensController::class, 'index']);
Route::get('itens/{id}', [ItensController::class, 'show']);
Route::get('itens/search/{name}', [ItensController::class, 'search']);

Route::get('lista', [ListaController::class, 'index']);
Route::get('lista/{id}', [ListaController::class, 'show']);
Route::get('lista/search/{name}', [ListaController::class, 'search']);

// protect routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('itens', [ItensController::class, 'index']);
    Route::put('itens/{id}', [ItensController::class, 'show']);
    Route::delete('itens/{id}', [ItensController::class, 'search']);

    Route::post('lista', [ListaController::class, 'store']);
    Route::put('lista/{id}', [ListaController::class, 'show']);
    Route::delete('lista/{id}', [ListaController::class, 'search']);
});