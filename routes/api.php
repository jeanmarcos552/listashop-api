<?php

use App\Http\Controllers\ItensController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\ListaUserController;
use App\Http\Controllers\ListaItensController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationsController;
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

    // LISTA
    Route::post('lista', [ListaController::class, 'store']);
    Route::post('addItem', [ListaItensController::class, 'addItem']);
    Route::post('removeItem', [ListaItensController::class, 'removeItem']);
    Route::get('itensLista/{id}', [ListaItensController::class, 'showByStatus']);
    Route::post('updateItem', [ListaItensController::class, 'updateItem']);
    Route::post('addUserToList', [ListaUserController::class, 'store']);
    Route::post('removeUserToList/{id}', [ListaUserController::class, 'destroy']);
    Route::put('lista/{id}', [ListaController::class, 'update']);
    Route::delete('lista/{id}', [ListaController::class, 'destroy']);
    Route::get('lista', [ListaController::class, 'index']);
    Route::get('lista/{id}', [ListaController::class, 'show']);
    Route::get('lista/search/{name}', [ListaController::class, 'search']);

    // Categorias
    Route::get('category', [CategoryController::class, 'index']);
    Route::POST('category', [CategoryController::class, 'store']);
    Route::get('category/{id}', [CategoryController::class, 'show']);

    // Notifications
    Route::get('notifications', [NotificationsController::class, 'index']);
    Route::post('notifications', [NotificationsController::class, 'store']);
    Route::get('notifications/{id}', [NotificationsController::class, 'show']);
    Route::put('notifications/{id}', [NotificationsController::class, 'update']);
    Route::put('notifications/{id}', [NotificationsController::class, 'destroy']);
});