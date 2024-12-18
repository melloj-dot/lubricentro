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
        $products = Product::all();

        return view('stock.index', compact('stocks', 'products'));
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

    public function destroy(string $id){

        $stock = Stock::where('id', $id)->first();

        $product_substraction = Product::where('id',$stock->product_id)->first();

        if ($stock->quantity >$product_substraction->stock_quantity ) {
            // la cantidad a eliminar es mayor a la que hay de ese producto
            //mje error(?)
        }else{
            $substraction = ($product_substraction->stock_quantity) - ($stock->quantity);
            $product_substraction->stock_quantity = $substraction;
            $product_substraction->save();
        }



        return to_route('stock.index');
    }
}
