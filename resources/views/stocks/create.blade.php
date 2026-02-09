<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Add Stock</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">

            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-2 mb-2 rounded">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('stocks.store') }}" method="POST">
                @csrf

                <label class="block mb-2 font-semibold">Product</label>
                <select name="product_id" class="w-full border px-3 py-2 rounded mb-4">
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->quantity }} in stock)</option>
                    @endforeach
                </select>

                <label class="block mb-2 font-semibold">Type</label>
                <select name="type" class="w-full border px-3 py-2 rounded mb-4">
                    <option value="in">Stock In</option>
                    <option value="out">Stock Out</option>
                </select>

                <label class="block mb-2 font-semibold">Quantity</label>
                <input type="number" name="quantity" min="1" class="w-full border px-3 py-2 rounded mb-4">

                <label class="block mb-2 font-semibold">Note</label>
                <textarea name="note" class="w-full border px-3 py-2 rounded mb-4"></textarea>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Stock</button>
            </form>
        </div>
    </div>
</x-app-layout>
