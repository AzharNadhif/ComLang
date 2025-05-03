<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.user', compact('user'));
    }

    public function profile()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login.form')->withErrors(['login' => 'Silakan login dahulu']);
        }

        $user = User::findOrFail(session('user_id'));
        return view('user.profile', compact('user'));
    }

    public function editProfile()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login.form');
        }

        $user = User::findOrFail(session('user_id'));
        return view('user.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login.form');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'notelp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        $user = User::findOrFail(session('user_id'));

        $user->nama = $request->nama;
        $user->notelp = $request->notelp;
        $user->email = $request->email;

        // Jika password baru diisi, update juga password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function riwayatPesanan()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login.form');
        }

        $pesanan = \App\Models\Pesanan::with(['detail.produk'])
        ->where('id_user', session('user_id'))
        ->orderBy('tanggal_pesanan', 'desc')
        ->get();


        return view('user.orders', compact('pesanan'));
    }

    public function hapusPesanan($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Hapus pembayaran terkait jika ada
        if ($pesanan->pembayaran) {
            Storage::disk('public')->delete($pesanan->pembayaran->bukti_bayar);
            $pesanan->pembayaran->delete();
        }

        $pesanan->delete();

        return redirect()->route('user.orders')->with('success', 'Pesanan berhasil dibatalkan.');
    }

}
