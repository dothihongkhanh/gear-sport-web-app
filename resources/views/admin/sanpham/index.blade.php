@extends('admin.layouts.app')
@section('title', 'Danh sách sản phẩm')
@section('content')
<a href="{{ route('admin.sanpham.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm</a>
<table class="table table-hover table-bordered">
    <tr>
        <th>Mã sản phẩm</th>
        <th>Hình ảnh</th>
        <th>Tên sản phẩm</th>
        <th>Mô tả</th>
        <th>Thương hiệu</th>
        <th>Danh mục</th>
        <th></th>
    </tr>
    @foreach ($dsSanPham as $sanPham)
    <tr>
        <td>{{ $sanPham->ma_san_pham }}</td>
        <td><img src="{{ $sanPham->hinh_anh }}" width="120px" height="120px" alt=""></td>
        <td>{{ $sanPham->ten_san_pham }}</td>
        <td>{{ $sanPham->mo_ta }}</td>
        <td>{{ $sanPham->thuongHieu->ten_thuong_hieu }}</td>
        <td>{{ $sanPham->danhMuc->ten_danh_muc }}</td>
        <td>
            <div class="d-flex flex-column">
                <a href="{{ route('admin.sanpham.detail', ['ma_san_pham' => $sanPham->ma_san_pham]) }}" class="btn btn-primary mb-2 w-100 text-truncate">Chi tiết</a>
                <a href="{{ route('admin.sanpham.update', ['ma_san_pham' => $sanPham->ma_san_pham]) }}" class="btn btn-warning mb-2 w-100 text-truncate">Sửa</a>

                @if ($sanPham->trashed())
                <form action="{{ route('admin.sanpham.restore', ['ma_san_pham' => $sanPham->ma_san_pham]) }}"
                    method="POST"
                    id="restore-form"
                    style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-restore btn-primary mb-2 w-100 text-truncate" onclick="confirmRestore()">Mở khóa</button>
                </form>
                @else
                <form action="{{ route('admin.sanpham.delete', ['ma_san_pham' => $sanPham->ma_san_pham]) }}"
                    method="POST"
                    id="delete-form"
                    style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mb-2 w-100 text-truncate" onclick="confirmDelete()">Khóa</button>
                </form>
                @endif
            </div>

            <script>
                function confirmDelete() {
                    if (confirm('Bạn có chắc chắn muốn khóa sản phẩm này?')) {
                        document.getElementById('delete-form').submit();
                    }
                }

                function confirmRestore() {
                    if (confirm('Bạn có chắc chắn muốn mở khóa sản phẩm này?')) {
                        document.getElementById('restore-form').submit();
                    }
                }
            </script>
        </td>
    </tr>
    @endforeach

</table>
{{ $dsSanPham->links() }}
@endsection