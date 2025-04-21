
@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">Dashboard</h2>
    <p class="text-gray-500 mb-6">Kelola data toko anda</p>

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded-xl shadow">
            <h4 class="text-sm text-gray-500">Total Penjualan</h4>
            <p class="text-xl font-bold text-green-600">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white p-4 rounded-xl shadow">
            <h4 class="text-sm text-gray-500">Produk Terjual</h4>
            <p class="text-xl font-bold">{{ $productsSold }}</p>
        </div>

        <div class="bg-white p-4 rounded-xl shadow">
            <h4 class="text-sm text-gray-500">Stok Produk</h4>
            <p class="text-xl font-bold">{{ $productsInStock }}</p>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-semibold text-lg mb-4">Pesanan Terbaru</h3>
        <ul>
            @foreach ($recentOrders as $order)
                <li class="flex justify-between items-center py-3 border-b">
                    <div>
                        <div class="font-medium">{{ $order->user->nama ?? 'Unknown' }}</div>
                        <div class="text-sm text-gray-500">{{ $order->user->email ?? '-' }}</div>
                    </div>
                    <div class="font-semibold text-green-600">
                        +Rp{{ number_format($order->pembayaran->jumlah_bayar ?? 0, 0, ',', '.') }}
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
