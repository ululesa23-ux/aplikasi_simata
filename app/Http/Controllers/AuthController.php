<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginApk(Request $request)
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

            // cek imei
            if ($user->imei !== $imei) {
                Auth::logout();
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Login gagal, IMEI tidak sesuai'
                ], 401);
            }

            // buat token API
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status'    => 'success',
                'message'   => 'Login berhasil',
                'access_token' => $token,
                'token_type'   => 'Bearer',
                'user'      => [
                    'id'       => $user->id,
                    'username' => $user->username,
                    'role'     => $user->role,
                    'unit_id'  => $user->unit_id,
                ]
            ]);
        }

        return response()->json([
            'status'  => 'error',
            'message' => 'Login gagal, user tidak ditemukan atau data salah'
        ], 401);
    }
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
