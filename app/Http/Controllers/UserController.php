<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unit;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ======== Tampilkan daftar user ========
    public function index()
    {
        $users = User::with('unit')->paginate(10);
        return view('users.index', compact('users'));
    }

    // ======== Form tambah user ========
    public function create()
    {
        $units = Unit::all();
        return view('users.create', compact('units'));
    }

    // ======== Simpan user baru ========
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
            'imei'     => 'required|string|unique:users,imei',
            'role'     => 'required|string|in:guru,siswa',
            'unit_id'  => 'required|exists:units,id',
        ]);

        User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'imei'     => $validated['imei'],
            'role'     => $validated['role'],
            'unit_id'  => $validated['unit_id'],
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan ✅');
    }

    // ======== Form edit user ========
    public function edit(User $user)
    {
        $units = Unit::all();
        return view('users.edit', compact('user', 'units'));
    }

    // ======== Update user ========
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:6',
            'imei'     => 'required|string|unique:users,imei,' . $user->id,
            'role'     => 'required|string|in:guru,siswa',
            'unit_id'  => 'required|exists:units,id',
        ]);

        $data = [
            'username' => $validated['username'],
            'imei'     => $validated['imei'],
            'role'     => $validated['role'],
            'unit_id'  => $validated['unit_id'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diperbarui ✨');
    }

    // ======== Hapus user ========
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index') // ✅ sudah plural
            ->with('success', 'User berhasil dihapus');
    }
}
