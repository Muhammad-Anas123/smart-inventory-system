<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Suppliers</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between mb-4">
                <h3 class="text-lg font-bold">All Suppliers</h3>
                <a href="{{ route('suppliers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Supplier</a>
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
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Phone</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Address</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier)
                        <tr>
                            <td class="px-4 py-2 border">{{ $supplier->id }}</td>
                            <td class="px-4 py-2 border">{{ $supplier->name }}</td>
                            <td class="px-4 py-2 border">{{ $supplier->phone }}</td>
                            <td class="px-4 py-2 border">{{ $supplier->email }}</td>
                            <td class="px-4 py-2 border">{{ $supplier->address }}</td>
                            <td class="px-4 py-2 border flex gap-2">
                                <a href="{{ route('suppliers.edit', $supplier) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                                <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $suppliers->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
