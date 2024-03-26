<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompraResource;
use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::all();
        return CompraResource::collection($compras);
    }
    public function ordersByUser(){
        $user = Auth::user();
        if ($user) {
            // Obtener las compras del usuario
            $compras = Compra::where('id_user', $user->id)->get();

            // Retornar las compras del usuario en forma de recursos
            return CompraResource::collection($compras);
        } else {
            // Retornar un mensaje de error si el usuario no está autenticado
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }
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
