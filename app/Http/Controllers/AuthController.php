<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ========== Login User ==========
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'imei'     => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password) || $user->imei !== $request->imei) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Login gagal, data tidak valid'
            ], 401);
        }

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
}

