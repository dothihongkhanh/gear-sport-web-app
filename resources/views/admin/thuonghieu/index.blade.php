@extends('admin.layouts.app')
@section('title', 'Quản lý thương hiệu')
@section('content')

<form action="" method="POST">
    <div class="form-group">
        <label for="category">Tên thương hiệu</label>
        <div class="d-flex">
            <input type="text" name="ten_thuong_hieu" class="form-control mr-3" placeholder="Nhập tên thương hiệu">

            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
        @error('ten_thuong_hieu')
        <p class="text-danger"> {{ $message }}</p>
        @enderror
    </div>
    @csrf
</form>

<table class="table table-hover">
    <tr>
        <th>Mã thương hiệu</th>
        <th>Tên thương hiệu</th>
        <th></th>
    </tr>
    @foreach ($dsThuongHieu as $thuonghieu)
    <tr>
        <td>{{ $thuonghieu->ma_thuong_hieu }}</td>
        <td>{{ $thuonghieu->ten_thuong_hieu }}</td>
        <td>
            <a href="/admin/thuonghieu/update/{{ $thuonghieu->ma_thuong_hieu }}" class="btn btn-warning">Sửa</a>
            <form id="delete-form-{{ $thuonghieu->ma_thuong_hieu }}" action="/admin/thuonghieu/delete/{{ $thuonghieu->ma_thuong_hieu }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $thuonghieu->ma_thuong_hieu }}')">Xóa</button>
            </form>
            <script>
                function confirmDelete(id) {
                    if (confirm('Bạn có muốn xóa thương hiệu này?')) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                }
            </script>
        </td>
    </tr>
    @endforeach
</table>
{{ $dsThuongHieu->links() }}

@endsection