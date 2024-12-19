@extends('client.layouts.app')
@section('title', 'Chi tiết đơn hàng - ' . $donHang->ma_don_hang)
@section('content')
<section class="bg-light">
    <div class="container pb-5">
        <p><a href="{{ route('client.donhang.view-all') }}" class="text-decoration-none">Danh sách đơn hàng</a><span class="text-primary"> / Chi tiết</span></p>
        <div class="row">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-white text-primary">Thông tin đơn hàng</div>
                    <div class="card-body">
                        <p><strong>Tên người nhận:</strong> {{ $donHang->ten_nguoi_nhan }}</p>
                        <p><strong>Số điện thoại:</strong> {{ $donHang->sdt_nhan_hang }}</p>
                        <p><strong>Địa chỉ nhận hàng:</strong> {{ $donHang->dia_chi_nhan_hang }}</p>
                        <p><strong>Phương thức thanh toán:</strong> {{ $donHang->phuong_thuc_thanh_toan }}</p>

                        @if($donHang->phuong_thuc_thanh_toan == \App\Enums\PhuongThucThanhToan::VNPay)
                        <p><strong>Mã giao dịch VNPay:</strong> {{ $donHang->ma_giao_dich_vnpay }}</p>
                        @endif
                        <p><strong>Thời gian thanh toán:</strong> {{ $donHang->thoi_gian_thanh_toan }}</p>
                        <p><strong>Thời gian nhận hàng:</strong> {{ $donHang->thoi_gian_nhan_hang }}</p>
                        <p><strong>Trạng thái:</strong> {{ $donHang->trang_thai }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-white text-primary">Sản phẩm</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <tr>
                                <th>Sản phẩm</th>
                                <th width="40%"></th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                            @foreach ($donHang->chiTietDonHang as $chiTiet)
                            <tr>
                                <td><img src="{{ $chiTiet->ChiTietSanPham->hinh_anh_chi_tiet }}" class="card card-img border-0 shadow-sm" style="width: 100px;"></td>
                                <td>
                                    {{ $chiTiet->sanPham->ten_san_pham }}
                                    <p>{{ $chiTiet->ChiTietSanPham->thuoc_tinh }}</p>
                                </td>
                                <td>{{ number_format($chiTiet->gia, 0, '.', '.') }}</td>
                                <td>{{ $chiTiet->so_luong_dat }}</td>
                                <td class="text-danger">{{ number_format($chiTiet->thanhTien(), 0, '.', '.') }} VND</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-end"><strong>Tổng giá trị đơn hàng:</strong></td>
                                <td><strong class="text-danger">{{ number_format($donHang->tongGiaTri(), 0, '.', '.') }} VND</strong></td>
                            </tr>
                        </table>
                        <form action="{{ route('client.donhang.received', $donHang->ma_don_hang) }}" method="POST" class="d-flex justify-content-end">
                            @csrf
                            @method('PATCH')
                            @if($donHang->trang_thai == \App\Enums\TrangThaiDonHang::DangGiaoHang)
                            <button type="submit" class="btn btn-success">Đã nhận được hàng</button>
                            @endif
                        </form>
                        <form action="{{ route('client.donhang.cancel', $donHang->ma_don_hang) }}" method="POST" class="d-flex justify-content-end">
                            @csrf
                            @method('PATCH')
                            @if($donHang->trang_thai == \App\Enums\TrangThaiDonHang::DangChoXuLy)
                            <button type="submit" class="btn btn-outline-primary">Hủy đơn hàng</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection