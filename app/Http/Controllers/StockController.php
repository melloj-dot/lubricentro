<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('product')->get();
        return view('stock.index', compact('stocks'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stock.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:addition,subtraction',
            'description' => 'nullable|string',
        ]);

        $product = Product::find($validated['product_id']);

        if ($validated['type'] === 'subtraction' && $product->stock_quantity < $validated['quantity']) {
            return back()->withErrors('No hay suficiente stock disponible.');
        }

        $stock = Stock::create($validated);

        if ($validated['type'] === 'addition') {
            $product->increment('stock_quantity', $validated['quantity']);
        } else {
            $product->decrement('stock_quantity', $validated['quantity']);
        }

        return redirect()->route('stock.index')->with('success', 'Movimiento de stock registrado.');
    }
}
