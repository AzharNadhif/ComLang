<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserProfileController extends Controller
{
    public function profile()
    {
        $user = User::findOrFail(session('user_id'));

        return view('user.profile', compact('user'));
    }

    public function editForm()
    {
        $user = User::findOrFail(session('user_id'));

        return view('user.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'notelp' => 'required|string|max:20',
            'email' => 'required|email',
        ]);

        $user = User::findOrFail(session('user_id'));
        $user->update($request->only('nama', 'notelp', 'email'));

        return redirect()->route('user.profile')->with('success', 'Profile berhasil diperbarui.');
    }

    public function riwayatPesanan()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login.form');
        }

        $pesanans = Pesanan::with(['status', 'produk', 'user'])->where('id_user', session('user_id'))->orderBy('tanggal_pesanan', 'desc')->get();

        return view('user.orders', compact('pesanans'));
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
