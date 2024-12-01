@extends('admin.layouts.app')
@section('title', 'Quản lý danh mục')
@section('content')

<form action="" method="POST">
    <div class="form-group">
        <label for="category">Tên danh mục</label>
        <div class="d-flex">
            <input type="text" name="ten_danh_muc" class="form-control mr-3" placeholder="Nhập tên danh mục">
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
        @error('ten_danh_muc')
            <p class="text-danger"> {{ $message }}</p>
            @enderror
    </div>
    @csrf
</form>
<table class="table table-hover">
    <tr>
        <th>Mã danh mục</th>
        <th>Tên danh mục</th>
        <th></th>
    </tr>
    @foreach ($dsDanhMuc as $danhmuc)
    <tr>
        <td>{{ $danhmuc->ma_danh_muc }}</td>
        <td>{{ $danhmuc->ten_danh_muc }}</td>
        <td>
            <a href="/admin/danhmuc/update/{{ $danhmuc->ma_danh_muc }}" class="btn btn-warning">Sửa</a>
            <form id="delete-form-{{ $danhmuc->ma_danh_muc }}" action="/admin/danhmuc/delete/{{ $danhmuc->ma_danh_muc }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $danhmuc->ma_danh_muc }}')">Xóa</button>
            </form>
            <script>
                function confirmDelete(id) {
                    if (confirm('Bạn có muốn xóa Danh mục này?')) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                }
            </script>
        </td>
    </tr>
    @endforeach
</table>
{{ $dsDanhMuc->links() }}

@endsection