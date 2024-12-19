<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\DonHang\ThemDonHangRequest;
use App\Models\ChiTietDonHang;
use App\Models\ChiTietSanPham;
use App\Models\DonHang;
use App\Models\GioHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GioHangController extends Controller
{
    public function addToCart(Request $request)
    {
        try {
            $soLuong = $request->input('so_luong');
            $maChiTietSanPham = $request->input('ma_chi_tiet_san_pham');

            GioHang::create([
                'ma_nguoi_dung' => Auth::user()->ma_nguoi_dung,
                'ma_chi_tiet_san_pham' => $maChiTietSanPham,
                'so_luong' => $soLuong,
            ]);

            toastr()->success('Thêm vào giỏ hàng thành công!');
        } catch (\Exception $err) {
            dd($err);
            toastr()->error('Đã xảy ra lỗi, vui lòng thử lại sau.');
        }

        return redirect()->back();
    }

    public function viewCart()
    {
        $maNguoiDung = Auth::user()->ma_nguoi_dung;
        $dsGioHang = GioHang::with(['chiTietSanPham.sanPham'])->where('ma_nguoi_dung', $maNguoiDung)->get();

        return view('client.giohang.index', compact('dsGioHang'));
    }

    public function deleteCart(string $id)
    {
        try {
            $gioHang = GioHang::findOrFail($id);
            $gioHang->delete();

            toastr()->success('Xóa thành công!');

            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error('Có lỗi khi xóa!');

            return redirect()->back();
        }
    }

    public function buyFromCart()
    {
        $maNguoiDung = Auth::user()->ma_nguoi_dung;
        $dsGioHang = GioHang::where('ma_nguoi_dung', $maNguoiDung)->get();
        session(['dsGioHang' => $dsGioHang]);

        return redirect()->route('client.thanhtoan.checkout-cart');
    }

    public function showBuyFromCart()
    {
        $dsGioHang = session('dsGioHang');

        return view('client.thanhtoan.checkout-cart', compact('dsGioHang'));
    }

    public function saveOrderByCart(ThemDonHangRequest $request)
    {
        $dsGioHang = session('dsGioHang');

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

            foreach ($dsGioHang as $gioHang) {
                foreach ($gioHang->chiTietSanPham as $chiTiet) {
                    ChiTietDonHang::create([
                        'ma_don_hang' => $idDonHang,
                        'ma_chi_tiet_san_pham' => $chiTiet->ma_chi_tiet_san_pham,
                        'gia' => $chiTiet->gia,
                        'so_luong_dat' => $gioHang->so_luong,
                    ]);

                    $chiTiet->so_luong -= $gioHang->so_luong; // Trừ số lượng đã đặt
                    $chiTiet->save();
                }
                $gioHang->delete();
            }
            session()->forget('dsGioHang');
            toastr()->success('Đặt hàng thành công!');

            return redirect()->route('home');
        } catch (\Exception $err) {
            dd($err);
            toastr()->error('Đã xảy ra lỗi, vui lòng thử lại sau.');

            return redirect()->back();
        }
    }
}
