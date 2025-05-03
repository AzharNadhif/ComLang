<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;

class KeranjangController extends Controller
{
    // Menampilkan isi keranjang user
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login.form')->with('error', 'Silakan login terlebih dahulu.');
        }

        $keranjang = Keranjang::with('produk')->where('id_user', session('user_id'))->get();
        return view('keranjang.index', compact('keranjang'));
    }

    // Menambahkan produk ke keranjang
    public function tambah($id_produk)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login.form')->with('error', 'Silakan login terlebih dahulu.');
        }

        $existing = Keranjang::where('id_user', session('user_id'))
            ->where('id_produk', $id_produk)
            ->first();

        if (!$existing) {
            Keranjang::create([
                'id_user' => session('user_id'),
                'id_produk' => $id_produk,
            ]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }



    // Menghapus produk dari keranjang
    public function hapus($id)
    {
        $keranjang = Keranjang::findOrFail($id);

        // Pastikan hanya user terkait yang bisa hapus
        if ($keranjang->id_user != session('user_id')) {
            return back()->with('error', 'Akses ditolak.');
        }

        $keranjang->delete();
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
