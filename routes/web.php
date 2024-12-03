<?php

use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\ThongKeController;
use App\Http\Controllers\Admin\ThuongHieuController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// admin
//Route::middleware(['verified'])->group(function () {
Route::prefix('admin')->group(function () {
    Route::get('/', [ThongKeController::class, 'index'])->name('admin');

    Route::prefix('danhmuc')->group(function () {
        Route::controller(DanhMucController::class)->group(function () {
            Route::get('', 'index')->name('admin.danhmuc');
            Route::post('', 'store')->name('admin.danhmuc.store');
            Route::get('update/{ma_danh_muc}', 'edit');
            Route::post('update/{ma_danh_muc}', 'update');
            Route::delete('delete/{id}', 'destroy');
            Route::patch('restore/{id}', 'restore');
        });
    });

    Route::prefix('thuonghieu')->group(function () {
        Route::controller(ThuongHieuController::class)->group(function () {
            Route::get('', 'index')->name('admin.thuonghieu');
            Route::post('', 'store')->name('admin.thuonghieu.store');
            Route::get('update/{ma_thuong_hieu}', 'edit');
            Route::post('update/{ma_thuong_hieu}', 'update');
            Route::delete('delete/{id}', 'destroy');
            Route::patch('restore/{id}', 'restore');
        });
    });

    Route::prefix('sanpham')->group(function () {
        Route::controller(SanPhamController::class)->group(function () {
            Route::get('', 'index')->name('admin.sanpham');
            Route::get('create', 'create')->name('admin.sanpham.create');
            Route::post('create', 'store');
            Route::get('update/{ma_san_pham}', 'edit')->name('admin.sanpham.update');
            Route::patch('/update/{ma_san_pham}', [SanPhamController::class, 'update'])->name('update');

            Route::delete('delete/{ma_san_pham}', 'destroy')->name('admin.sanpham.delete');
            Route::patch('restore/{ma_san_pham}', 'restore')->name('admin.sanpham.restore');

            Route::get('detail/{ma_san_pham}', 'show')->name('admin.sanpham.detail');
            Route::post('detail/{ma_san_pham}', 'storeChiTiet');
            Route::delete('/delete-detail/{ma_chi_tiet_san_pham}', 'destroyChiTiet')->name('admin.sanpham.delete-detail');
            Route::patch('restore-detail/{ma_chi_tiet_san_pham}', 'restoreChiTiet')->name('admin.sanpham.restore-detail');
        });
    });
});
//});
