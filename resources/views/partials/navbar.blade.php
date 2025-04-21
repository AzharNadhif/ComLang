<nav class="bg-white shadow px-6 py-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between relative">
        <!-- Logo -->
        <div class="absolute left-0 flex items-center">
            <a href="#" class="text-lg font-semibold">
                <i class="fas fa-store mr-1"></i>Comot Langsung
            </a>
        </div>

        <!-- Menu (centered) -->
        <div class="mx-auto flex gap-6">
            <a href="{{ route('admin') }}" class="font-medium {{ request()->routeIs('admin') ? 'text-blue-600' : '' }}">Dashboard</a>
            <a href="{{ route('admin.accounts') }}" class="font-medium {{ request()->routeIs('admin.accounts') ? 'text-blue-600' : '' }}">Admin</a>
            <a href="{{ route('admin.kategori') }}" class="font-medium {{ request()->routeIs('admin.kategori') ? 'text-blue-600' : '' }}">Categories</a>
            <a href="{{ route('admin.produk') }}" class="font-medium {{ request()->routeIs('admin.produk') ? 'text-blue-600' : '' }}">Products</a>
            <a href="{{ route('admin.status') }}" class="font-medium {{ request()->routeIs('admin.status') ? 'text-blue-600' : '' }}">Status</a>
            <a href="{{ route('admin.pesanan') }}" class="font-medium {{ request()->routeIs('admin.pesanan') ? 'text-blue-600' : '' }}">Orders</a>
            <a href="{{ route('admin.user') }}" class="font-medium {{ request()->routeIs('admin.user') ? 'text-blue-600' : '' }}">Customers</a>
        </div>        

        <!-- User Icon -->
        <div class="absolute right-0 flex items-center gap-4">
            <button class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-user-circle text-xl"></i>
            </button>
        </div>
    </div>
</nav>
