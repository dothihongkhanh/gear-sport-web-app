@extends('client.layouts.app')
@section('title', 'FitSmart - Trang chủ')
@section('content')

<section style="background-image: url('/template/client/images/banner-1.jpg');background-repeat: no-repeat;background-size: cover; background-position: center;  width: 100%; height: auto;">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-6 pt-5 mt-5">
                <h2 class="display-1 ls-1"><span class="fw-bold text-white">FitSmart</span></h2>
                <h3 class="display-2 ls-1 text-white">Đầu tư thông minh cho sức khỏe của bạn!</h3>

                <div class="d-flex gap-3 my-5">
                    <a href="#" class="btn btn-primary text-uppercase fs-6 rounded-pill px-4 py-3 mt-3">Mua ngay</a>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-3 g-0 justify-content-center">
            <div class="col">
                <div class="card border-0 bg-secondary rounded-0 p-4 text-light">
                    <div class="row">
                        <div class="col-md-3 d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-layer-group" style="font-size: 60px; width: 60px; height: 60px"></i>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body p-0">
                                <h5 class="text-light">Phụ kiện thể thao đa dạng </h5>
                                <p class="card-text">Từ dụng cụ tập gym, yoga đến phụ kiện chạy bộ, tất cả đều có tại FitSmart.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 bg-primary rounded-0 p-4 text-light">
                    <div class="row">
                        <div class="col-md-3 d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-store" style="font-size: 60px; width: 60px; height: 60px"></i>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body p-0">
                                <h5 class="text-light">Cam kết 100% hàng chính hãng</h5>
                                <p class="card-text">Chỉ cung cấp sản phẩm chính hãng, chất lượng cao, đảm bảo uy tín.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 bg-secondary rounded-0 p-4 text-light">
                    <div class="row">
                        <div class="col-md-3 d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-truck" style="font-size: 60px; width: 60px; height: 60px"></i>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body p-0">
                                <h5 class="text-light">Miễn phí vận chuyển</h5>
                                <p class="card-text">Không lo phí ship, FitSmart giao hàng tận nơi, nhanh chóng và tiện lợi!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="py-3 overflow-hidden">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-12">

                <div class="section-header d-flex flex-wrap justify-content-between mb-2">
                    <h3 class="section-title border-bottom border-primary border-3">Thương hiệu</h3>
                    <div class="d-flex align-items-center">
                        <div class="swiper-buttons">
                            <button class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
                            <button class="swiper-next category-carousel-next btn btn-yellow">❯</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="category-carousel swiper">
                    <div class="swiper-wrapper">
                        @foreach($dsThuongHieu as $thuongHieu)
                        <a href="/" class="nav-link swiper-slide text-center">
                            <span class="fs-4 fw-normal category-title text-dark">{{ $thuongHieu->ten_thuong_hieu }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pb-3">
    <div class="container-lg">

        <div class="row">
            <div class="col-md-12">

                <div class="section-header d-flex flex-wrap justify-content-between my-4">
                    <h3 class="section-title border-bottom border-primary border-3">Sản phẩm mới</h3>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
                    @foreach($sanPhamTop5 as $sanPham)
                    <div class="col">
                        <div class="product-item border border-2 d-flex flex-column" style="height: 350px;">
                            <figure>
                                <a href="index.html" title="{{ $sanPham->ten_san_pham }}">
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
                                        <div class="col-6">
                                            <a href="#" class="btn btn-primary rounded-1 p-2 fs-7">
                                                <i class="fa fa-shopping-cart"></i>
                                                Thêm
                                            </a>
                                        </div>
                                        <div class="col-6"><a href="{{ route('client.sanpham.detail', ['ma_san_pham' => $sanPham->ma_san_pham]) }}" class="btn btn-outline-primary rounded-1 p-2 fs-7"><i class="fa fa-eye"></i> Xem chi tiết</a>
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
</section>

@foreach($dsDanhMuc as $danhMuc)
@if($danhMuc->sanPham->isNotEmpty())
<section id="featured-products" class="products-carousel">
    <div class="container-lg overflow-hidden pb-5">
        <div class="row">
            <div class="col-md-12">

                <div class="section-header d-flex flex-wrap justify-content-between my-4">

                    <h3 class="section-title border-bottom border-primary border-2">{{ $danhMuc->ten_danh_muc }}</h3>
                    <div class="d-flex align-items-center">
                        <a href="#" class="btn btn-primary me-2">Xem tất cả</a>
                        <div class="swiper-buttons">
                            <button class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                            <button class="swiper-next products-carousel-next btn btn-primary">❯</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach($danhMuc->sanPham as $sanPham)
                        <div class="product-item swiper-slide border border-2 d-flex flex-column" style="height: 350px;">
                            <figure class="flex-grow-1">
                                <a href="" title="{{ $sanPham->ten_san_pham }}">
                                    <img src="{{ $sanPham->hinh_anh }}" alt="{{ $sanPham->ten_san_pham }}" class="img-fluid" style="width: 200px; height: 200px; object-fit: cover;">
                                </a>
                            </figure>
                            <div class="d-flex flex-column text-center flex-grow-1">
                                <h6 class="fw-normal">{{ $sanPham->ten_san_pham }}</h6>
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <span class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">{{ $sanPham->thuongHieu->ten_thuong_hieu }}</span>
                                    <span class="text-danger fw-semibold">{{ number_format($sanPham->chiTietSanPham->first()->gia, 0, '.', '.') }} VND</span>
                                </div>
                                <div class="button-area p-3 pt-0 mt-auto">
                                    <div class="row g-1 mt-2">
                                        <div class="col-6">
                                            <a href="#" class="btn btn-primary rounded-1 p-2 fs-7">
                                                <i class="fa fa-shopping-cart"></i>
                                                Thêm
                                            </a>
                                        </div>
                                        <div class="col-6"><a href="{{ route('client.sanpham.detail', ['ma_san_pham' => $sanPham->ma_san_pham]) }}" class="btn btn-outline-primary rounded-1 p-2 fs-7"><i class="fa fa-eye"></i> Xem chi tiết</a>
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
</section>
@endif
@endforeach

<section class="py-5 h-100">
    <div class="container-lg">
        <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-5">
            <div class="col">
                <div class="card mb-3 border border-dark-subtle p-3 h-100">
                    <div class="text-dark mb-2 text-center">
                        <i class="fa-solid fa-truck"></i>
                    </div>
                    <div class="card-body p-0">
                        <h5>Miễn phí vận chuyển</h5>
                        <p class="card-text">Không lo phí ship, FitSmart giao hàng tận nơi, nhanh chóng và tiện lợi!</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3 border border-dark-subtle p-3 h-100">
                    <div class="text-dark mb-2 text-center">
                        <i class="fa-solid fa-store"></i>
                    </div>
                    <div class="card-body p-0">
                        <h5>Cam kết 100% hàng chính hãng</h5>
                        <p class="card-text">Chỉ cung cấp sản phẩm chính hãng, chất lượng cao, đảm bảo uy tín.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3 border border-dark-subtle p-3 h-100">
                    <div class="text-dark mb-2 text-center">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <div class="card-body p-0">
                        <h5>Tư vấn kế hoạch tập luyện cá nhân hóa hoàn toàn miễn phí!</h5>
                        <p class="card-text">Đội ngũ trợ lý ảo hỗ trợ xây dựng kế hoạch luyện tập phù hợp với mục tiêu của bạn.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3 border border-dark-subtle p-3 h-100">
                    <div class="text-dark mb-2 text-center">
                        <i class="fa-solid fa-right-left"></i>
                    </div>
                    <div class="card-body p-0">
                        <h5>Đổi trả dễ dàng trong 7 ngày</h5>
                        <p class="card-text">Hài lòng hoặc hoàn tiền, đảm bảo quyền lợi tối đa cho khách hàng.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3 border border-dark-subtle p-3 h-100">
                    <div class="text-dark mb-2 text-center">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div class="card-body p-0">
                        <h5>Phụ kiện thể thao đa dạng</h5>
                        <p class="card-text">Từ dụng cụ tập gym, yoga đến phụ kiện chạy bộ, tất cả đều có tại FitSmart.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection