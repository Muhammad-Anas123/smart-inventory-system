<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Create Invoice</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-2 mb-2 rounded">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('invoices.store') }}" method="POST">
                @csrf

                <label class="block mb-2 font-semibold">Customer Name</label>
                <input type="text" name="customer_name" value="{{ old('customer_name') }}" class="w-full border px-3 py-2 rounded mb-4">

                <h3 class="font-bold mb-2">Products</h3>
                <div id="items">
                    <div class="flex gap-2 mb-2 item-row">
                        <select name="items[0][product_id]" class="border px-2 py-1 rounded w-2/3">
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->quantity }} in stock)</option>
                            @endforeach
                        </select>
                        <input type="number" name="items[0][quantity]" class="border px-2 py-1 rounded w-1/3" placeholder="Quantity" min="1">
                        <button type="button" class="remove-btn bg-red-500 text-white px-2 rounded">X</button>
                    </div>
                </div>

                <button type="button" id="addItem" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Add Product</button>

                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create Invoice</button>
            </form>
        </div>
    </div>

    <script>
        let count = 1;
        document.getElementById('addItem').addEventListener('click', function() {
            const container = document.getElementById('items');
            const div = document.createElement('div');
            div.classList.add('flex', 'gap-2', 'mb-2', 'item-row');
            div.innerHTML = `
                <select name="items[${count}][product_id]" class="border px-2 py-1 rounded w-2/3">
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->quantity }} in stock)</option>
                    @endforeach
                </select>
                <input type="number" name="items[${count}][quantity]" class="border px-2 py-1 rounded w-1/3" placeholder="Quantity" min="1">
                <button type="button" class="remove-btn bg-red-500 text-white px-2 rounded">X</button>
            `;
            container.appendChild(div);
            count++;
        });

        document.addEventListener('click', function(e){
            if(e.target.classList.contains('remove-btn')){
                e.target.parentElement.remove();
            }
        });
    </script>
</x-app-layout>
