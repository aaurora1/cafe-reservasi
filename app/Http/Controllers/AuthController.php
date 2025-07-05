<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.userlogin');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->route('reservasi.form'); // arahkan ke form reservasi
    }

    return back()->with('error', 'Email atau password salah.');
}

    public function showRegisterForm()
    {
        return view('login.usersignup');
    }

   public function register(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    // Simpan user ke database
    User::create([
        'username' => $request->username, 
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
}



    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
