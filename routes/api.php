<?php

use App\Http\Controllers\ItensController;
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

Route::prefix('itens')->group(function () {
    Route::post("/create", [ItensController::class, 'store']);
    Route::get("/show/{id}", [ItensController::class, 'show']);
    Route::get("/show", [ItensController::class, 'index']);
});