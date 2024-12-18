<?php

namespace App\Providers;

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
                $spGioHang = GioHang::where('ma_nguoi_dung', $nguoiDung->ma_nguoi_dung)->sum('so_luong');
            }
    
            $view->with([
                'dsDanhMuc' => $dsDanhMuc,
                'spGioHang' => $spGioHang,
            ]);
        });
    }
}
