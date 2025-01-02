<?php

namespace App\Providers;

use App\Models\ChiTietGioHang;
use App\Models\DanhMuc;
use App\Models\GioHang;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('client.layouts.app', function ($view) {
            $dsDanhMuc = DanhMuc::with('sanPham')->get();
    
            $spGioHang = 0;
            if (Auth::check()) {
                $nguoiDung = Auth::user();
                $spGioHang = ChiTietGioHang::join('gio_hang', 'chi_tiet_gio_hang.ma_gio_hang', '=', 'gio_hang.ma_gio_hang')
                    ->where('gio_hang.ma_nguoi_dung', $nguoiDung->ma_nguoi_dung)
                    ->sum('chi_tiet_gio_hang.so_luong');
            }            
    
            $view->with([
                'dsDanhMuc' => $dsDanhMuc,
                'spGioHang' => $spGioHang,
            ]);
        });
    }
}
