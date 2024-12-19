@extends('client.layouts.app')
@section('title', 'Thanh toán đơn hàng')
@section('content')
<section class="bg-light">
    <form action="{{ route('client.donhang.luu') }}" method="POST">
        @csrf
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-8 mt-4">
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-white text-primary">Thông tin sản phẩm</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card border-0 shadow-sm mb-3">
                                        <img class="card-img img-fluid" id="product-detail-image" src="{{ $sanPham->hinh_anh }}">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <p>Tên sản phẩm: <span class="fw-bold">{{ $sanPham->ten_san_pham}}</span></p>
                                    @if($sanPham->chiTietSanPham->count() > 1 || ($sanPham->chiTietSanPham->count() == 1 && $sanPham->chiTietSanPham->first()->thuoc_tinh != null))
                                    <p>Thuộc tính: <span class="fw-bold">{{ $chiTietSanPham->thuoc_tinh }}</span></p>
                                    @endif
                                    <p>Đơn giá: <span class="fw-bold text-danger">{{ number_format($chiTietSanPham->gia, 0, '.', '.') }} VND</span></p>
                                    <p>Số lượng: <span class="fw-bold">{{ $soLuong }}</span></p>
                                    <p>Thành tiền: <span class="fw-bold text-danger">{{ number_format($soLuong*$chiTietSanPham->gia, 0, '.', '.') }} VND</span></p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-white text-primary">Thông tin giao hàng</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Tên người nhận<span class="text-danger">*</span></label>
                                    <input type="text" name="ten_nguoi_nhan" class="form-control border border-dark">
                                    @error('ten_nguoi_nhan')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label>Số điện thoại<span class="text-danger">*</span></label>
                                    <input type="number" name="sdt_nhan_hang" class="form-control border border-dark">
                                    @error('sdt_nhan_hang')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="">
                                <label>Địa chỉ nhận hàng<span class="text-danger">*</span></label>
                                <textarea name="dia_chi_nhan_hang" class="form-control border border-dark"></textarea>
                                @error('dia_chi_nhan_hang')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white text-primary">Thông tin thanh toán</div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between w-100">
                                <p class="mb-0">Tổng đơn hàng:</p>
                                <p class="mb-0 text-danger fw-bold">{{ number_format($soLuong*$chiTietSanPham->gia, 0, '.', '.') }} VND</p>
                            </div>
                            <p class="mb-1">Phương thức thanh toán:</p>
                            <select name="phuong_thuc_thanh_toan" class="form-select border border-dark">
                                <option value="Thanh toán khi nhận hàng" selected>Thanh toán khi nhận hàng</option>
                                <option value="VN Pay">Thanh toán qua VN Pay</option>
                            </select>
                            <button type="submit" class="btn btn-primary w-100 mt-4 py-2 rounded-5">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection