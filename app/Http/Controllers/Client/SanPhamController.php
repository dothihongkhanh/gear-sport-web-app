<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Models\GioHang;
use App\Models\SanPham;
use App\Models\ThuongHieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanPhamController extends Controller
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

    public function listProducts()
    {
        $dsSanPham =  SanPham::withTrashed()->get();
        $dsDanhMuc = DanhMuc::with('sanPham')->get();
        $dsThuongHieu = ThuongHieu::with('sanPham')->get();

        return view('client.sanpham.index', compact('dsSanPham', 'dsDanhMuc', 'dsThuongHieu'));
    }

    public function filter(Request $request)
    {
        $maDanhMuc = $request->get('ma_danh_muc');
        $maThuongHieu = $request->get('ma_thuong_hieu');

        if (!empty($maDanhMuc)) {
            $dsSanPham = SanPham::when($maDanhMuc, function ($query) use ($maDanhMuc) {
                $query->where('ma_danh_muc', $maDanhMuc);
            })->get();
        }

        if (!empty($maThuongHieu)) {
            $dsSanPham = SanPham::when($maThuongHieu, function ($query) use ($maThuongHieu) {
                $query->where('ma_thuong_hieu', $maThuongHieu);
            })->get();
        }

        $dsDanhMuc = DanhMuc::with('sanPham')->get();
        $dsThuongHieu = ThuongHieu::with('sanPham')->get();

        return view('client.sanpham.index', compact('dsSanPham', 'dsDanhMuc', 'dsThuongHieu'));
    }
}
