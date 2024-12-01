@extends('admin.layouts.app')
@section('title', 'Cập nhật - ' . $thuongHieu->ten_thuong_hieu)
@section('content')

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label>Tên thương hiệu<span class="text-danger">*</span></label>
                <input type="text" name="sua_ten_thuong_hieu" class="form-control" placeholder="Nhập tên thương hiệu" value="{{ $thuongHieu->ten_thuong_hieu }}">
                @error('sua_ten_thuong_hieu')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Lưu</button>
        </form>
    </div>
</div>
@endsection