<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Pembayaran;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Pembayaran::sum('jumlah_bayar');
        $productsSold = Pesanan::count();
        $productsInStock = Produk::sum('stok');

        $recentOrders = Pesanan::with('user', 'pembayaran')
                        ->latest('tanggal_pesanan')
                        ->take(5)
                        ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'productsSold',
            'productsInStock',
            'recentOrders'
        ));
    }
}
