@extends('admin.layouts.app')
@section('title', 'Cập nhật sản phẩm - ' . $sanPham->ten_san_pham)
@section('content')
<a href="{{ route('admin.sanpham') }}" class="mb-4"><i class="nav-icon fas fa-arrow-left mr-2"></i>Danh sách sản phẩm</a>
<form action="{{ route('update', ['ma_san_pham' => $sanPham->ma_san_pham]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="">
        <div class="form-group">
            <label>Danh mục<span class="text-danger">*</span></label>
            <select class="form-control" name="ma_danh_muc">
                @foreach($dsDanhMuc as $danhmuc)
                <option value="{{ $danhmuc->ma_danh_muc }}" {{ $sanPham->ma_danh_muc == $danhmuc->ma_danh_muc ? 'selected' : '' }}>{{ $danhmuc->ten_danh_muc }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Thương hiệu<span class="text-danger">*</span></label>
            <select class="form-control" name="ma_thuong_hieu">
                @foreach($dsThuongHieu as $thuonghieu)
                <option value="{{ $thuonghieu->ma_thuong_hieu }}" {{ $sanPham->ma_thuong_hieu == $thuonghieu->ma_thuong_hieu ? 'selected' : '' }}>{{ $thuonghieu->ten_thuong_hieu }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tên sản phẩm<span class="text-danger">*</span></label>
            <input type="text" name="ten_san_pham" class="form-control" placeholder="Nhập tên sản phẩm" value="{{ $sanPham->ten_san_pham }}">
            @error('ten_san_pham')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label>Mô tả<span class="text-danger">*</span></label>
            <textarea name="mo_ta" class="form-control">{{ $sanPham->mo_ta }}</textarea>
            @error('mo_ta')
            <span class="text-danger"> {{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label>Hình ảnh<span class="text-danger">*</span></label>
            <input type="file" accept="image/*" name="hinh_anh" id="image-input" class="form-control">
            <img src="{{ $sanPham->hinh_anh }}" id="show-image" alt="" width="150px">
            @error('hinh_anh')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <div id="detail-container">
                @foreach ($sanPham->chiTietSanPham as $index => $chiTiet)
                <label>Chi tiết sản phẩm</label>
                <div class="row detail-row">
                    <input type="hidden" name="chiTietSanPham[{{ $index }}][ma_chi_tiet_san_pham]" value="{{ $chiTiet->ma_chi_tiet_san_pham }}">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Thuộc tính<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="chiTietSanPham[{{ $index }}][thuoc_tinh]" placeholder="Nhập thuộc tính" value="{{ $chiTiet->thuoc_tinh }}">
                            @error('chiTietSanPham.*.thuoc_tinh')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Giá<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="chiTietSanPham[{{ $index }}][gia]" placeholder="Nhập giá" value="{{ $chiTiet->gia }}">
                            @error('chiTietSanPham.*.gia')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Số lượng<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="chiTietSanPham[{{ $index }}][so_luong]" placeholder="Nhập số lượng" value="{{ $chiTiet->so_luong }}">
                            @error('chiTietSanPham.*.so_luong')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label>Hình ảnh</label>
                        <input type="file" name="chiTietSanPham[{{ $index }}][hinh_anh_chi_tiet]" accept="image/*" class="image-input-detail form-control">
                        <input type="hidden" name="chiTietSanPham[{{ $index }}][hinh_anh_chi_tiet_an]" value="{{ $chiTiet->hinh_anh_chi_tiet }}">
                        <img src="{{ $chiTiet->hinh_anh_chi_tiet }}" class="show-image-detail" alt="" width="80px">
                    </div>
                    <div class="col-sm-1">

                    </div>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    </div>

    <div style="border-top: 1px solid rgba(0, 0, 0);">
        <button type="submit" class="btn btn-primary mt-3">Lưu thay đổi</button>
    </div>

</form>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="/template/admin/js/product.js"></script>
@endsection