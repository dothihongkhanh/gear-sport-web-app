@extends('client.layouts.app')
@section('title', 'Chi tiết - ' . $sanPham->ten_san_pham)
@section('content')
<section class="bg-light">
    <div class="container pb-5">
        <p><a href="/" class="text-decoration-none">Trang chủ</a><span class="text-primary"> / {{ $sanPham->ten_san_pham }}</span></p>
        <div class="row">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm mb-3">
                    <img class="card-img img-fluid" id="product-detail-image" src="{{ $sanPham->hinh_anh }}">
                </div>

                <div class="row">
                    <div class="col-1 align-self-center">
                        <a href="#multi-item-example" role="button" data-bs-slide="prev">
                            <i class="text-dark fas fa-chevron-left"></i>
                            <span class="sr-only">Trước</span>
                        </a>
                    </div>
                    <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                        <div class="carousel-inner product-links-wap" role="listbox">
                            @foreach($sanPham->chiTietSanPham->chunk(3) as $key => $chiTietChunk)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <div class="row">
                                    @foreach($chiTietChunk as $chiTiet)
                                    <div class="col-4">
                                        <a href="#">
                                            <img class="card-img img-fluid shadow-sm" src="{{ $chiTiet->hinh_anh_chi_tiet }}" alt="Product Detail Image">
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-1 align-self-center">
                        <a href="#multi-item-example" role="button" data-bs-slide="next">
                            <i class="text-dark fas fa-chevron-right"></i>
                            <span class="sr-only">Sau</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h1 class="h2 fw-nomal">{{ $sanPham->ten_san_pham }}</h1>
                        <p class="h3 py-2 text-danger" id="product-price">
                            {{ number_format($sanPham->chiTietSanPham->first()->gia, 0, '.', '.') }} VND
                        </p>
                        <p class="fw-bold">Thương hiệu: {{ $sanPham->thuongHieu->ten_thuong_hieu }}</p>
                        <p class="fw-bold">Danh mục: {{ $sanPham->danhMuc->ten_danh_muc }}</p>
                        <p class="fw-bold">Số lượng: <span id="product-quantity">{{ $sanPham->tongSoLuong() }}</span></p>

                        @if(isset($sanPham->mo_ta))
                        <h6>Mô tả:</h6>
                        <p>{{ $sanPham->mo_ta }}</p>
                        @endif
                        <form action="" method="GET" id="product-form">
                            @if($sanPham->chiTietSanPham->count() > 1 || ($sanPham->chiTietSanPham->count() == 1 && $sanPham->chiTietSanPham->first()->thuoc_tinh != null))
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item">Thuộc tính:</li>
                                        @foreach($sanPham->chiTietSanPham as $chiTiet)
                                        @if($chiTiet->thuoc_tinh != null)
                                        <li class="list-inline-item">
                                            <span class="btn btn-success btn-size 
                                @if($chiTiet->hetHang()) 
                                    text-muted disabled
                                @endif"
                                                data-gia="{{ $chiTiet->gia }}"
                                                data-hinh="{{ $chiTiet->hinh_anh_chi_tiet }}"
                                                data-so-luong="{{ $chiTiet->so_luong }}"
                                                onclick="changeProductDetails(this)">
                                                {{ $chiTiet->thuoc_tinh }}
                                            </span>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-primary rounded-1 p-2 btn-lg" name="submit" value="buy" id="buy-btn">Mua ngay</button>
                                </div>
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-outline-primary rounded-1 p-2 btn-lg" name="submit" value="addtocard" id="add-to-cart-btn">Thêm vào giỏ hàng</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    let selectedAttribute = null; // Biến cờ để theo dõi thuộc tính đã chọn

    function changeProductDetails(element) {
        let newPrice = element.getAttribute('data-gia');
        let newImage = element.getAttribute('data-hinh');
        let newQuantity = element.getAttribute('data-so-luong');
        let formattedPrice = parseInt(newPrice).toLocaleString('vi-VN') + ' VND';

        // Update price
        document.getElementById('product-price').innerText = formattedPrice;

        // Update image
        document.getElementById('product-detail-image').src = newImage;

        // Update quantity
        document.getElementById('product-quantity').innerText = newQuantity;

        // Gắn lại thuộc tính đã chọn
        selectedAttribute = element;

        // Remove 'active' class from all attributes
        let allAttributes = document.querySelectorAll('.btn-size');
        allAttributes.forEach(function(attribute) {
            attribute.classList.remove('active');
        });

        // Add 'active' class to the selected attribute
        element.classList.add('active');
    }

    // Kiểm tra khi gửi form để chắc chắn rằng người dùng đã chọn thuộc tính
    document.getElementById('product-form').addEventListener('submit', function(event) {
        if (selectedAttribute === null) {
            event.preventDefault(); // Ngừng hành động gửi form
            alert("Vui lòng chọn một thuộc tính sản phẩm!"); // Hiển thị thông báo
        }
    });
</script>



@endsection