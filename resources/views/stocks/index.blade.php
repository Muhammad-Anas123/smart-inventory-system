<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Stock Logs</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between mb-4">
                <h3 class="text-lg font-bold">All Stock Logs</h3>
                <a href="{{ route('stocks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Stock</a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-2 rounded mb-2">
                    {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Product</th>
                        <th class="px-4 py-2 border">Type</th>
                        <th class="px-4 py-2 border">Quantity</th>
                        <th class="px-4 py-2 border">Note</th>
                        <th class="px-4 py-2 border">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                        <tr>
                            <td class="px-4 py-2 border">{{ $stock->id }}</td>
                            <td class="px-4 py-2 border">{{ $stock->product->name }}</td>
                            <td class="px-4 py-2 border">{{ ucfirst($stock->type) }}</td>
                            <td class="px-4 py-2 border">{{ $stock->quantity }}</td>
                            <td class="px-4 py-2 border">{{ $stock->note ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $stock->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $stocks->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
