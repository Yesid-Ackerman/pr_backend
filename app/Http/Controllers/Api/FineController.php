<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fine;
use App\Models\People;
use Illuminate\Http\Request;

class FineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fines = Fine::included(); // Incluye relaciones según el parámetro 'included'
    
        return response()->json($fines);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lugar' => 'required|string|max:255',
            'fecha' => 'required|string|max:255', 
            'hora' => 'required|string|max:255',
            'matricul' => 'required|string|max:255', 
            'id_people' => 'sometimes|exists:peoples,id',
            'id_vehicle' => 'sometimes|exists:vehicles,id',
        ]);

        $fine = Fine::create($request->all());

        return response()->json($fine, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(Fine $fine)
    {
        $fine = Fine::included()->findOrFail($fine);
        return response()->json($fine);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fine $fine)
    {
        $request->validate([
            'lugar' => 'required|string|max:255',
            'fecha' => 'required|string|max:255', 
            'hora' => 'required|string|max:255',
            'matricul' => 'required|string|max:255', 
            'id_people' => 'sometimes|exists:peoples,id',
            'id_vehicle' => 'sometimes|exists:vehicles,id',
        ]);
        $fine->update($request->all());

        return response()->json($fine);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fine $fine)
    {
        $fine->delete();
        return response()->json(['message' => 'Eliminado Correctamente']);
    }
}
