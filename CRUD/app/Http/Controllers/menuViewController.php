<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductoResource;
use App\Models\Product;
use Illuminate\Http\Request;

class menuViewController extends Controller
{
    public function index()
    {
        $productos = Product::with('pedidos')->orderBy('id', 'asc')->get();

        return view('menu-view', ['productos' => $productos]);
    }

    public function show($id){
        $producto = Product::find($id);

        return view('menu-view', ['productos' => collect([$producto])]);
    }

}