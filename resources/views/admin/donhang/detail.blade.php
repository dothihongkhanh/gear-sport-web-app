@extends('admin.layouts.app')
@section('title', 'Chi tiết đơn hàng - ' . $donHang->ma_don_hang)
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Thông tin đơn hàng</h4>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4"><strong>Tên người nhận:</strong></div>
            <div class="col-md-8">{{ $donHang->ten_nguoi_nhan }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Số điện thoại:</strong></div>
            <div class="col-md-8">{{ $donHang->sdt_nhan_hang }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Địa chỉ nhận hàng:</strong></div>
            <div class="col-md-8">{{ $donHang->dia_chi_nhan_hang }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Phương thức thanh toán:</strong></div>
            <div class="col-md-8">{{ $donHang->phuong_thuc_thanh_toan }}</div>
        </div>
        @if($donHang->phuong_thuc_thanh_toan == \App\Enums\PhuongThucThanhToan::VNPay)
        <div class="row mb-3">
            <div class="col-md-4"><strong>Mã giao dịch VNPay:</strong></div>
            <div class="col-md-8">{{ $donHang->ma_giao_dich_vnpay }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Thời gian thanh toán:</strong></div>
            <div class="col-md-8">{{ $donHang->thoi_gian_thanh_toan }}</div>
        </div>
        @endif
        <div class="row mb-3">
            <div class="col-md-4"><strong>Thời gian nhận hàng:</strong></div>
            <div class="col-md-8">{{ $donHang->thoi_gian_nhan_hang }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Trạng thái:</strong></div>

            <div class="col-md-8">
                <span
                    class="badge 
               @if($donHang->trang_thai === \App\Enums\TrangThaiDonHang::DangChoXuLy) text-primary border border-primary
               @elseif($donHang->trang_thai === \App\Enums\TrangThaiDonHang::DangGiaoHang) text-warning border border-warning
               @elseif($donHang->trang_thai === \App\Enums\TrangThaiDonHang::HoanThanh) text-success border border-success
               @elseif($donHang->trang_thai === \App\Enums\TrangThaiDonHang::DaHuy) text-danger border border-danger
               @endif
               rounded-pill p-1">
                    {{ $donHang->trang_thai }}
                </span>
            </div>
        </div>
    </div>
</div>

<table class="table table-hover">
    <tr>
        <th>Sản phẩm</th>
        <th>Đơn giá</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
    </tr>
    @foreach ($donHang->chiTietDonHang as $chiTiet)
    <tr>
        <td>{{ $chiTiet->sanPham->ten_san_pham }} - {{ $chiTiet->ChiTietSanPham->thuoc_tinh }}</td>
        <td>{{ number_format($chiTiet->gia, 0, '.', '.') }} VND</td>
        <td>{{ $chiTiet->so_luong_dat }}</td>
        <td>{{ $chiTiet->thanhTien() }}</td>
    </tr>
    @endforeach
    <tr>
        <td colspan="3" class="text-right"><strong>Tổng giá trị đơn hàng:</strong></td>
        <td><strong class="text-danger">{{ number_format($donHang->tongGiaTri(), 0, '.', '.') }} VND</strong></td>
    </tr>
</table>
<form action="{{ route('admin.donhang.approval', $donHang->ma_don_hang) }}" method="POST">
    @csrf
    @method('PATCH')
    @if($donHang->trang_thai == \App\Enums\TrangThaiDonHang::DangChoXuLy)
    <button type="submit" class="btn btn-success">Duyệt đơn hàng</button>
    @endif
</form>

@endsection