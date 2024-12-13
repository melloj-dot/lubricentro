<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Customer;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::all();

        return view('vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $clientes = Customer::orderBy('id','desc')->get();

        return view('vehicle.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $customer_data = Customer::where('id', $request->cliente_id)->first();
            // Validaciones
        $validatedData = $request->validate([
            'cliente_id' => 'required|exists:clientes,id', // Verifica que el cliente existe en la tabla 'clientes'
            'modelo' => 'required|string|max:255',       // Campo requerido, tipo string, máximo 255 caracteres
            'dominio' => 'required|string|max:10|unique:autos,dominio', // Dominio único y máximo 10 caracteres
            'aceite' => 'required|string|max:255',  // Campo requerido, tipo string, máximo 255 caracteres
            'aceitedif' => 'required|string|max:255',
            'ncubiertas' => 'required|string|max:30',
        ], [
            // Mensajes personalizados de error
            'cliente_id.required' => 'El cliente es obligatorio.',
            'cliente_id.exists' => 'El cliente seleccionado no existe.',
            'modelo.required' => 'El modelo del vehículo es obligatorio.',
            'dominio.required' => 'El dominio del vehículo es obligatorio.',
            'dominio.unique' => 'El dominio ingresado ya está registrado.',
            'ncubiertas.required' => 'El número de cubiertas es obligatorio.',
        ]);

        // Guardar datos en la base de datos
        $vehiculo = new Vehicle();
        $vehiculo->Modelo = $validatedData['modelo'];
        $vehiculo->Dominio = $validatedData['dominio'];
        $vehiculo->Aceite = $validatedData['aceite'];
        $vehiculo->ADiferencial = $validatedData['aceitedif'];
        $vehiculo->NCubiertas = $validatedData['ncubiertas'];
        $vehiculo->NPropietario = $customer_data->name;
        $vehiculo->CuitCuil = $customer_data->cuit_cuil;



        $vehiculo->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('vehiculo.index')->with('success', 'Vehículo registrado correctamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vehiculo = Vehicle::where('ID',$id)->first();

        return view('vehicle.edit', compact('vehiculo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        // Validaciones
        $validatedData = $request->validate([
            'modelo' => 'required|string|max:255',       // Campo requerido, tipo string, máximo 255 caracteres
            'dominio' => 'required|string|max:10|unique:autos,Dominio,', // Dominio único, excluyendo el actual
            'aceite' => 'required|string|max:255',       // Campo requerido, tipo string, máximo 255 caracteres
            'aceitedif' => 'required|string|max:255',   // Campo requerido, tipo string, máximo 255 caracteres
            'ncubiertas' => 'required|string|max:255'    // Campo requerido, tipo string, máximo 255 caracteres
        ], [
            // Mensajes personalizados de error

            'modelo.required' => 'El modelo del vehículo es obligatorio.',
            'dominio.required' => 'El dominio del vehículo es obligatorio.',
            'dominio.unique' => 'El dominio ingresado ya está registrado.',
            'aceite.required' => 'El aceite del vehículo es obligatorio.',
            'aceitedif.required' => 'El aceite diferencial del vehículo es obligatorio.',
            'ncubiertas.required' => 'El número de cubiertas es obligatorio.',
        ]);



        // Buscar el vehículo existente
        $vehiculo = Vehicle::where('ID', $id)->first();


        // Actualizar datos

        $vehiculo->Modelo = $validatedData['modelo'];
        $vehiculo->Dominio = $validatedData['dominio'];
        $vehiculo->Aceite = $validatedData['aceite'];
        $vehiculo->ADiferencial = $validatedData['aceitedif'];
        $vehiculo->NCubiertas = $validatedData['ncubiertas'];
        $vehiculo->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('vehiculo.index')->with('success', 'Vehículo actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Vehicle::where('ID', $id)->delete();

        return to_route('vehiculo.index');
    }
}
