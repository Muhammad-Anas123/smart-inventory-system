<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Add Product</h2>
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

            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <label class="block mb-2 font-semibold">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border px-3 py-2 rounded mb-4">

                <label class="block mb-2 font-semibold">Category</label>
                <select name="category_id" class="w-full border px-3 py-2 rounded mb-4">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <label class="block mb-2 font-semibold">Supplier</label>
                <select name="supplier_id" class="w-full border px-3 py-2 rounded mb-4">
                    <option value="">Select Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>

                <label class="block mb-2 font-semibold">SKU</label>
                <input type="text" name="sku" value="{{ old('sku') }}" class="w-full border px-3 py-2 rounded mb-4">

                <label class="block mb-2 font-semibold">Price</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full border px-3 py-2 rounded mb-4">

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Product</button>
            </form>
        </div>
    </div>
</x-app-layout>
