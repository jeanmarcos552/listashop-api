<?php

use App\Http\Controllers\ItensController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\ListaUserController;
use App\Http\Controllers\ListaItensController;
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


// Puplic routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);



// protect routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('itens', [ItensController::class, 'index']);
    Route::get('itens/{id}', [ItensController::class, 'show']);
    Route::get('search/itens', [ItensController::class, 'search']);




    Route::post('itens', [ItensController::class, 'store']);
    Route::put('itens/{id}', [ItensController::class, 'update']);
    Route::delete('itens/{id}', [ItensController::class, 'destroy']);
    // Route::get('itens/search', [ItensController::class, 'searchs']);

    // LISTA
    Route::post('lista', [ListaController::class, 'store']);
    Route::post('addItem', [ListaItensController::class, 'addItem']);
    Route::post('removeItem', [ListaItensController::class, 'removeItem']);
    Route::post('updateItem', [ListaItensController::class, 'updateItem']);
    Route::post('addUserToList', [ListaUserController::class, 'store']);
    Route::post('removeUserToList/{id}', [ListaUserController::class, 'destroy']);
    Route::put('lista/{id}', [ListaController::class, 'update']);
    Route::delete('lista/{id}', [ListaController::class, 'destroy']);
    Route::get('lista', [ListaController::class, 'index']);
    Route::get('lista/{id}', [ListaController::class, 'show']);
    Route::get('lista/search/{name}', [ListaController::class, 'search']);
});
