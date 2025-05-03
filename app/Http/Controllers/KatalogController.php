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
        $produks = Produk::with('kategori')->get();
        $kategoriCounts = Kategori::withCount('products')->get();
        $totalProduk = $produks->count(); // <-- Tambahkan ini
        return view('shop', compact('produks', 'kategoriCounts', 'totalProduk'));
    }
    
    public function filterByKategori($id_kategori)
    {
        $produks = Produk::with('kategori')->where('id_kategori', $id_kategori)->get();

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
        $produks = Produk::with('kategori')->get();

        return response()->json([
            'data' => $produks
        ]);
    }


}
