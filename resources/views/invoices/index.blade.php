<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Invoices</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between mb-4">
                <h3 class="text-lg font-bold">All Invoices</h3>
                <a href="{{ route('invoices.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create Invoice</a>
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
                        <th class="px-4 py-2 border">Customer</th>
                        <th class="px-4 py-2 border">Total</th>
                        <th class="px-4 py-2 border">Date</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td class="px-4 py-2 border">{{ $invoice->id }}</td>
                            <td class="px-4 py-2 border">{{ $invoice->customer_name }}</td>
                            <td class="px-4 py-2 border">{{ $invoice->total }}</td>
                            <td class="px-4 py-2 border">{{ $invoice->created_at->format('d-m-Y') }}</td>
                            <td class="px-4 py-2 border flex gap-2">
                                <a href="{{ route('invoices.show', $invoice) }}" class="bg-green-500 text-white px-2 py-1 rounded">View</a>
                                
                                <!-- PDF button inside the foreach -->
                                <a href="{{ route('invoices.pdf', $invoice) }}" target="_blank" class="bg-blue-500 text-white px-2 py-1 rounded">
                                    PDF
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $invoices->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
