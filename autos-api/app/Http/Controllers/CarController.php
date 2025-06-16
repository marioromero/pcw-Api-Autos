<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //usa try catch para devolver eventuales errores y setea codigo de estado segun el metodo de respuesta response()
        try {
            //trae autos de bd
            $cars = Car::all();

            return $this->response(true, 'Lista de autos extraída correctamente', $cars);
        } catch (\Exception $e) {
            return $this->response(false, 'Error al consultar autos: ' . $e->getMessage(), null, 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada los datos
        $validator = Validator::make(
            $request->all(),
            [
                'patente' => 'required|string|max:60|unique:cars,patente',
                'marca' => 'required|string|max:50',
                'modelo' => 'required|string|max:50',
                'year' => 'required|integer|min:1886|max:' . date('Y'),
                'kilometraje' => 'required|integer|min:0',
            ]
        );

        // si tengo un error de validación, retorna un error 422
        if ($validator->fails()) {
            return $this->response(false, 'Error de validación ', $validator->errors(), 422);
        }
        // Crea el auto en base a los parámetros que devuelve la validación
        $car = $validator->validated();

        try {
            // Crear un nuevo auto
            $newCar = Car::create($car);

            return $this->response(true, 'Auto creado ', $newCar, 201);
        } catch (\Exception $e) {
            return $this->response(false, 'Error al crear auto: ' . $e->getMessage(), null, 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //dd($car);
        //laravel ya sabe que el parámetro $car es un objeto de tipo Car, gracias a la inyección de dependencias,
        //por lo que no es necesario buscarlo en la base de datos manualmente, lo busca automáticamente
        try {
            //retorna el auto solicitado
            return $this->response(true, 'Auto consultado: ', $car);
        } catch (\Exception $e) {
            return $this->response(false, 'Error al consultar auto: ' . $e->getMessage(), null, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {

        // Validar los datos de entrada
        $validator = Validator::make(
            $request->all(),
            [
                'patente' => 'sometimes|required|string|max:60|unique:cars,patente,' . $car->id,
                'marca' => 'sometimes|required|string|max:50',
                'modelo' => 'sometimes|required|string|max:50',
                'year' => 'sometimes|required|integer|min:1886|max:' . date('Y'),
                'kilometraje' => 'sometimes|required|integer|min:0',
            ]
        );

        // si tengo un error de validación, retorna un error 422
        if ($validator->fails()) {
            return $this->response(false, 'Error de validación ', $validator->errors(), 422);
        }

        try {
            // Actualizar el auto con los datos validados
            $car->update($validator->validated());

            return $this->response(true, 'Auto Actualizado', $car);
        } catch (\Exception $e) {
            return $this->response(false, 'Error al actualizar auto: ' . $e->getMessage(), null, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy(?Car $auto)
{
    //dd($id);
    if (!$auto) {
        return $this->response(false, 'Auto no encontrado', null, 404);
    }

    try {
        $auto->delete();
        return $this->response(true, 'Auto eliminado', null, 200);
    } catch (\Exception $e) {
        return $this->response(false, 'Error al borrar auto: ' . $e->getMessage(), null, 500);
    }
}
}
