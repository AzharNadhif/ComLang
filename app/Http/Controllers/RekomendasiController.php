<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Produk;

class RekomendasiController extends Controller
{
    public function index()
    {
        $userId = session('user_id');

        // Ambil kategori dari produk-produk yang pernah dibeli user
        $kategoriIds = Pesanan::with('produk')
            ->where('id_user', $userId)
            ->get()
            ->pluck('produk.id_kategori')
            ->unique();

        // Ambil produk lain yang satu kategori
        $rekomendasi = Produk::whereIn('id_kategori', $kategoriIds)->take(3)->get();

        return view('index', compact('rekomendasi'));
    }
}
