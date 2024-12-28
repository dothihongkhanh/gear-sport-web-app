<?php

namespace App\Http\Controllers\Client;

use App\Enums\PhuongThucThanhToan;
use App\Enums\TrangThaiDonHang;
use App\Http\Controllers\Controller;
use App\Http\Requests\DonHang\ThemDonHangRequest;
use App\Models\ChiTietDonHang;
use App\Models\ChiTietSanPham;
use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    public function saveOrderToDB($orderData, $phuongThucThanhToan, $vnp_TxnRef)
    {
        try {
            $donHang = DonHang::create([
                'ma_nguoi_dung' => Auth::user()->ma_nguoi_dung,
                'ten_nguoi_nhan' => $orderData['ten_nguoi_nhan'],
                'sdt_nhan_hang' => $orderData['sdt_nhan_hang'],
                'dia_chi_nhan_hang' => $orderData['dia_chi_nhan_hang'],
                'phuong_thuc_thanh_toan' => $phuongThucThanhToan,
                'trang_thai' => 'Đang chờ xử lý',
                'thoi_gian_thanh_toan' => $phuongThucThanhToan == 'VN Pay' ? now() : null,
                'ma_giao_dich_vnpay' => $phuongThucThanhToan == 'VN Pay' ? $vnp_TxnRef : null,
                'thoi_gian_nhan_hang' => null,
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

            return $donHang;
        } catch (\Exception $err) {
            toastr()->error('Đã xảy ra lỗi khi lưu đơn hàng. Vui lòng thử lại.');
            throw $err;
        }
    }

    public function saveOrder(ThemDonHangRequest $request)
    {
        $orderData = session('orderData', []);

        $orderData = array_merge($orderData, [
            'ten_nguoi_nhan' => $request->input('ten_nguoi_nhan'),
            'sdt_nhan_hang' => $request->input('sdt_nhan_hang'),
            'dia_chi_nhan_hang' => $request->input('dia_chi_nhan_hang'),
            'phuong_thuc_thanh_toan' => $request->input('phuong_thuc_thanh_toan'),
            'tong_tien' => $request->input('tong_tien'),
        ]);

        session(['orderData' => $orderData]);

        if (!$orderData) {
            return redirect()->route('home')->with('error', 'Không tìm thấy thông tin đặt hàng.');
        }

        try {
            if ($request->input('phuong_thuc_thanh_toan') == 'Thanh toán khi nhận hàng') {
                $this->saveOrderToDB($orderData, 'Thanh toán khi nhận hàng', null);
                toastr()->success('Đặt hàng thành công!');

                return redirect()->route('client.donhang.view-all');
            }

            if ($request->input('phuong_thuc_thanh_toan') == 'VN Pay') {
                return $this->handleVNPayPayment($request, $orderData);
            }
        } catch (\Exception $err) {
            dd($err);
            toastr()->error('Đã xảy ra lỗi, vui lòng thử lại sau.');

            return redirect()->back();
        }
    }

    public function handleVNPayPayment($request, $orderData)
    {
        $vnp_TmnCode = env('VNP_TMNCODE');
        $vnp_HashSecret = env('VNP_HASHSECRET');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/vnpay-callback-single";

        $vnp_TxnRef = uniqid();
        $vnp_OrderInfo = "Thanh toán đơn hàng #" . $vnp_TxnRef;
        $vnp_OrderType = 'bill payment';
        $vnp_Amount = $orderData['tong_tien'] * 100;
        $vnp_Locale = 'VN';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $hashdata = "";

        foreach ($inputData as $key => $value) {
            $hashdata .= ($query ? '&' : '') . urlencode($key) . "=" . urlencode($value);
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;

        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function vnpay_callback(Request $request)
    {
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        $vnp_TxnRef = $request->input('vnp_TxnRef');

        if ($vnp_ResponseCode == '00') {
            try {
                $orderData = session('orderData');

                $this->saveOrderToDB($orderData, 'VN Pay', $vnp_TxnRef);

                toastr()->success('Thanh toán thành công!');

                return redirect()->route('client.donhang.view-all');
            } catch (\Exception $err) {
                toastr()->error('Đã xảy ra lỗi khi lưu đơn hàng. Vui lòng thử lại.');

                return redirect()->back();
            }
        } else {
            toastr()->error('Thanh toán thất bại. Vui lòng thử lại.');

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
            $donHang->thoi_gian_nhan_hang = now();
            if ($donHang->phuong_thuc_thanh_toan == PhuongThucThanhToan::ThanhToanKhiNhanHang) {
                $donHang->thoi_gian_thanh_toan = now();
            }
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
