<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peoples = People::included(); // Incluye relaciones según el parámetro 'included'
    
        return response()->json($peoples);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255', 
        ]);

        $people = People::create($request->all());

        return response()->json($people, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(People $people)
    {
        $people = People::included()->findOrFail($people);
        return response()->json($people);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, People $people)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);
        $people->update($request->all());

        return response()->json($people);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(People $people)
    {
        $people->delete();
        return response()->json(['message' => 'Eliminado Correctamente']);
    }
}
