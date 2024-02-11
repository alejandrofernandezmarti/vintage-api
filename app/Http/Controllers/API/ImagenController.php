<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Imagen;
use Illuminate\Http\Request;

class ImagenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imagenes = Imagen::all();
        return response()->json($imagenes);
    }

    // Mostrar una imagen específica
    public function show($id)
    {
        $imagen = Imagen::findOrFail($id);
        return response()->json($imagen);
    }

    // Crear una nueva imagen
    public function store(Request $request)
    {
        $imagen = Imagen::create($request->all());
        return response()->json($imagen, 201);
    }

    // Actualizar una imagen existente
    public function update(Request $request, $id)
    {
        $imagen = Imagen::findOrFail($id);
        $imagen->update($request->all());
        return response()->json($imagen, 200);
    }

    // Eliminar una imagen
    public function destroy($id)
    {
        Imagen::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
