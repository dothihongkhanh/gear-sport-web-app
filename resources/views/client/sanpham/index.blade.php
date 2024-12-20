@extends('client.layouts.app')
@section('title', 'Danh sách sản phẩm')
@section('content')
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-12 mt-4">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-white text-primary">Danh sách sản phẩm</div>
                    <div class="card-body pb-5">
                        <div class="row mb-4">
                            <div class="col-3">
                                <form action="{{ route('client.filter.products') }}" method="GET">
                                    <div class="form-group">
                                        <select name="ma_danh_muc" class="form-select border border-dark" onchange="this.form.submit()">
                                            <option value="0">-- Danh mục --</option>
                                            @foreach($dsDanhMuc as $danhMuc)
                                            <option value="{{ $danhMuc->ma_danh_muc }}">
                                                {{ $danhMuc->ten_danh_muc }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="col-3">
                                <form action="{{ route('client.filter.products') }}" method="GET">
                                    <div class="form-group">
                                        <select name="ma_thuong_hieu" class="form-select border border-dark" onchange="this.form.submit()">
                                            <option value="">-- Thương hiệu --</option>
                                            @foreach($dsThuongHieu as $thuongHieu)
                                            <option value="{{ $thuongHieu->ma_thuong_hieu }}">
                                                {{ $thuongHieu->ten_thuong_hieu }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
                                    @foreach($dsSanPham as $sanPham)
                                    <div class="col">
                                        <div class="product-item border border-2 d-flex flex-column" style="height: 350px;">
                                            <figure>
                                                <a href="{{ route('client.sanpham.detail', ['ma_san_pham' => $sanPham->ma_san_pham]) }}" title="{{ $sanPham->ten_san_pham }}">
                                                    <img src="{{ $sanPham->hinh_anh }}" alt="{{ $sanPham->ten_san_pham }}" class="img-fluid" style="width: 200px; height: 200px; object-fit: cover;">
                                                </a>
                                            </figure>
                                            <div class="d-flex flex-column text-center">
                                                <h3 class="fs-6 fw-normal">{{ $sanPham->ten_san_pham }}</h3>
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    <span class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">{{ $sanPham->thuongHieu->ten_thuong_hieu }}</span>
                                                    <span class="text-danger fw-semibold">{{ number_format($sanPham->chiTietSanPham->first()->gia, 0, '.', '.') }} VND</span>
                                                </div>
                                                <div class="button-area p-3 pt-0">
                                                    <div class="row g-1 mt-2">
                                                        <div class="col-12"><a href="{{ route('client.sanpham.detail', ['ma_san_pham' => $sanPham->ma_san_pham]) }}" class="btn btn-outline-primary rounded-1 p-2 fs-7"><i class="fa fa-eye"></i> Xem chi tiết</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection