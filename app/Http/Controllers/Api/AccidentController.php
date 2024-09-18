<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Accident;
use Illuminate\Http\Request;

class AccidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accidents = Accident::included(); // Incluye relaciones según el parámetro 'included'
    
        return response()->json($accidents);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|string|max:255', 
            'hora' => 'required|string|max:255',
            'lugar' => 'required|string|max:255', 
        ]);

        $accident = Accident::create($request->all());

        return response()->json($accident, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(Accident $accident)
    {
        $accident = Accident::included()->findOrFail($accident);
        return response()->json($accident);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Accident $accident)
    {
        $request->validate([
            'fecha' => 'required|string|max:255', 
            'hora' => 'required|string|max:255',
            'lugar' => 'required|string|max:255',
        ]);
        $accident->update($request->all());

        return response()->json($accident);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accident $accident)
    {
        $accident->delete();
        return response()->json(['message' => 'Eliminado Correctamente']);
    }
}
