<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::included(); // Incluye relaciones según el parámetro 'included'
    
        return response()->json($vehicles);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255', 
            'people_id' => 'sometimes|exists:peoples,id',
        ]);

        $vehicle = Vehicle::create($request->all());

        return response()->json($vehicle, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle = Vehicle::included()->findOrFail($vehicle);
        return response()->json($vehicle);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255', 
            'people_id' => 'sometimes|exists:peoples,id',
        ]);
        $vehicle->update($request->all());

        return response()->json($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return response()->json(['message' => 'Eliminado Correctamente']);
    }
}