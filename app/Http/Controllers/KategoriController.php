<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori', compact('kategori')); // Perbaikan variabel dari 'categories' menjadi 'kategori'
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'kategori' => 'required|string|max:255' // Sesuaikan dengan nama field di model
            ]);

            Kategori::create([
                'kategori' => $request->kategori
            ]);

            return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan kategori! ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'kategori' => 'required|string|max:255'
            ]);

            $kategori = Kategori::findOrFail($id);
            $kategori->kategori = $request->kategori;
            $kategori->save();

            return redirect()->back()->with('success', 'Kategori berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui kategori! ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            
            // Opsional: Periksa apakah kategori memiliki produk terkait
            if ($kategori->products->count() > 0) {
                return redirect()->back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk terkait!');
            }
            
            $kategori->delete();
            return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus kategori! ' . $e->getMessage());
        }
    }
}