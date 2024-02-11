<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Talla;
use Illuminate\Http\Request;

class TallasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tallas = Talla::all();
        return response()->json($tallas);
    }

    // Mostrar una talla específica
    public function show($id)
    {
        $talla = Talla::findOrFail($id);
        return response()->json($talla);
    }

    // Crear una nueva talla
    public function store(Request $request)
    {
        $talla = Talla::create($request->all());
        return response()->json($talla, 201);
    }

    // Actualizar una talla existente
    public function update(Request $request, $id)
    {
        $talla = Talla::findOrFail($id);
        $talla->update($request->all());
        return response()->json($talla, 200);
    }

    // Eliminar una talla
    public function destroy($id)
    {
        Talla::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
