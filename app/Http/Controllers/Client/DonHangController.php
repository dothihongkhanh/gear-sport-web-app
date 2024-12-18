<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\DonHang\ThemDonHangRequest;
use App\Models\ChiTietDonHang;
use App\Models\ChiTietSanPham;
use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonHangController extends Controller
{
    public function buyProduct(Request $request)
    {
        $maSanPham = $request->input('ma_san_pham');
        $soLuong = $request->input('so_luong');
        $maChiTietSanPham = $request->input('ma_chi_tiet_san_pham');

        session()->put('orderData', [
            'maSanPham' => $maSanPham,
            'soLuong' => $soLuong,
            'maChiTietSanPham' => $maChiTietSanPham,
        ]);

        return redirect()->route('client.donhang.index');
    }

    public function showOrder()
    {
        $orderData = session('orderData');
        if (!$orderData) {
            return redirect()->route('home');
        }

        $sanPham = SanPham::where('ma_san_pham', $orderData['maSanPham'])->first();
        $chiTietSanPham = ChiTietSanPham::where('ma_chi_tiet_san_pham', $orderData['maChiTietSanPham'])->first();
        $soLuong = $orderData['soLuong'];

        return view('client.donhang.index', compact('sanPham', 'soLuong', 'chiTietSanPham'));
    }

    public function saveOrder(ThemDonHangRequest $request)
    {
        $orderData = session('orderData');
        if (!$orderData) {
            return redirect()->route('home')->with('error', 'Không tìm thấy thông tin đặt hàng.');
        }

        try {
            $donHang = DonHang::create([
                'ma_nguoi_dung' => Auth::user()->ma_nguoi_dung,
                'ten_nguoi_nhan' => $request->input('ten_nguoi_nhan'),
                'sdt_nhan_hang' => $request->input('sdt_nhan_hang'),
                'dia_chi_nhan_hang' => $request->input('dia_chi_nhan_hang'),
                'thoi_gian_thanh_toan' => null,
                'thoi_gian_nhan_hang' => null,
                'phuong_thuc_thanh_toan' => $request->input('phuong_thuc_thanh_toan'),
            ]);

            $idDonHang = $donHang->ma_don_hang;
            ChiTietDonHang::create([
                'ma_don_hang' => $idDonHang,
                'ma_chi_tiet_san_pham' => $orderData['maChiTietSanPham'],
                'gia' => ChiTietSanPham::where('ma_chi_tiet_san_pham', $orderData['maChiTietSanPham'])->first()->gia,
                'so_luong_dat' => $orderData['soLuong'],
            ]);
            toastr()->success('Đặt hàng thành công!');

            return redirect()->route('home');
        } catch (\Exception $err) {
            dd($err);
            toastr()->error('Đã xảy ra lỗi, vui lòng thử lại sau.');

            return redirect()->back();
        }
    }
}
