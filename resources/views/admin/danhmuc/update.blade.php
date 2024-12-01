@extends('admin.layouts.app')
@section('title', 'Cập nhật - ' . $danhMuc->ten_danh_muc)
@section('content')

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label>Tên danh mục<span class="text-danger">*</span></label>
                <input type="text" name="sua_ten_danh_muc" class="form-control" placeholder="Nhập tên danh mục" value="{{ $danhMuc->ten_danh_muc }}">
                @error('sua_ten_danh_muc')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Lưu</button>
        </form>
    </div>
</div>
@endsection