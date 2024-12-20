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
                        <p class="fw-bold">Số lượng còn: <span id="product-quantity-display">{{ $sanPham->tongSoLuong() }}</span></p>

                        @if(isset($sanPham->mo_ta))
                        <h6>Mô tả:</h6>
                        <p>{{ $sanPham->mo_ta }}</p>
                        @endif
                        <form action="" method="POST" id="product-form">
                            @csrf
                            <input type="hidden" name="ma_san_pham" value="{{ $sanPham->ma_san_pham }}">
                            @if($sanPham->chiTietSanPham->count() > 1 || ($sanPham->chiTietSanPham->count() == 1 && $sanPham->chiTietSanPham->first()->thuoc_tinh != null))
                            <input type="hidden" id="selected-attribute" name="ma_chi_tiet_san_pham" value="">
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline">
                                        <li class="list-inline-item fw-bold">Thuộc tính:</li>
                                        @foreach($sanPham->chiTietSanPham as $chiTiet)
                                        @if($chiTiet->thuoc_tinh != null)
                                        <li class="list-inline-item">
                                            <span class="btn btn-outline-dark btn-size 
                                @if($chiTiet->hetHang()) 
                                    text-muted disabled
                                @endif"
                                                data-gia="{{ $chiTiet->gia }}"
                                                data-hinh="{{ $chiTiet->hinh_anh_chi_tiet }}"
                                                data-so-luong="{{ $chiTiet->so_luong }}"
                                                data-ma-chi-tiet="{{ $chiTiet->ma_chi_tiet_san_pham }}"
                                                onclick="changeProductDetails(this)">
                                                {{ $chiTiet->thuoc_tinh }}
                                            </span>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline">
                                        <li class="list-inline-item fw-bold">Số lượng:</li>
                                        <li class="list-inline-item">
                                            <input type="number" name="so_luong" min="1" value="1" id="product-quantity-input" max="1">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @else
                            <input type="hidden" name="ma_chi_tiet_san_pham" value={{ $sanPham->chiTietSanPham->first()->ma_chi_tiet_san_pham }}>
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline">
                                        <li class="list-inline-item fw-bold">Số lượng:</li>
                                        <li class="list-inline-item">
                                            <input type="number" name="so_luong" min="1" value="1" max="{{ $sanPham->chiTietSanPham->isNotEmpty() ? $sanPham->chiTietSanPham->first()->so_luong : 1 }}">
                                        </li>
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
        let attributeId = element.getAttribute('data-ma-chi-tiet'); // Lấy mã chi tiết sản phẩm
        let formattedPrice = parseInt(newPrice).toLocaleString('vi-VN') + ' VND';

        // Cập nhật thông tin giá và hình ảnh
        document.getElementById('product-price').innerText = formattedPrice;
        document.getElementById('product-detail-image').src = newImage;
        document.getElementById('product-quantity-display').innerText = newQuantity;

        // Cập nhật giá trị max cho input số lượng
        let quantityInput = document.getElementById('product-quantity-input');
        quantityInput.max = newQuantity; // Cập nhật max thành số lượng còn lại

        selectedAttribute = element;

        // Cập nhật trạng thái của các thuộc tính
        let allAttributes = document.querySelectorAll('.btn-size');
        allAttributes.forEach(function(attribute) {
            attribute.classList.remove('active');
        });
        element.classList.add('active');

        // Cập nhật giá trị của input hidden cho ma_chi_tiet_san_pham
        document.getElementById('selected-attribute').value = attributeId;
    }

    document.getElementById('product-form').addEventListener('submit', function(e) {
        const selectedAttribute = document.getElementById('selected-attribute').value;

        // Kiểm tra nếu sản phẩm có nhiều thuộc tính nhưng không có thuộc tính nào được chọn
        if (selectedAttribute === "" && document.querySelectorAll('.btn-size').length > 0) {
            e.preventDefault(); // Ngăn form gửi đi
            alert('Vui lòng chọn một thuộc tính!');
            return;
        }
    });

    // JavaScript để thay đổi action của form khi người dùng nhấn nút
    document.getElementById('buy-btn').addEventListener('click', function() {
        document.getElementById('product-form').action = "{{ route('client.buy') }}"; // Route cho hành động mua ngay
        document.getElementById('product-form').submit(); // Gửi form
    });

    document.getElementById('add-to-cart-btn').addEventListener('click', function() {
        document.getElementById('product-form').action = "{{ route('client.addtocart') }}"; // Route cho hành động thêm vào giỏ hàng
        document.getElementById('product-form').submit(); // Gửi form
    });
</script>




@endsection