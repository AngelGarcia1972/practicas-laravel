<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Producto::all());
    }

    public function store(Request $request): JsonResponse
    {
        if (!$request->user()->tokenCan('crear')) {
            return response()->json(['mensaje' => 'No tienes permiso para crear productos'], 403);
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $producto = Producto::create($validated);

        return response()->json($producto, 201);
    }

    public function show(Producto $producto): JsonResponse
    {
        return response()->json($producto);
    }

    public function update(Request $request, Producto $producto): JsonResponse
    {
        if (!$request->user()->tokenCan('editar')) {
            return response()->json(['mensaje' => 'No tienes permiso para editar productos'], 403);
        }

        $validated = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
        ]);

        $producto->update($validated);

        return response()->json($producto);
    }

    public function destroy(Producto $producto): JsonResponse
    {
        if (!$request->user()->tokenCan('eliminar')) {
            return response()->json(['mensaje' => 'No tienes permiso para eliminar productos'], 403);
        }

        $producto->delete();

        return response()->json(null, 204);
    }
}
