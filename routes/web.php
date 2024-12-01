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
    });
//});
