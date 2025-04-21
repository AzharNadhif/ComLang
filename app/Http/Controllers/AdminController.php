<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan daftar admin
    public function index()
    {
        $admins = Admin::all();
        return view('admin.accounts', compact('admins'));
    }

    // Menampilkan form untuk menambah admin
    public function create()
    {
        return view('admin.accounts.create');
    }

   // Menyimpan admin baru
    public function store(Request $request)
    {
        try {
            // Validasi
            $request->validate([
                'username' => 'required|unique:admin|max:255',
                'password' => 'required|min:8',
            ], [
                'username.required' => 'Username wajib diisi.',
                'username.unique' => 'Username sudah terpakai, coba username lain.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password harus memiliki minimal 8 karakter.',
            ]);

            Admin::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
            ]);

            // Menggunakan session untuk mengirimkan informasi sukses
            session()->flash('success', 'Admin berhasil ditambahkan!');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menambahkan admin! ' . $e->getMessage());
        }
        
        return redirect()->route('admin.accounts');
    }


    // Memperbarui data admin
    public function update(Request $request, $id_admin)
    {
        try {
            // Validasi input
            $request->validate([
                'username' => 'required|max:255|unique:admin,username,' . $id_admin . ',id_admin',
                'password' => 'nullable|min:8',
            ], [
                'username.required' => 'Username wajib diisi.',
                'username.unique' => 'Username sudah terpakai, coba username lain.',
                'password.min' => 'Password harus memiliki minimal 8 karakter.',
            ]);

            // Ambil data admin berdasarkan ID
            $admin = Admin::findOrFail($id_admin);
            
            // Update username
            $admin->username = $request->username;

            // Jika password diisi, update password
            if ($request->filled('password')) {
                $admin->password = bcrypt($request->password);
            }

            // Simpan perubahan
            $admin->save();

            // Flash message sukses
            session()->flash('success', 'Admin berhasil diperbarui!');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal memperbarui admin! ' . $e->getMessage());
        }
        
        return redirect()->route('admin.accounts');
    }

}
