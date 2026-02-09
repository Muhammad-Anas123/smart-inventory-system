<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Invoice #{{ $invoice->id }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
            <h3 class="font-bold mb-2">Customer: {{ $invoice->customer_name }}</h3>
            <h3 class="font-bold mb-4">Date: {{ $invoice->created_at->format('d-m-Y') }}</h3>

            <table class="min-w-full bg-white mb-4">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Product</th>
                        <th class="px-4 py-2 border">Quantity</th>
                        <th class="px-4 py-2 border">Price</th>
                        <th class="px-4 py-2 border">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->items as $item)
                        <tr>
                            <td class="px-4 py-2 border">{{ $item->product->name }}</td>
                            <td class="px-4 py-2 border">{{ $item->quantity }}</td>
                            <td class="px-4 py-2 border">{{ $item->price }}</td>
                            <td class="px-4 py-2 border">{{ $item->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3 class="font-bold text-right">Total: {{ $invoice->total }}</h3>
        </div>
    </div>
</x-app-layout>
