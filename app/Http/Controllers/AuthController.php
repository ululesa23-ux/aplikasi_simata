<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ========== Show Login Form ==========
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // ========== Login User ==========
    public function login(Request $request)
    {
        \Log::debug('Login attempt', [
            'expectsJson' => $request->expectsJson(),
            'method' => $request->method(),
            'all' => $request->all()
        ]);

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        \Log::debug('User found', ['user' => $user ? $user->toArray() : null]);

        // SEMENTARA: Nonaktifkan pengecekan IMEI untuk testing login
        // TODO: Aktifkan kembali pengecekan IMEI setelah data IMEI di database diperbaiki
        if (!$user || !Hash::check($request->password, $user->password)) {
            \Log::debug('Login failed: invalid credentials', [
                'user_exists' => $user ? true : false,
                'password_check' => $user ? Hash::check($request->password, $user->password) : false,
                'input_password' => $request->password,
            ]);
            if ($request->expectsJson()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Login gagal, data tidak valid'
                ], 401);
            } else {
                return redirect()->back()->withErrors(['login_error' => 'Login gagal, data tidak valid']);
            }
        }

        \Log::debug('Login successful', ['user' => $user->toArray()]);

        // For web login, authenticate the user
        if (!$request->expectsJson()) {
            \Auth::login($user);
            \Log::debug('Web login: user authenticated', ['auth_check' => \Auth::check(), 'user_role' => $user->role]);
            return redirect()->route('admin.dashboard');
        }

        // For API login
        return response()->json([
            'status'  => 'success',
            'message' => 'Login berhasil',
            'data'    => [
                'username' => $user->username,
                'role'     => $user->role,
                'imei'     => $user->imei
            ]
        ]);
    }

    // ========== Register User (khusus admin) ==========
    public function register(Request $request)
    {
        $request->validate([
            'admin_username' => 'required',
            'admin_password' => 'required',
            'users' => 'required|array',
            'users.*.username' => 'required|unique:users,username',
            'users.*.password' => 'required',
            'users.*.imei' => 'required',
            'users.*.role' => 'required',
        ]);

        $admin = User::where('username', $request->admin_username)
                     ->where('role', 'admin')
                     ->first();

        if (!$admin || !Hash::check($request->admin_password, $admin->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Hanya admin yang bisa register user baru'
            ], 403);
        }

        $createdUsers = [];
        foreach ($request->users as $userData) {
            $createdUsers[] = User::create([
                'username' => $userData['username'],
                'password' => Hash::make($userData['password']),
                'imei'     => $userData['imei'],
                'role'     => $userData['role'],
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User baru berhasil didaftarkan oleh admin',
            'data' => $createdUsers
        ]);
    }

    // ========== Web View: Logout ==========
    public function logout()
    {
        session()->flush();
        return redirect()->route('login')->with('success', 'Berhasil logout');
    }
}
