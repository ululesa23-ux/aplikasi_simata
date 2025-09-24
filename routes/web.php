<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\DataController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController; // Tambahan

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Testing & Utilities
|--------------------------------------------------------------------------
*/
Route::get('/ping', fn () => 'pong');

Route::get('/check-db', function () {
    try {
        return 'Connected to DB: ' . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return 'Connection error: ' . $e->getMessage();
    }
});

/*
|--------------------------------------------------------------------------
| API Login Testing (GET & POST)
|--------------------------------------------------------------------------
| Hanya untuk uji coba di Postman/browser.
*/
Route::get('/login-test', function (Request $request) {
    return response()->json([
        'status' => 'success',
        'message' => 'Login GET berhasil (testing browser)',
        'data' => $request->only(['email', 'password', 'imei'])
    ]);
});

Route::post('/login-test', function (Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');
    $imei = $request->input('imei');

    if ($email === 'adminnnnn@mail.com' && $password === 'admin0987' && $imei === '1234567890') {
        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'data' => compact('email', 'imei')
        ]);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'Login gagal, data tidak valid'
    ], 401);
});

/*
|--------------------------------------------------------------------------
| Web Login (Blade)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Data & Video
|--------------------------------------------------------------------------
*/
Route::get('/api/data', [DataController::class, 'getData']);
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');

/*
|--------------------------------------------------------------------------
| Inventaris CRUD (Web View)
|--------------------------------------------------------------------------
*/
Route::prefix('inventaris')->group(function () {
    Route::get('/', [InventarisController::class, 'index'])->name('inventaris.index');
    Route::get('/create', [InventarisController::class, 'create'])->name('inventaris.create');
    Route::post('/', [InventarisController::class, 'store'])->name('inventaris.store');
    Route::get('/{id}/edit', [InventarisController::class, 'edit'])->name('inventaris.edit');
    Route::put('/{id}', [InventarisController::class, 'update'])->name('inventaris.update');
    Route::delete('/{id}', [InventarisController::class, 'destroy'])->name('inventaris.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Panel (hanya admin role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // CRUD User
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    
    // ganti URL create menjadi /admin/users/tambah
    Route::get('/admin/users/tambah', [UserController::class, 'create'])->name('users.create');
    
    Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
});

