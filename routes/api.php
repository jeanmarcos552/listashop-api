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

    // Items
    Route::get('itens', [ItensController::class, 'index']);
    Route::get('itens/{id}', [ItensController::class, 'show']);
    Route::get('itens-search', [ItensController::class, 'search']);
    Route::post('itens', [ItensController::class, 'store']);
    Route::put('itens/{id}', [ItensController::class, 'update']);
    Route::delete('itens/{id}', [ItensController::class, 'destroy']);

    // LISTA
    Route::get('lista', [ListaController::class, 'index']); // lista
    Route::post('lista', [ListaController::class, 'store']); //create
    Route::put('lista/{id}', [ListaController::class, 'update']); // update
    Route::delete('lista/{id}', [ListaController::class, 'destroy']);
    Route::get('lista/{id}', [ListaController::class, 'show']);

    // ItemsLista
    Route::post('itemsListAdd', [ListaItensController::class, 'addItem']); //addItem
    Route::delete('itemsListRemove/{lista_id}/{item_id}', [ListaItensController::class, 'removeItem']);
    Route::get('itensLista/{id}', [ListaItensController::class, 'showByStatus']);
    Route::put('updateItem/{lista_id}/{item_id}', [ListaItensController::class, 'updateItem']);

    // Lista User
    Route::post('addUserToList', [ListaUserController::class, 'store']);
    Route::delete('removeUserToList/{lista_id}/{user_id}', [ListaUserController::class, 'destroy']);

    // Categorias
    Route::get('category', [CategoryController::class, 'index']);
    Route::POST('category', [CategoryController::class, 'store']);
    Route::get('category/{id}', [CategoryController::class, 'show']);

    // Notifications
    Route::get('notifications', [NotificationsController::class, 'index']);
    Route::post('notifications', [NotificationsController::class, 'store']);
    Route::get('notifications/{id}', [NotificationsController::class, 'show']);
    Route::put('notifications/{id}', [NotificationsController::class, 'update']);
    Route::delete('notifications/{id}', [NotificationsController::class, 'destroy']);
});