<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smart Inventory')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="flex h-screen bg-gray-100" x-data="{ sidebarOpen: false }">

    <!-- Mobile overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
         class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed md:relative z-40 w-64 bg-gray-800 text-white h-full transition-transform transform md:translate-x-0">

        <!-- Sidebar header -->
        <div class="p-6 text-xl font-bold border-b border-gray-700 flex justify-between items-center">
            Smart Inventory
            <button @click="sidebarOpen = false" class="md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Sidebar menu -->
        <nav class="mt-6">
            <ul class="space-y-1">

                <!-- Dashboard -->
                <li class="{{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }} px-4 py-2 hover:bg-gray-700 rounded">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        Dashboard
                    </a>
                </li>

                <!-- Products with collapsible submenu -->
                <li x-data="{ open: {{ request()->routeIs('products.*') ? 'true' : 'false' }} }"
                    class="px-4 py-2 hover:bg-gray-700 rounded">
                    <button @click="open = !open" class="flex items-center gap-2 w-full text-left">
                        Products
                        <svg :class="open ? 'rotate-90' : ''" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-auto transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <!-- Submenu -->
                    <ul x-show="open" x-collapse class="mt-2 ml-4 space-y-1 text-sm">
                        <li><a href="{{ route('products.index') }}" class="block px-2 py-1 hover:bg-gray-700 rounded">All Products</a></li>
                        <li><a href="{{ route('products.create') }}" class="block px-2 py-1 hover:bg-gray-700 rounded">Add Product</a></li>
                        <li><a href="{{ route('stocks.index') }}" class="block px-2 py-1 hover:bg-gray-700 rounded">Stock</a></li>
                    </ul>
                </li>

                <!-- Categories -->
                <li class="{{ request()->routeIs('categories.*') ? 'bg-gray-700' : '' }} px-4 py-2 hover:bg-gray-700 rounded">
                    <a href="{{ route('categories.index') }}" class="flex items-center gap-2">
                        Categories
                    </a>
                </li>

                <!-- Invoices -->
                <li class="{{ request()->routeIs('invoices.*') ? 'bg-gray-700' : '' }} px-4 py-2 hover:bg-gray-700 rounded">
                    <a href="{{ route('invoices.index') }}" class="flex items-center gap-2">
                        Invoices
                    </a>
                </li>

                <!-- Suppliers -->
                <li class="{{ request()->routeIs('suppliers.*') ? 'bg-gray-700' : '' }} px-4 py-2 hover:bg-gray-700 rounded">
                    <a href="{{ route('suppliers.index') }}" class="flex items-center gap-2">
                        Suppliers
                    </a>
                </li>

            </ul>
        </nav>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col md:ml-64">
        <!-- Header -->
        <header class="bg-white p-4 shadow flex justify-between items-center">
            {{ $header }}

            <!-- Default Jetstream user menu -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Profile -->
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>


                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </header>

        <!-- Page content -->
        <main class="flex-1 p-6 overflow-auto">
            {{ $slot }}
        </main>
    </div>

    <!-- Mobile toggle button on RIGHT -->
    <button @click="sidebarOpen = true"
            class="fixed top-4 right-4 z-50 bg-gray-800 text-white p-2 rounded md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>

</body>
</html>
