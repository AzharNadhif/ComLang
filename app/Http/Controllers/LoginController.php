<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function show()
    {
        return view('admin.auth.login');
    }

    // Menangani proses login
    public function authenticate(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

       
        // Mencari admin berdasarkan username
        $admin = Admin::where('username', $request->username)->first();

        // Memeriksa apakah admin ditemukan dan password cocok
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Simpan session untuk autentikasi
            session(['admin_logged_in' => true, 'admin_id' => $admin->id_admin]);

            return redirect()->route('admin')->with('success', 'Login berhasil');
        } else {
            return back()->withErrors(['login_failed' => 'Username atau password salah']);
        }
    }

    // Menangani logout
    public function logout()
    {
        // Menghapus session login
        session()->forget(['admin_logged_in', 'admin_id']);

        return redirect()->route('login.show')->with('success', 'Logout berhasil');
    }
}
