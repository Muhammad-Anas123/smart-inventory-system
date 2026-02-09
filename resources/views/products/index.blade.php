<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Products</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between mb-4">
                <h3 class="text-lg font-bold">All Products</h3>
                <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Product</a>
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
                        <th class="px-4 py-2 border">Category</th>
                        <th class="px-4 py-2 border">Supplier</th>
                        <th class="px-4 py-2 border">SKU</th>
                        <th class="px-4 py-2 border">Price</th>
                        <th class="px-4 py-2 border">Quantity</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="px-4 py-2 border">{{ $product->id }}</td>
                            <td class="px-4 py-2 border">{{ $product->name }}</td>
                            <td class="px-4 py-2 border">{{ $product->category->name }}</td>
                            <td class="px-4 py-2 border">{{ $product->supplier->name ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $product->sku }}</td>
                            <td class="px-4 py-2 border">{{ $product->price }}</td>
                            <td class="px-4 py-2 border">{{ $product->quantity }}</td>
                            <td class="px-4 py-2 border flex gap-2">
                                <a href="{{ route('products.edit', $product) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
