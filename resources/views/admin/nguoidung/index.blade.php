@extends('admin.layouts.app')
@section('title', 'Quản lý người dùng')
@section('content')
<div class="table-responsive">
    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Số đơn hàng</th>
                <th>Mở khóa/ Khóa tài khoản</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dsNguoiDung as $nguoiDung)
            <tr>
                <td>{{ $nguoiDung->ten_nguoi_dung }}</td>
                <td>{{ $nguoiDung->email }}</td>
                <td>{{ $nguoiDung->soDonHang() }}</td>
                <td>
                    @if ($nguoiDung->trashed())
                    <form action="{{ route('admin.nguoidung.restore', ['ma_nguoi_dung' => $nguoiDung->ma_nguoi_dung]) }}"
                        method="POST"
                        id="restore-form"
                        style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-restore btn-primary mb-2 text-truncate" onclick="confirmRestore()">Mở khóa</button>
                    </form>
                    @else
                    <form action="{{ route('admin.nguoidung.delete', ['ma_nguoi_dung' => $nguoiDung->ma_nguoi_dung]) }}"
                        method="POST"
                        id="delete-form"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mb-2 text-truncate" onclick="confirmDelete()">Khóa</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    function confirmDelete(id) {
        if (confirm('Bạn chắc chắn muốn khóa tài khoản này?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }

    function confirmRestore(id) {
        if (confirm('Bạn chắc chắn muốn mở khóa tài khoản này?')) {
            document.getElementById('restore-form-' + id).submit();
        }
    }
</script>
@endsection