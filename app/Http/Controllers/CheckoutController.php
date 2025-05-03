<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    
    // Langkah 1: Form penerima
    public function form($id_produk)
    {
        if (!session('user_logged_in')) {
        return redirect()->route('user.login.form')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }

        $produk = Produk::findOrFail($id_produk);
        return view('checkout.form', compact('produk'));
    }

    // Simpan data pesanan lalu redirect ke halaman upload
    public function simpanPesanan(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login.form')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }

        $request->validate([
            'alamat' => 'required|string',
            'nama' => 'required|string',
            'whatsapp' => 'required|string',
            'kode_pos' => 'required|string',
            'id_produk' => 'required|exists:produk,id_produk',
        ]);

        $produk = Produk::findOrFail($request->id_produk);

        $pesanan = Pesanan::create([
            'id_user' => session('user_id'), // <<< pakai session
            'id_produk' => $produk->id_produk, // <<< simpan produk juga
            'id_status' => 1, // Menunggu Konfirmasi
            'total' => $produk->harga,
            'tanggal_pesanan' => now(),
            'alamat' => $request->alamat,
            'nama_penerima' => $request->nama, // <<< kalau kamu mau pakai ini
            'whatsapp' => $request->whatsapp,  // <<< simpan no WA
            'kode_pos' => $request->kode_pos,  // <<< simpan kode pos
        ]);

        return redirect()->route('checkout.upload', $pesanan->id_pesanan);
    }


    // Langkah 2: Form upload bukti
    public function uploadBukti($id_pesanan)
    {
        if (!session('user_logged_in')) {
        return redirect()->route('user.login.form')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }

        $pesanan = Pesanan::with('pembayaran')->findOrFail($id_pesanan);
        return view('checkout.upload', compact('pesanan'));
    }

    // Simpan bukti bayar
    public function simpanBukti(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login.form')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }
        
        $request->validate([
            'id_pesanan' => 'required|exists:pesanan,id_pesanan',
            'bukti_bayar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pesanan = Pesanan::findOrFail($request->id_pesanan);

        $file = $request->file('bukti_bayar');
        $namaFile = 'bukti_transfer_' . $pesanan->id_pesanan . '.' . $file->getClientOriginalExtension();
        $path = 'images/bukti_bayar/' . $namaFile;
        $file->move(public_path('images/bukti_bayar'), $namaFile);


        Pembayaran::create([
            'id_pesanan' => $pesanan->id_pesanan,
            'jumlah_bayar' => $pesanan->total,
            'bukti_bayar' => $path,
        ]);

        return redirect()->route('user.orders')->with('success', 'Pembayaran berhasil diunggah!');
    }

    public function prosesCart(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login.form')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pengiriman = session('checkout_cart_pengiriman');
        $id_user = session('user_id');

        // Proses upload ke public/images/bukti_bayar/
        $file = $request->file('bukti_pembayaran');
        $filename = 'bukti_transfer_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/bukti_bayar'), $filename);
        $buktiPath = 'images/bukti_bayar/' . $filename;

        // Hitung total semua item keranjang
        $items = Keranjang::with('produk')->where('id_user', $id_user)->get();
        $totalPesanan = $items->sum(fn($item) => $item->produk->harga);

        // Buat satu entry pesanan utama
        $pesanan = Pesanan::create([
            'id_user' => $id_user,
            'id_status' => 1,
            'total' => $totalPesanan,
            'tanggal_pesanan' => now(),
            'alamat' => $pengiriman['alamat'],
            'nama_penerima' => $pengiriman['nama'],
            'whatsapp' => $pengiriman['whatsapp'],
            'kode_pos' => $pengiriman['kode_pos'],
        ]);

        // Tambahkan detail produk ke tabel pesanan_detail
        foreach ($items as $item) {
            \App\Models\PesananDetail::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'id_produk' => $item->id_produk,
            ]);
        }

        // Simpan bukti pembayaran
        Pembayaran::create([
            'id_pesanan' => $pesanan->id_pesanan,
            'jumlah_bayar' => $totalPesanan,
            'bukti_bayar' => $buktiPath,
        ]);

        // Kosongkan keranjang & session
        Keranjang::where('id_user', $id_user)->delete();
        session()->forget('checkout_cart_pengiriman');

        return redirect()->route('user.orders')->with('success', 'Pesanan berhasil dibuat.');
    }





    public function cartForm()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login.form')->with('error', 'Silakan login terlebih dahulu.');
        }

        $keranjang = Keranjang::with('produk')
            ->where('id_user', session('user_id'))
            ->get();

        $subtotal = $keranjang->sum(fn($item) => $item->produk->harga);

        return view('checkout.cart-form', compact('keranjang', 'subtotal'));
    }

    public function cartUploadForm(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login.form')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Simpan data pengiriman sementara di session
        session([
            'checkout_cart_pengiriman' => [
                'nama' => $request->nama,
                'whatsapp' => $request->whatsapp,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'kode_pos' => $request->kode_pos,
            ]
        ]);

        return view('checkout.cart-upload');
    }





}
