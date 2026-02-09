<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Add Supplier</h2>
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

            <form action="{{ route('suppliers.store') }}" method="POST">
                @csrf

                <label class="block mb-2 font-semibold">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border px-3 py-2 rounded mb-4">

                <label class="block mb-2 font-semibold">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border px-3 py-2 rounded mb-4">

                <label class="block mb-2 font-semibold">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border px-3 py-2 rounded mb-4">

                <label class="block mb-2 font-semibold">Address</label>
                <textarea name="address" class="w-full border px-3 py-2 rounded mb-4">{{ old('address') }}</textarea>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Supplier</button>
            </form>
        </div>
    </div>
</x-app-layout>
