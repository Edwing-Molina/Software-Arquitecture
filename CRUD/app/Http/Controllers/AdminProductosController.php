<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductoResource; 

class AdminProductosController extends Controller
{
    public function index()
    {
        $productos = Product::with('pedidos')->orderBy('id', 'asc')->get();
        return view('admin-view', ['productos' => $productos]);
    }

    /**
     * Show create product form.
     */
    public function create()
    {
        return view('admin-create-product-view');
    }

    public function show($id)
    {
        $producto = Product::find($id);
        return view('admin-edit-product-view', ['producto' => $producto]);
    }

    public function store(Request $request)
    {
        $inputData = $request->isJson() ? $request->json()->all() : $request->all();

        if (!isset($inputData['nombre']) && isset($inputData['nombre_producto'])) {
            $inputData['nombre'] = $inputData['nombre_producto'];
        }

        $validator = validator($inputData, [
            'nombre' => 'required',
            'precio' => 'required',
            'imagen' => 'nullable|image|max:2048', 
            'imagen_url' => 'nullable|url'         
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $rutaFinal = null;

        
        if ($request->hasFile('imagen')) {   
            $rutaFinal = $request->file('imagen')->store('imagenes', 'public');
        } elseif ($request->filled('imagen_url')) {
            $rutaFinal = $request->input('imagen_url');
        }

        
        $datosParaCrear = [
            'nombre'      => $inputData['nombre'],
            'descripcion' => $inputData['descripcion'] ?? null,
            'precio'      => $inputData['precio'],
            'imagen'      => $rutaFinal,
            'categoria'   => $inputData['categoria'] ?? null,
        ];

        $producto = Product::create($datosParaCrear);

        if ($request->wantsJson()) {
            return response()->json($producto, 201);
        }

        return redirect()->route('admin-view.index');
    }

    public function update(Request $request, $id)
    {
        $producto = Product::find($id);

        if (!$producto) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Producto no encontrado'], 404);
            }
            return back()->with('error', 'Producto no encontrado');
        }
        $rutaFinal = $producto->imagen; 

        if ($request->hasFile('imagen')) {
            $rutaFinal = $request->file('imagen')->store('imagenes', 'public');
        } elseif ($request->filled('imagen_url')) {
            $rutaFinal = $request->input('imagen_url');
        }

        if ($request->isJson()) {
            $data = $request->json()->all();
        } else {
            $data = [
                'nombre' => $request->input('nombre', $request->input('nombre_producto')),
                'descripcion' => $request->input('descripcion'),
                'precio' => $request->input('precio'),
                'categoria' => $request->input('categoria'),
                'imagen' => $rutaFinal,
            ];
        }

        $validator = validator($data, [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categoria' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $producto->update($data);

        if ($request->wantsJson()) {
            return response()->json($producto);
        }

        return redirect()->route('admin-view.index');
    }

    public function destroy(Request $request, $id)
    {
        $producto = Product::find($id);
        if ($producto) {
            $producto->delete();
        }

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Producto eliminado correctamente'], 204);
        }

        return redirect()->route('admin-view.index');
    }

}