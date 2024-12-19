<?php

namespace App\Http\Controllers\Client;

use App\Enums\TrangThaiDonHang;
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

        return redirect()->route('client.thanhtoan.checkout-single');
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

        return view('client.thanhtoan.checkout-single', compact('sanPham', 'soLuong', 'chiTietSanPham'));
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

            $chiTietSanPham = ChiTietSanPham::where('ma_chi_tiet_san_pham', $orderData['maChiTietSanPham'])->first();

            ChiTietDonHang::create([
                'ma_don_hang' => $idDonHang,
                'ma_chi_tiet_san_pham' => $orderData['maChiTietSanPham'],
                'gia' => $chiTietSanPham->gia,
                'so_luong_dat' => $orderData['soLuong'],
            ]);
            $chiTietSanPham->so_luong -= $orderData['soLuong'];
            $chiTietSanPham->save(); 

            toastr()->success('Đặt hàng thành công!');

            return redirect()->route('home');
        } catch (\Exception $err) {
            toastr()->error('Đã xảy ra lỗi, vui lòng thử lại sau.');
            return redirect()->back();
        }
    }

    public function viewAllOrder()
    {
        $maNguoiDung = Auth::user()->ma_nguoi_dung;
        $dsDonHang = DonHang::where('ma_nguoi_dung', $maNguoiDung)->get();        

        return view('client.donhang.index', compact('dsDonHang'));
    }

    public function viewDetailOrder($maDonHang)
    {
        $donHang = DonHang::withTrashed()->with('chiTietDonHang')->findOrFail($maDonHang);

        return view('client.donhang.detail', compact('donHang'));
    }

    public function received($maDonHang)
    {
        $donHang = DonHang::findOrFail($maDonHang);

        if ($donHang->trang_thai == TrangThaiDonHang::DangGiaoHang) {
            $donHang->trang_thai = TrangThaiDonHang::HoanThanh;
            $donHang->save();
            toastr()->success('Nhận hàng thành công!');

            return redirect()->route('client.donhang.view-all');
        }
    }

    public function cancel($maDonHang)
    {
        $donHang = DonHang::findOrFail($maDonHang);

        if ($donHang->trang_thai == TrangThaiDonHang::DangChoXuLy) {
            $donHang->trang_thai = TrangThaiDonHang::DaHuy;
            $donHang->save();
            toastr()->success('Hủy đơn hàng thành công!');

            return redirect()->route('client.donhang.view-all');
        }
    }
}
