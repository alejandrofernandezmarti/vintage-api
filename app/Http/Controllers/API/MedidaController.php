<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Medida;
use Illuminate\Http\Request;

class MedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medidas = Medida::all();
        return response()->json($medidas);
    }

    // Mostrar una medida específica
    public function show($id)
    {
        $medida = Medida::findOrFail($id);
        return response()->json($medida);
    }

    // Crear una nueva medida
    public function store(Request $request)
    {
        $medida = Medida::create($request->all());
        return response()->json($medida, 201);
    }

    // Actualizar una medida existente
    public function update(Request $request, $id)
    {
        $medida = Medida::findOrFail($id);
        $medida->update($request->all());
        return response()->json($medida, 200);
    }

    // Eliminar una medida
    public function destroy($id)
    {
        Medida::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
