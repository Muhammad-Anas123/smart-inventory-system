<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $invoice->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background: #f0f0f0; }
        .text-right { text-align: right; }
        h2, h3 { margin: 0; }
    </style>
</head>
<body>
    <h2>Invoice #{{ $invoice->id }}</h2>
    <h3>Customer: {{ $invoice->customer_name }}</h3>
    <h3>Date: {{ $invoice->created_at->format('d-m-Y') }}</h3>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="text-right">Grand Total: {{ number_format($invoice->total, 2) }}</h3>
</body>
</html>
