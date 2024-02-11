<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MarcaCollection;
use App\Http\Resources\MarcaResource;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::all();
        return new MarcaCollection($marcas);
    }

    // Mostrar una marca específica
    public function show(Marca $marca)
    {
        return new MarcaResource($marca);
    }

    // Crear una nueva marca
    public function store(Request $request)
    {
        $marca = Marca::create($request->all());
        return new MarcaResource($marca);
    }

    // Actualizar una marca existente
    public function update(Request $request, Marca $marca)
    {
        $marca->update($request->all());
        return new MarcaResource($marca);
    }

    // Eliminar una marca
    public function destroy(Marca $marca)
    {
        $marca->delete();
        return response()->json(null, 204);
    }
}
