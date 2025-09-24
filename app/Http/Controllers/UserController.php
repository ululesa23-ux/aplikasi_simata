<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::where('role','user')->get();
        return view('admin.users.index', compact('users'));
    }

    // form tambah user
    public function create(){
        return view('admin.users.tambah'); // pastikan blade ini ada
    }

    // simpan user baru
    public function store(Request $request){
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'imei'     => 'nullable|unique:users,imei', // optional tapi unik jika diisi
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => 'user',
            'imei'     => $request->imei ?? null,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,'.$user->id,
            'password' => 'nullable|min:6',
            'imei'     => 'nullable|unique:users,imei,'.$user->id,
        ]);

        $user->username = $request->username;
        $user->imei = $request->imei ?? $user->imei;

        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}
