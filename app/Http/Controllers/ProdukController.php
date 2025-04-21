<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        $kategori = Kategori::all();
        return view('admin.produk', compact('produk', 'kategori'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_produk' => 'required|string|max:255',
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'deskripsi' => 'nullable|string',
                'harga' => 'required|numeric',
                'id_kategori' => 'required|exists:kategori,id_kategori',
                'stok' => 'required|integer|min:0'
            ]);

            // Upload gambar
            $gambar = $request->file('gambar');
            $namaGambar = Str::slug($request->nama_produk) . '-' . time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('images/produk'), $namaGambar);

            Produk::create([
                'nama_produk' => $request->nama_produk,
                'gambar' => $namaGambar,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'id_kategori' => $request->id_kategori,
                'stok' => $request->stok
            ]);

            return redirect()->route('admin.produk')->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan produk! ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_produk' => 'required|string|max:255',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'deskripsi' => 'nullable|string',
                'harga' => 'required|numeric',
                'id_kategori' => 'required|exists:kategori,id_kategori',
                'stok' => 'required|integer|min:0'
            ]);

            $produk = Produk::findOrFail($id);
            
            // Update data produk
            $produk->nama_produk = $request->nama_produk;
            $produk->deskripsi = $request->deskripsi;
            $produk->harga = $request->harga;
            $produk->id_kategori = $request->id_kategori;
            $produk->stok = $request->stok;
            
            // Jika ada gambar baru
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($produk->gambar && file_exists(public_path('images/produk/' . $produk->gambar))) {
                    unlink(public_path('images/produk/' . $produk->gambar));
                }
                
                // Upload gambar baru
                $gambar = $request->file('gambar');
                $namaGambar = Str::slug($request->nama_produk) . '-' . time() . '.' . $gambar->getClientOriginalExtension();
                $gambar->move(public_path('images/produk'), $namaGambar);
                
                $produk->gambar = $namaGambar;
            }
            
            $produk->save();

            return redirect()->route('admin.produk')->with('success', 'Produk berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui produk! ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $produk = Produk::findOrFail($id);
            
            // Hapus gambar jika ada
            if ($produk->gambar && file_exists(public_path('images/produk/' . $produk->gambar))) {
                unlink(public_path('images/produk/' . $produk->gambar));
            }
            
            $produk->delete();
            
            return redirect()->route('admin.produk')->with('success', 'Produk berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus produk! ' . $e->getMessage());
        }
    }
}