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




Route::get('/get-racion', function () {

    $res = \Illuminate\Support\Facades\DB::table("recipe")->limit(4)->get()->toArray();

    $rrs = array_map(function ($el){
        return $el->name;

    }, $res);

    var_dump($rrs);die;



    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});




