<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Produk;

class HomeController extends Controller
{
    public function index()
    {
        $userId = session('user_id'); // atau auth()->id() jika pakai Auth

        // Ambil kategori dari produk yang pernah dibeli user
        $kategoriTerbeli = Pesanan::with('produk.kategori')
            ->where('id_user', $userId)
            ->get()
            ->pluck('produk.kategori.id_kategori')
            ->unique()
            ->filter()
            ->toArray();

        // Ambil produk berdasarkan kategori tersebut (random 10)
        $rekomendasi = Produk::whereIn('id_kategori', $kategoriTerbeli)
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view('home', compact('rekomendasi'));
    }

}
