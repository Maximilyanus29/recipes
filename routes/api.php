<?php

use App\Http\Controllers\RecipesController;
use Illuminate\Support\Facades\Route;

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

/**
 **Basic Routes for a RESTful service:
 **Route::get($uri, $callback);
 **Route::post($uri, $callback);
 **Route::put($uri, $callback);
 **Route::delete($uri, $callback);
 **
 */
Route::get('recipes', [RecipesController::class, 'index']);
Route::get('recipes/{recipe}', [RecipesController::class, 'show']);
Route::post('recipes', [RecipesController::class, 'store']);
Route::put('recipes/{recipe}', [RecipesController::class, 'update']);
Route::delete('recipes/{recipe}', [RecipesController::class, 'delete']);
