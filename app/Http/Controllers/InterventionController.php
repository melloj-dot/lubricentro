<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InterventionController extends Controller
{

       // function to parse date field to carbon

       public function update_fecha(){
        $interventions = Intervention::all();

        foreach ($interventions as $intervention) {
            $date  = Carbon::parse($intervention->fecha);
            $cliente = Intervention::where('id', $intervention->id)->first();
            $cliente->created_at = $date;
            $cliente->save();
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $interventions = Intervention::all();

        return view('intervention.index', compact('interventions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehiculos = Vehicle::orderBy('id','desc')->get();


        return view('intervention.create', compact('vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            //dd($request);
        // Validación de los datos del formulario
        $validatedData = $request->validate([
            'dominio' => 'required|exists:autos,Dominio', // Verifica que el dominio exista en la tabla autos
            'km' => 'required|integer|min:0',
            'pkm' => 'required|integer|min:0|gt:km', // Verifica que los próximos kilómetros sean mayores a los actuales
            'aceite' => 'nullable|in:SI',
            'filaceite' => 'nullable|in:SI',
            'filcomb' => 'nullable|in:SI',
            'filaire' => 'nullable|in:SI',
            'aceitecaja' => 'nullable|in:SI',
            'balanceo' => 'nullable|in:SI',
            'rotacion' => 'nullable|in:SI',
            'filhab' => 'nullable|in:SI',
            'aceitedif' => 'nullable|in:SI',
            'liqfreno' => 'nullable|in:SI',
            'fhid' => 'nullable|in:SI',
            'refrigrad' => 'nullable|in:SI',
            'observaciones' => 'required|string|max:255',
        ]);

        // Creación de la intervención
        $intervention = new Intervention();
        $intervention->dominio = $validatedData['dominio'];
        $intervention->km = $validatedData['km'];
        $intervention->pkm = $validatedData['pkm'];
        $intervention->aceite = $request->has('aceite') ? 'SI' : 'NO';
        $intervention->filtroaceite = $request->has('filaceite') ? 'SI' : 'NO';
        $intervention->filtrocomb = $request->has('filcomb') ? 'SI' : 'NO';
        $intervention->filtroaire = $request->has('filaire') ? 'SI' : 'NO';
        $intervention->aceitecaja = $request->has('aceitecaja') ? 'SI' : 'NO';
        $intervention->balanceo = $request->has('balanceo') ? 'SI' : 'NO';
        $intervention->rot = $request->has('rotacion') ? 'SI' : 'NO';
        $intervention->filtrohabitaculo = $request->has('filhab') ? 'SI' : 'NO';
        $intervention->aceitediferencial = $request->has('aceitedif') ? 'SI' : 'NO';
        $intervention->liqfreno = $request->has('liqfreno') ? 'SI' : 'NO';
        $intervention->fluidohidraulico = $request->has('fhid') ? 'SI' : 'NO';
        $intervention->refrigradiador = $request->has('refrigrad') ? 'SI' : 'NO';
        $intervention->observaciones = $validatedData['observaciones'];

        // Guardar en la base de datos
        $intervention->save();

        // Redirigir o devolver una respuesta exitosa
        return redirect()->route('intervencion.index')->with('success', 'Intervención añadida correctamente.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
