<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\DonHang\ThemDonHangRequest;
use App\Models\ChiTietDonHang;
use App\Models\ChiTietGioHang;
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

            $gioHang = GioHang::firstOrCreate([
                'ma_nguoi_dung' => Auth::user()->ma_nguoi_dung,
            ]);

            $chiTietSanPham = ChiTietGioHang::where('ma_gio_hang', $gioHang->ma_gio_hang)->where('ma_chi_tiet_san_pham', $maChiTietSanPham)->first();

            if ($chiTietSanPham) {
                $chiTietSanPham->increment('so_luong', $soLuong);
            } else {
                ChiTietGioHang::create([
                    'ma_gio_hang' => $gioHang->ma_gio_hang,
                    'ma_chi_tiet_san_pham' => $maChiTietSanPham,
                    'so_luong' => $soLuong,
                ]);
            }

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
        $dsGioHang = GioHang::where('ma_nguoi_dung', $maNguoiDung)->with(['chiTietGioHang.chiTietSanPham.sanPham'])->get();
        $tongThanhToan = 0;
        if ($dsGioHang) {
            foreach ($dsGioHang as $gioHang) {
                foreach ($gioHang->chiTietGioHang as $chiTietGH) {
                    $tongThanhToan += $chiTietGH->so_luong * $chiTietGH->chiTietSanPham->gia;
                }
            }
        }

        return view('client.giohang.index', compact('dsGioHang', 'tongThanhToan'));
    }

    public function updateCart(Request $request)
    {
        $maChiTietGioHang = $request->input('ma_chi_tiet_gio_hang');
        $soLuongMoi = $request->input('so_luong');

        $chiTietGioHang = ChiTietGioHang::find($maChiTietGioHang);

        $chiTietGioHang->so_luong = $soLuongMoi;
        $chiTietGioHang->save();

        $maNguoiDung = Auth::user()->ma_nguoi_dung;
        $dsGioHang = GioHang::where('ma_nguoi_dung', $maNguoiDung)->with(['chiTietGioHang.chiTietSanPham.sanPham'])->get();
        $spGioHang = 0;
        if (Auth::check()) {
            $nguoiDung = Auth::user();
            $spGioHang = ChiTietGioHang::join('gio_hang', 'chi_tiet_gio_hang.ma_gio_hang', '=', 'gio_hang.ma_gio_hang')
                ->where('gio_hang.ma_nguoi_dung', $nguoiDung->ma_nguoi_dung)
                ->sum('chi_tiet_gio_hang.so_luong');
        }
        $tongThanhToan = 0;
        if ($dsGioHang) {
            foreach ($dsGioHang as $gioHang) {
                foreach ($gioHang->chiTietGioHang as $chiTietGH) {
                    $tongThanhToan += $chiTietGH->so_luong * $chiTietGH->chiTietSanPham->gia;
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật giỏ hàng thành công!',
            'gia' => $chiTietGioHang->chiTietSanPham->gia,
            'tongThanhToan' => $tongThanhToan,
            'spGioHang' => $spGioHang
        ]);
    }

    public function deleteCart(string $id)
    {
        try {
            $chiTietGioHang = ChiTietGioHang::findOrFail($id);
            $chiTietGioHang->delete();

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
        $dsGioHang = GioHang::where('ma_nguoi_dung', $maNguoiDung)->with(['chiTietGioHang.chiTietSanPham.sanPham'])->get();
        session(['dsGioHang' => $dsGioHang]);

        return redirect()->route('client.thanhtoan.checkout-cart');
    }

    public function showBuyFromCart()
    {
        $dsGioHang = session('dsGioHang');

        return view('client.thanhtoan.checkout-cart', compact('dsGioHang'));
    }

    public function saveOrderByCartToDB($dsGioHang, $phuongThucThanhToan, $vnp_TxnRef)
    {
        try {
            $donHang = DonHang::create([
                'ma_nguoi_dung' => Auth::user()->ma_nguoi_dung,
                'ten_nguoi_nhan' => $dsGioHang['ten_nguoi_nhan'],
                'sdt_nhan_hang' => $dsGioHang['sdt_nhan_hang'],
                'dia_chi_nhan_hang' => $dsGioHang['dia_chi_nhan_hang'],
                'phuong_thuc_thanh_toan' => $phuongThucThanhToan,
                'trang_thai' => 'Đang chờ xử lý',
                'thoi_gian_thanh_toan' => $phuongThucThanhToan == 'VN Pay' ? now() : null,
                'ma_giao_dich_vnpay' => $phuongThucThanhToan == 'VN Pay' ? $vnp_TxnRef : null,
                'thoi_gian_nhan_hang' => null,
            ]);

            $idDonHang = $donHang->ma_don_hang;

            foreach ($dsGioHang as $gioHang) {
                if (!is_array($gioHang)) {
                    continue;
                }

                foreach ($gioHang['chi_tiet_gio_hang'] as $chiTietGioHang) {
                    $chiTietSanPham = $chiTietGioHang['chi_tiet_san_pham'];
                    ChiTietDonHang::create([
                        'ma_don_hang' => $idDonHang,
                        'ma_chi_tiet_san_pham' => $chiTietGioHang['ma_chi_tiet_san_pham'],
                        'gia' => $chiTietSanPham['gia'],
                        'so_luong_dat' => $chiTietGioHang['so_luong'],
                    ]);

                    $chiTietModel = ChiTietSanPham::find($chiTietGioHang['ma_chi_tiet_san_pham']);
                    if ($chiTietModel) {
                        $chiTietModel->so_luong -= $chiTietGioHang['so_luong'];
                        $chiTietModel->save();
                    }
                }

                $gioHangModel = GioHang::find($gioHang['ma_gio_hang']);
                if ($gioHangModel) {
                    $gioHangModel->delete();
                }
            }

            return $donHang;
        } catch (\Exception $e) {
            dd($e);
            toastr()->error('Đã xảy ra lỗi khi lưu đơn hàng. Vui lòng thử lại.');

            return redirect()->back();
        }
    }

    public function saveOrderByCart(ThemDonHangRequest $request)
    {
        $dsGioHang = session('dsGioHang', []);
        $dsGioHang = $dsGioHang instanceof \Illuminate\Database\Eloquent\Collection ? $dsGioHang->toArray() : $dsGioHang;

        $dsGioHang = array_merge($dsGioHang, [
            'ten_nguoi_nhan' => $request->input('ten_nguoi_nhan'),
            'sdt_nhan_hang' => $request->input('sdt_nhan_hang'),
            'dia_chi_nhan_hang' => $request->input('dia_chi_nhan_hang'),
            'phuong_thuc_thanh_toan' => $request->input('phuong_thuc_thanh_toan'),
            'tong_tien' => $request->input('tong_tien'),
        ]);
        session(['dsGioHang' => $dsGioHang]);

        if (!$dsGioHang) {
            return redirect()->route('home')->with('error', 'Không tìm thấy thông tin đặt hàng.');
        }

        try {
            if ($request->input('phuong_thuc_thanh_toan') == 'Thanh toán khi nhận hàng') {
                $this->saveOrderByCartToDB($dsGioHang, 'Thanh toán khi nhận hàng', null);
                toastr()->success('Đặt hàng thành công!');

                return redirect()->route('client.donhang.view-all');
            }

            if ($request->input('phuong_thuc_thanh_toan') == 'VN Pay') {
                return $this->handleVNPayPayment($request, $dsGioHang);
            }
        } catch (\Exception $err) {
            dd($err);
            toastr()->error('Đã xảy ra lỗi, vui lòng thử lại sau.');

            return redirect()->back();
        }
    }

    public function handleVNPayPayment($request, $dsGioHang)
    {
        $vnp_TmnCode = env('VNP_TMNCODE');
        $vnp_HashSecret = env('VNP_HASHSECRET');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/vnpay-callback";

        $vnp_TxnRef = uniqid();
        $vnp_OrderInfo = "Thanh toán đơn hàng #" . $vnp_TxnRef;
        $vnp_OrderType = 'bill payment';
        $vnp_Amount = $dsGioHang['tong_tien'] * 100;
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
                $dsGioHang = session('dsGioHang');
                $this->saveOrderByCartToDB($dsGioHang, 'VN Pay', $vnp_TxnRef);
                toastr()->success('Thanh toán thành công!');

                return redirect()->route('client.donhang.view-all');
            } catch (\Exception $err) {
                dd($err);
                toastr()->error('Đã xảy ra lỗi khi lưu đơn hàng. Vui lòng thử lại.');

                return redirect()->back();
            }
        } else {
            toastr()->error('Thanh toán thất bại. Vui lòng thử lại.');

            return redirect()->back();
        }
    }
}
