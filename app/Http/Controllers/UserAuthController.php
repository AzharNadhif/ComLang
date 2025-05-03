<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function formLogin()
    {
        return view('auth.user-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        // Periksa user ada dan password cocok
        if ($user && Hash::check($credentials['password'], $user->password)) {
            session([
                'user_logged_in' => true,
                'user_id' => $user->id_user,
            ]);
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout()
    {
        session()->forget(['user_logged_in', 'user_id']);
        session()->flush(); // optional: sekalian hapus semua session
        return redirect()->route('home');
    }

    public function formRegister()
    {
        return view('auth.user-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'notelp' => 'required|string|max:20',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'notelp' => $request->notelp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Setelah register langsung login manual
        session([
            'user_logged_in' => true,
            'user_id' => $user->id_user,
        ]);

        return redirect()->route('home');
    }
}
