<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Models\GioHang;
use App\Models\SanPham;
use App\Models\ThuongHieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrangChuController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $nguoiDung  = Auth::user();

            $ma_nguoi_dung = $nguoiDung->ma_nguoi_dung;
            $spGioHang = GioHang::where('ma_nguoi_dung', $nguoiDung)->sum('so_luong');
        } else {
            $spGioHang = 0;
        }

        $dsDanhMuc = DanhMuc::with('sanPham')->get();
        $dsThuongHieu = ThuongHieu::get();
        $sanPhamTop5 = SanPham::latest('ma_san_pham')->take(5)->get();

        return view('client.home.index', compact('spGioHang', 'dsDanhMuc', 'dsThuongHieu', 'sanPhamTop5'));
    }

    public function detail($ma_san_pham)
    {
        $sanPham = SanPham::withTrashed()->with('chiTietSanPham')->findOrFail($ma_san_pham);
        return view('client.sanpham.detail', compact('sanPham'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $dsSanPham = SanPham::where('ten_san_pham', 'like', '%' . $query . '%')
                            ->orWhere('mo_ta', 'like', '%' . $query . '%')
                            ->get(); 

        return view('client.search.index', compact('query', 'dsSanPham'));
    }
}
