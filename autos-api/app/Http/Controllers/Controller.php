<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //método de respuesta que estandariza las respuestas de la API, mediante los atributos status, message y data
    protected function response($status, $message, $data = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]);
    }
}
