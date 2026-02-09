<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::latest()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $products = Product::all();
        return view('invoices.create', compact('products'));
    }

    public function store(Request $request)
{
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'items' => 'required|array',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.quantity'   => 'required|integer|min:1',
    ]);

    // Start DB transaction to prevent partial updates
    DB::beginTransaction();

    try {
        // Create the invoice
        $invoice = Invoice::create([
            'customer_name' => $request->customer_name,
            'total' => 0,
        ]);

        $total = 0;

        foreach ($request->items as $item) {
            $product = Product::findOrFail($item['product_id']);

            // Check stock availability
            if ($item['quantity'] > $product->quantity) {
                // Rollback and return error
                DB::rollBack();
                return back()->withErrors(['items' => 'Not enough stock for '.$product->name]);
            }

            // Deduct stock
            $product->quantity -= $item['quantity'];
            $product->save();

            $line_total = $product->price * $item['quantity'];
            $total += $line_total;

            // Create invoice item
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $product->id,
                'quantity'   => $item['quantity'],
                'price'      => $product->price,
                'total'      => $line_total,
            ]);
        }

        // Update total
        $invoice->update(['total' => $total]);

        DB::commit();

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Something went wrong: '.$e->getMessage()]);
    }
}


    public function show(Invoice $invoice)
    {
        $invoice->load('items.product');
        return view('invoices.show', compact('invoice'));
    }

    // Generate PDF
    public function generatePDF(Invoice $invoice)
    {
        $invoice->load('items.product');
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
        return $pdf->stream('invoice-'.$invoice->id.'.pdf');
    }
}
