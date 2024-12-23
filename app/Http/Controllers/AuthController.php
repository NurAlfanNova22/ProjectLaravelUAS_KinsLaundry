<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirect setelah berhasil login
            return redirect()->route('dashboard');
        }

        // Jika gagal
        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout()
    {
        Auth::logout(); // Logout pengguna
        return redirect('/'); // Redirect ke halaman utama atau login
    }

    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan Anda memiliki view 'auth/login.blade.php'
    }
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Simpan user ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // Redirect ke halaman dashboard setelah registrasi
        return redirect()->back()->with('success', 'Registrasi berhasil! Silakan login.');
    }
}