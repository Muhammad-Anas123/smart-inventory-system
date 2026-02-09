<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    // Show all stock logs
    public function index()
    {
        $stocks = Stock::with('product')->latest()->paginate(10);
        return view('stocks.index', compact('stocks'));
    }

    // Show form to add stock
    public function create()
    {
        $products = Product::all();
        return view('stocks.create', compact('products'));
    }

    // Store stock in/out
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type'       => 'required|in:in,out',
            'quantity'   => 'required|integer|min:1',
            'note'       => 'nullable|string'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Update product quantity
        if ($request->type === 'in') {
            $product->quantity += $request->quantity;
        } else { // type = out
            if ($request->quantity > $product->quantity) {
                return back()->withErrors(['quantity' => 'Not enough stock for this product.']);
            }
            $product->quantity -= $request->quantity;
        }

        $product->save();

        // Create stock log
        Stock::create([
            'product_id' => $product->id,
            'type'       => $request->type,
            'quantity'   => $request->quantity,
            'note'       => $request->note,
        ]);

        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully.');
    }
}
