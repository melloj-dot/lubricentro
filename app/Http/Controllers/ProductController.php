<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        Product::create($validated);

        return redirect()->route('producto.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit(string $id)
    {
        $product = Product::where('id',$id)->first();

        return view('product.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ]);


        $product = Product::where('id', $id)->first();
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->stock_quantity = $validated['stock_quantity'];

        $product->save();

        return redirect()->route('producto.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(string $id)
    {

        Product::where('id', $id)->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado.');
    }
}
