@extends('admin.layouts.app')
@section('title', $sanPham->ten_san_pham)
@section('content')

<p><a href="{{ route('admin.sanpham') }}">Danh sách sản phẩm </a>/ <b>{{ $sanPham->ten_san_pham }}</b></p>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Thêm chi tiết sản phẩm</label>
        <div id="detail-container">
            <div class="row detail-row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Thuộc tính<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="thuoc_tinh" placeholder="Nhập thuộc tính">
                        @error('thuoc_tinh')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Giá<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="gia" placeholder="Nhập giá">
                        @error('gia')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Số lượng<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="so_luong" placeholder="Nhập số lượng">
                        @error('so_luong')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <input type="file" name="hinh_anh_chi_tiet" accept="image/*" class="image-input-detail form-control" data-image-id="detail-image-0">
                        <input type="hidden" name="" id="avt-detail-hidden-0" value="">
                        <img src="" class="show-image-detail" alt="" width="80px">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </div>
    @csrf
</form>
@if ($sanPham->chiTietSanPham->isNotEmpty())
<table class="table table-hover">
    <tr>
        <th>Hình ảnh</th>
        <th>Thuộc tính</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th></th>
    </tr>
    @foreach ($sanPham->chiTietSanPham as $chiTiet)
    <tr>
        <td><img src="{{ $chiTiet->hinh_anh_chi_tiet }}" width="120px" height="120px" alt=""></td>
        <td>{{ $chiTiet->thuoc_tinh }}</td>
        <td>{{ number_format($chiTiet->gia, 0, '.', '.') }} VND</td>
        <td>{{ $chiTiet->so_luong }}
        <td>
            @if ($chiTiet->trashed())
            <form action="{{ route('admin.sanpham.restore-detail', ['ma_chi_tiet_san_pham' => $chiTiet->ma_chi_tiet_san_pham]) }}"
                method="POST" style="display: inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-restore btn-primary">Mở khóa</button>
            </form>
            @else
            <form action="{{ route('admin.sanpham.delete-detail', ['ma_chi_tiet_san_pham' => $chiTiet->ma_chi_tiet_san_pham]) }}"
                method="POST"
                style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Khóa</button>
            </form>
            @endif
        </td>
    </tr>
    @endforeach
</table>
<!-- <form action="/admin/products/delete-all-details/{id}" method="POST" style="display: inline;" id="deleteAllForm">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-delete btn-danger" onclick="confirmDeleteAll('{{ $sanPham->id }}')">Delete all</button>
</form> -->
@else
<p>Không có thông tin chi tiết cho sản phẩm này!</p>
@endif
<!-- <script>
    function confirmDelete(detailId) {
        if (confirm('Are you sure you want to delete this detail?')) {
            var form = document.createElement('form');
            form.action = `/admin/products/delete-details/${detailId}`;
            form.method = 'POST';
            form.style.display = 'none';

            var csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            var methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            document.body.appendChild(form);
            form.submit();
        }
    }

    function confirmDeleteAll(productId) {
        if (confirm('Are you sure you want to delete all details?')) {
            var form = document.getElementById('deleteAllForm');
            form.action = "/admin/products/delete-all-details/" + productId;
            form.submit();
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="/template/admin/js/product.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="/template/admin/js/product.js"></script>
@endsection