<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/










//
//
//Route::post('/', function (Request $request) {
//
//    var_dump($request);die;
//
//
//    $models = \Illuminate\Support\Facades\DB::table("recipe")->limit(50)->get();
//    return view('welcome', ['models' => $models]);
//});

use App\Http\Controllers\RecipesController;

Route::get('/', [RecipesController::class, 'index']);
Route::post('/', [RecipesController::class, 'index']);
Route::get('/reset-filters', [RecipesController::class, 'resetFilters']);
Route::get('/gen', [RecipesController::class, 'gen']);
Route::post('/gen', [RecipesController::class, 'gen']);
Route::get('/{slug}', [RecipesController::class, 'show']);







