@extends('client.layouts.app')
@section('title', 'Giỏ hàng')
@section('content')
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-12 mt-4">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-white text-primary">Thông tin giỏ hàng</div>
                    <div class="card-body">
                        @foreach ($dsGioHang as $gioHang)
                        @if(isset($gioHang->chiTietGioHang) && $gioHang->chiTietGioHang->isNotEmpty())
                        <table class="table table-hover">
                            <tr>
                                <th>Sản phẩm</th>
                                <th style="width: 30%;"></th>
                                <th></th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th></th>
                            </tr>
                            @php
                            $tongThanhToan = 0;
                            @endphp
                            @foreach ($gioHang->chiTietGioHang as $chiTietGH)
                            <tr>
                                @php
                                $tongThanhToan += $chiTietGH->so_luong * $chiTietGH->chiTietSanPham->gia;
                                @endphp
                                <td><img src="{{ $chiTietGH->chiTietSanPham->hinh_anh_chi_tiet }}" class="card card-img border-0 shadow-sm" style="width: 100px;"></td>
                                <td>{{ $chiTietGH->chiTietSanPham->sanPham->ten_san_pham }}</td>
                                <td>{{ $chiTietGH->chiTietSanPham->thuoc_tinh }}
                                <td class="text-danger">{{ number_format($chiTietGH->chiTietSanPham->gia, 0, '.', '.') }} VND</td>
                                <td>{{ $chiTietGH->so_luong }}</td>
                                <td class="text-danger">{{ number_format($chiTietGH->so_luong * $chiTietGH->chiTietSanPham->gia, 0, '.', '.') }} VND</td>
                                <td>
                                    <form action="{{ route('client.giohang.delete', ['ma_chi_tiet_gio_hang' => $chiTietGH->ma_chi_tiet_gio_hang]) }}" method="POST">
                                        @csrf
                                        @method('DELETE') <!-- Phương thức DELETE -->
                                        <button class="btn btn-outline-danger rounded-1"><i class="fa-regular fa-trash-can"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="row">
                            <div class="col-lg-10 d-flex justify-content-end align-items-center">
                                <p class="mb-0">Tổng thanh toán: <strong class="text-danger">{{ number_format($tongThanhToan, 0, '.', '.') }} VND</strong></p>
                            </div>
                            <div class="col-lg-2">
                                <form action="{{ route('client.giohang.buy-from-cart') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100 py-2 rounded-5">Mua hàng</button>
                                </form>
                            </div>
                        </div>

                        @else
                        <p class="d-flex justify-content-center align-items-center">Không có sản phẩm nào trong giỏ hàng!</p>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection