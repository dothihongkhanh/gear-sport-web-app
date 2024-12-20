@extends('client.layouts.app')
@section('title', 'Tìm kiếm - ' . $query)
@section('content')
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-12 mt-4">
                <div class="card border-0 shadow-sm mb-3">
                    @if(count($dsSanPham) > 0)
                    <div class="card-header bg-white text-primary">Kết quả tìm được</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
                                    @foreach($dsSanPham as $sanPham)
                                    <div class="col">
                                        <div class="product-item border border-2 d-flex flex-column">
                                            <a href="{{ route('client.sanpham.detail', ['ma_san_pham' => $sanPham->ma_san_pham]) }}" title="{{ $sanPham->ten_san_pham }}" class="text-decoration-none">
                                                <figure>

                                                    <img src="{{ $sanPham->hinh_anh }}" alt="{{ $sanPham->ten_san_pham }}" class="img-fluid" style="width: 200px; height: 200px; object-fit: cover;">

                                                </figure>
                                                <div class="d-flex flex-column text-center">
                                                    <h3 class="fs-6 fw-normal">{{ $sanPham->ten_san_pham }}</h3>
                                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                                        <span class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">{{ $sanPham->thuongHieu->ten_thuong_hieu }}</span>
                                                        <span class="text-danger fw-semibold">{{ number_format($sanPham->chiTietSanPham->first()->gia, 0, '.', '.') }} VND</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                    @else
                    <h4 class="d-flex justify-content-center align-items-center py-3">Không tìm thấy kết quả!</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection