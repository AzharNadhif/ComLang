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
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }
    
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

    // Simpan data pesanan lalu redirect ke halaman pembayaran Midtrans
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

        // Buat pesanan dengan status pending
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

        // Buat Snap Token untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $pesanan->id_pesanan . '-' . time(),
                'gross_amount' => $produk->harga,
            ],
            'customer_details' => [
                'first_name' => $request->nama,
                'phone' => $request->whatsapp,
            ],
            'item_details' => [
                [
                    'id' => $produk->id_produk,
                    'price' => $produk->harga,
                    'quantity' => 1,
                    'name' => $produk->nama_produk
                ]
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            
            // Simpan snap token ke database pembayaran
            Pembayaran::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'jumlah_bayar' => $pesanan->total,
                'snap_token' => $snapToken,
                'status' => 'pending',
            ]);

            return view('checkout.payment', compact('pesanan', 'snapToken'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat pembayaran: ' . $e->getMessage());
        }
    }

    // Proses checkout dari keranjang
    public function prosesCart(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login.form')->with('error', 'Silakan login terlebih dahulu.');
        }

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
            
            // Tambahkan detail produk
            $itemDetails = [];
            foreach ($items as $item) {
                // Tambahkan ke tabel pesanan_detail
                PesananDetail::create([
                    'id_pesanan' => $pesanan->id_pesanan,
                    'id_produk' => $item->id_produk,
                ]);
                
                // Siapkan item details untuk Midtrans
                $itemDetails[] = [
                    'id' => $item->id_produk,
                    'price' => $item->produk->harga,
                    'quantity' => 1,
                    'name' => $item->produk->nama_produk
                ];
            }
            
            // Parameter untuk Midtrans
            $params = [
                'transaction_details' => [
                    'order_id' => 'CART-ORDER-' . $pesanan->id_pesanan . '-' . time(),
                    'gross_amount' => $totalPesanan,
                ],
                'customer_details' => [
                    'first_name' => $pengiriman['nama'],
                    'phone' => $pengiriman['whatsapp'],
                ],
                'item_details' => $itemDetails,
            ];

            $snapToken = Snap::getSnapToken($params);
            
            // Simpan pembayaran
            Pembayaran::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'jumlah_bayar' => $totalPesanan,
                'snap_token' => $snapToken,
                'status' => 'pending',
            ]);
            
            // Commit transaksi
            DB::commit();
            
            // Kosongkan keranjang setelah berhasil
            Keranjang::where('id_user', $id_user)->delete();
            session()->forget('checkout_cart_pengiriman');
            
            return view('checkout.payment', compact('pesanan', 'snapToken'));
            
        } catch (\Exception $e) {
            // Rollback jika terjadi error
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Callback dari Midtrans
    public function callback(Request $request)
    {
        try {
            $notification = new Notification();
            
            $orderId = $notification->order_id;
            $statusCode = $notification->status_code;
            $grossAmount = $notification->gross_amount;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status ?? null;
            
            // Cari pembayaran berdasarkan order_id
            $pembayaran = Pembayaran::whereHas('pesanan', function($query) use ($orderId) {
                $query->whereRaw("CONCAT('ORDER-', id_pesanan, '-', UNIX_TIMESTAMP(created_at)) = ? OR CONCAT('CART-ORDER-', id_pesanan, '-', UNIX_TIMESTAMP(created_at)) = ?", [$orderId, $orderId]);
            })->first();
            
            if (!$pembayaran) {
                return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
            }
            
            $pesanan = $pembayaran->pesanan;
            
            DB::beginTransaction();
            
            try {
                if ($transactionStatus == 'capture') {
                    if ($fraudStatus == 'challenge') {
                        $pembayaran->status = 'challenge';
                        $pesanan->id_status = 1; // Menunggu konfirmasi
                    } else if ($fraudStatus == 'accept') {
                        $pembayaran->status = 'success';
                        $pesanan->id_status = 2; // Dikonfirmasi
                        $this->reduceStock($pesanan);
                    }
                } else if ($transactionStatus == 'settlement') {
                    $pembayaran->status = 'success';
                    $pesanan->id_status = 2; // Dikonfirmasi
                    $this->reduceStock($pesanan);
                } else if ($transactionStatus == 'pending') {
                    $pembayaran->status = 'pending';
                    $pesanan->id_status = 1; // Menunggu konfirmasi
                } else if ($transactionStatus == 'deny') {
                    $pembayaran->status = 'failed';
                    $pesanan->id_status = 4; // Dibatalkan
                } else if ($transactionStatus == 'expire') {
                    $pembayaran->status = 'expired';
                    $pesanan->id_status = 4; // Dibatalkan
                } else if ($transactionStatus == 'cancel') {
                    $pembayaran->status = 'cancelled';
                    $pesanan->id_status = 4; // Dibatalkan
                }
                
                $pembayaran->save();
                $pesanan->save();
                
                DB::commit();
                
                return response()->json(['status' => 'success']);
                
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
            
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    
    // Helper function untuk mengurangi stok
    private function reduceStock($pesanan)
    {
        if ($pesanan->id_produk) {
            // Single product order
            $produk = Produk::find($pesanan->id_produk);
            if ($produk && $produk->stok > 0) {
                $produk->stok = $produk->stok - 1;
                $produk->save();
            }
        } else {
            // Cart order - reduce stock for all items
            $details = PesananDetail::where('id_pesanan', $pesanan->id_pesanan)->get();
            foreach ($details as $detail) {
                $produk = Produk::find($detail->id_produk);
                if ($produk && $produk->stok > 0) {
                    $produk->stok = $produk->stok - 1;
                    $produk->save();
                }
            }
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

        $request->validate([
            'nama' => 'required|string',
            'whatsapp' => 'required|string',
            'alamat' => 'required|string',
            'kode_pos' => 'required|string',
        ]);

        // Simpan data pengiriman sementara di session
        session([
            'checkout_cart_pengiriman' => [
                'nama' => $request->nama,
                'whatsapp' => $request->whatsapp,
                'alamat' => $request->alamat,
                'kode_pos' => $request->kode_pos,
            ]
        ]);

        // Langsung proses ke Midtrans
        return $this->prosesCart($request);
    }
    
    // Halaman sukses setelah pembayaran
    public function success($id_pesanan)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login.form')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        $pesanan = Pesanan::with('pembayaran')->findOrFail($id_pesanan);
        
        return view('checkout.success', compact('pesanan'));
    }
}