@extends('admin.layouts.app')
@section('title', 'Thêm sản phẩm')
@section('content')
<a href="{{ route('admin.sanpham') }}" class="mb-4"><i class="nav-icon fas fa-arrow-left mr-2"></i>Danh sách sản phẩm</a>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="">
        <div class="form-group">
            <label>Danh mục<span class="text-danger">*</span></label>
            <select class="form-control" name="ma_danh_muc">
                @foreach($dsDanhMuc as $danhMuc)
                <option value="{{ $danhMuc->ma_danh_muc }}">{{ $danhMuc->ten_danh_muc }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Thương hiệu<span class="text-danger">*</span></label>
            <select class="form-control" name="ma_thuong_hieu">
                @foreach($dsThuongHieu as $thuongHieu)
                <option value="{{ $thuongHieu->ma_thuong_hieu }}">{{ $thuongHieu->ten_thuong_hieu }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tên sản phẩm<span class="text-danger">*</span></label>
            <input type="text" name="ten_san_pham" class="form-control" placeholder="Nhập tên sản phẩm" value="{{ old('ten_san_pham') }}">
            @error('ten_san_pham')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="mo_ta" class="form-control">{{ old('mo_ta') }}</textarea>
            @error('mo_ta')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Hình ảnh <span class="text-danger">*</span></label>
            <input type="file" accept="image/*" name="hinh_anh" id="image-input" class="form-control">
            <img src="" id="show-image" alt="" width="150px">
            @error('hinh_anh')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div style="border-top: 1px solid rgba(0, 0, 0);">
        <button type="submit" class="btn btn-primary mt-2">Lưu</button>
    </div>
    @csrf
</form>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="/template/admin/js/product.js"></script>
@endsection