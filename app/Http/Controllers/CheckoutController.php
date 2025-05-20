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
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    
    // Langkah 1: Form penerima
    public function form($id_produk)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login.form')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }

        $produk = Produk::findOrFail($id_produk);
        
        // Validasi stok produk
        if ($produk->stok <= 0) {
            return redirect()->back()->with('error', 'Stok produk tidak tersedia.');
        }
        
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
        
        // Validasi stok sekali lagi sebagai pengaman
        if ($produk->stok <= 0) {
            return redirect()->back()->with('error', 'Stok produk tidak tersedia.');
        }

        $pesanan = Pesanan::create([
            'id_user' => session('user_id'),
            'id_produk' => $produk->id_produk,
            'id_status' => 1, // Menunggu Konfirmasi
            'total' => $produk->harga,
            'tanggal_pesanan' => now(),
            'alamat' => $request->alamat,
            'nama_penerima' => $request->nama,
            'whatsapp' => $request->whatsapp,
            'kode_pos' => $request->kode_pos,
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

    // Simpan bukti bayar dan kurangi stok
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

        // Gunakan transaksi database untuk memastikan konsistensi data
        DB::beginTransaction();
        
        try {
            // Cari produk dan kurangi stok
            $produk = Produk::findOrFail($pesanan->id_produk);
            
            // Cek stok sekali lagi sebelum mengurangi
            if ($produk->stok <= 0) {
                throw new \Exception('Stok produk tidak tersedia.');
            }
            
            // Kurangi stok
            $produk->stok = $produk->stok - 1;
            $produk->save();

            // Upload bukti pembayaran
            $file = $request->file('bukti_bayar');
            $namaFile = 'bukti_transfer_' . $pesanan->id_pesanan . '.' . $file->getClientOriginalExtension();
            $path = 'images/bukti_bayar/' . $namaFile;
            $file->move(public_path('images/bukti_bayar'), $namaFile);
            
            // Simpan data pembayaran
            Pembayaran::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'jumlah_bayar' => $pesanan->total,
                'bukti_bayar' => $path,
            ]);
            
            // Commit transaksi jika semua berhasil
            DB::commit();
            
            return redirect()->route('user.orders')->with('success', 'Pembayaran berhasil diunggah dan stok produk telah diperbarui!');
            
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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

        // Dapatkan semua item keranjang
        $items = Keranjang::with('produk')->where('id_user', $id_user)->get();
        $totalPesanan = $items->sum(fn($item) => $item->produk->harga);
        
        // Gunakan transaksi database
        DB::beginTransaction();
        
        try {
            // Validasi stok semua produk terlebih dahulu
            foreach ($items as $item) {
                $produk = Produk::findOrFail($item->id_produk);
                if ($produk->stok <= 0) {
                    throw new \Exception("Produk '{$produk->nama_produk}' telah habis stok.");
                }
            }
            
            // Proses upload bukti pembayaran
            $file = $request->file('bukti_pembayaran');
            $filename = 'bukti_transfer_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/bukti_bayar'), $filename);
            $buktiPath = 'images/bukti_bayar/' . $filename;
            
            // Buat pesanan utama
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
            
            // Tambahkan detail produk dan kurangi stok
            foreach ($items as $item) {
                // Tambahkan ke tabel pesanan_detail
                PesananDetail::create([
                    'id_pesanan' => $pesanan->id_pesanan,
                    'id_produk' => $item->id_produk,
                ]);
                
                // Kurangi stok produk
                $produk = Produk::findOrFail($item->id_produk);
                $produk->stok = $produk->stok - 1;
                $produk->save();
            }
            
            // Simpan bukti pembayaran
            Pembayaran::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'jumlah_bayar' => $totalPesanan,
                'bukti_bayar' => $buktiPath,
            ]);
            
            // Kosongkan keranjang
            Keranjang::where('id_user', $id_user)->delete();
            session()->forget('checkout_cart_pengiriman');
            
            // Commit transaksi jika semua berhasil
            DB::commit();
            
            return redirect()->route('user.orders')->with('success', 'Pesanan berhasil dibuat dan stok produk telah diperbarui.');
            
        } catch (\Exception $e) {
            // Rollback jika terjadi error
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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