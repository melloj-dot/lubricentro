<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {

        $sales = Sale::with('product')->get();
        $products = Product::all();

        return view('sale.index', compact('sales', 'products'));
    }

    public function create()
    {
        $products = Product::all();
        return view('sale.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($validated['product_id']);
        $totalPrice = $product->price * $validated['quantity'];

        if ($product->stock_quantity < $validated['quantity']) {
            return back()->withErrors('No hay suficiente stock disponible.');
        }

        $sale = Sale::create([
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'total_price' => $totalPrice,
        ]);

        $product->decrement('stock_quantity', $validated['quantity']);

        return redirect()->route('venta.index')->with('success', 'Venta registrada exitosamente.');
    }
}
