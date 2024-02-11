<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompraResource;
use App\Models\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::all();
        return CompraResource::collection($compras);
    }

    // Mostrar una compra específica
    public function show($id)
    {
        $compra = Compra::findOrFail($id);
        return new CompraResource($compra);
    }

    // Crear una nueva compra
    public function store(Request $request)
    {
        $compra = Compra::create($request->all());
        return new CompraResource($compra);
    }

    // Actualizar una compra existente
    public function update(Request $request, $id)
    {
        $compra = Compra::findOrFail($id);
        $compra->update($request->all());
        return new CompraResource($compra);
    }

    // Eliminar una compra
    public function destroy($id)
    {
        $compra = Compra::findOrFail($id);
        $compra->delete();
        return response()->json(null, 204);
    }
}
