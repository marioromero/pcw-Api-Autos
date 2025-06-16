<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//5 endpoints de la api, cada una apunta a un método del controlador CarController
Route::get('/cars', 'App\Http\Controllers\CarController@index');
Route::get('/cars/{id}', 'App\Http\Controllers\CarController@show');
Route::post('/cars', 'App\Http\Controllers\CarController@store');
Route::put('/cars/{id}', 'App\Http\Controllers\CarController@update');
Route::delete('/cars/{id}', 'App\Http\Controllers\CarController@destroy');

//Laravel provee un tipo de ruta "resource" que crea automáticamente las rutas para los métodos index, show, store, update y destroy
//lo que sería equivalente a las 5 rutas anteriores, se puede llamar así:
// Route::resource('cars', 'App\Http\Controllers\CarController');
