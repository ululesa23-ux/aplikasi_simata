<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'imei'     => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        $imei        = $request->imei;

        // cek user di database
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // // cek imei
            // if ($user->imei !== $imei) {
            //     Auth::logout();
            //     return redirect()->back()->withErrors(['imei' => 'IMEI tidak sesuai']);
            // }

            // redirect sesuai role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'tu':
                    return redirect()->route('tu.dashboard');
                case 'kabid':
                    return redirect()->route('kabid.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['role' => 'Role tidak dikenali']);
            }
        }

        return redirect()->back()->withErrors(['login_error' => 'Username atau password salah']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil logout');
    }
}
