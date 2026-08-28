
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemPenjualanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenisMakananController;

/*
|--------------------------------------------------------------------------
| Guest Routes (Belum Login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard & Logout (Akses Semua Role yang Login)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Halaman Tentang
    Route::get('/tentang', function () {
        return view('tentang');
    })->name('tentang');

    // Group khusus Role Admin
    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users');
            Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
            Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
            Route::post('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        });

    // Group untuk Role Admin & Kasir
    Route::middleware('role:admin,kasir')->group(function () {
        Route::resource('produk', ProdukController::class);
        Route::resource('jenis-makanan', JenisMakananController::class);

        // Custom route untuk tambah item ke keranjang POS
        Route::post('/penjualan/{penjualan}/add-item', [PenjualanController::class, 'addItem'])->name('penjualan.addItem');

        // Custom route untuk cetak struk transaksi
        Route::get('/penjualan/{penjualan}/struk', [PenjualanController::class, 'struk'])->name('penjualan.struk');
        
        Route::resource('penjualan', PenjualanController::class);
        Route::resource('itempenjualan', ItemPenjualanController::class);
    });

});