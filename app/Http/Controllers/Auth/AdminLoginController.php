<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login'); // Buat view ini di langkah berikutnya
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole('admin')) { // Pastikan user memiliki role admin
                return redirect('/admin/dashboard');
            }

            Auth::logout(); // Logout jika bukan admin
            return back()->withErrors(['email' => 'Akun ini bukan admin']);
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }
}

