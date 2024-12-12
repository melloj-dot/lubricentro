<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;


class CustomerController extends Controller
{

    // function to parse date field to carbon

    public function update_date(){
        $customers = Customer::all();

        foreach ($customers as $customer) {
            $date  = Carbon::parse($customer->date);
            $cliente = Customer::where('id', $customer->id)->first();
            $cliente->created_at = $date;
            $cliente->save();
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();

        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
         // Validación de los datos
         $validatedData = $request->validate([
            'cuit_cuil' => [
            'required',
            'string',
            'unique:clientes,cuit_cuil',  // Verifica que sea único en la tabla 'clientes'
            ],
            'nombre_cliente' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
        ]);

        // Crear el cliente y guardarlo en la base de datos
        $cliente = new Customer();
        $cliente->cuit_cuil = $validatedData['cuit_cuil'];
        $cliente->name = $validatedData['nombre_cliente'];
        $cliente->adress = $validatedData['direccion'];
        $cliente->telephone = $validatedData['telefono'];
        $cliente->save();

        // Redireccionar con un mensaje de éxito
        return to_route('cliente.index');
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
        $customer = Customer::where('id',$id)->first();

        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::where('id', $id)->first();
        $customer->cuit_cuil = $request->cuit_cuil;
        $customer->name = $request->nombre_cliente;
        $customer->adress = $request->direccion;
        $customer->telephone = $request->telefono;
        $customer->save();

        return to_route('cliente.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customer::where('id', $id)->delete();

        return to_route('cliente.index');
    }
}
