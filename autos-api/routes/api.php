<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//ruta prueba que retorna un json de prueba con una lista de autos inventados
Route::get('/cars', function () {
    return response()->json([
        ['id' => 1, 'make' => 'Toyota', 'model' => 'Corolla', 'year' => 2020],
        ['id' => 2, 'make' => 'Honda', 'model' => 'Civic', 'year' => 2021],
        ['id' => 3, 'make' => 'Ford', 'model' => 'Focus', 'year' => 2019],
    ]);
});
