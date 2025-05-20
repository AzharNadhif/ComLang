<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Pesanan;
use App\Models\Pembayaran;

class KatalogController extends Controller
{
    public function index()
    {
        // Ambil produk dengan stok > 0
        $produks = Produk::with('kategori')
            ->where('stok', '>', 0)
            ->get();

        // Hitung jumlah produk per kategori dengan stok > 0
        $kategoriCounts = Kategori::withCount(['products' => function ($query) {
            $query->where('stok', '>', 0);
        }])->get();

        $totalProduk = $produks->count();

        return view('shop', compact('produks', 'kategoriCounts', 'totalProduk'));
    }

    public function filterByKategori($id_kategori)
    {
        // Filter berdasarkan kategori dan stok > 0
        $produks = Produk::with('kategori')
            ->where('id_kategori', $id_kategori)
            ->where('stok', '>', 0)
            ->get();

        return response()->json([
            'data' => $produks
        ]);
    }

    public function show($id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);
        return view('partials.detail-produk', compact('produk'));
    }

    public function allProduk()
    {
        // Ambil semua produk dengan stok > 0
        $produks = Produk::with('kategori')
            ->where('stok', '>', 0)
            ->get();

        return response()->json([
            'data' => $produks
        ]);
    }
}
