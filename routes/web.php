<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\DataController;  // Import controller yang akan digunakan

// route default ke halaman welcome
Route::get('/', function () {
    return view('welcome');
});

// route test sederhana (untuk memastikan routing jalan)
Route::get('/ping', fn () => 'pong');

// route untuk cek database
Route::get('/check-db', function () {
    try {
        return 'Connected to DB: ' . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return 'Connection error: ' . $e->getMessage();
    }
});

// route login GET (untuk testing di browser)
Route::get('/login', function (Request $request) {
    $email = $request->query('email');
    $password = $request->query('password');
    $imei = $request->query('imei');

    return response()->json([
        'status' => 'success',
        'message' => 'Login GET berhasil (testing browser)',
        'data' => [
            'email' => $email,
            'password' => $password,
            'imei' => $imei
        ]
    ]);
});

// route login POST (untuk Postman / real login)
Route::post('/login', function (Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');
    $imei = $request->input('imei');

    if ($email === 'adminnnnn@mail.com' && $password === 'admin0987' && $imei === '1234567890') {
        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'data' => [
                'email' => $email,
                'imei' => $imei
            ]
        ]);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'Login gagal, data tidak valid'
    ], 401);
});

// route untuk menampilkan data menggunakan controller
Route::get('/api/data', [DataController::class, 'getData']);
