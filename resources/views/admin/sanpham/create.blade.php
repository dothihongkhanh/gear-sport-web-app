@extends('admin.layouts.app')
@section('title', 'Thêm sản phẩm')
@section('content')
<a href="{{ route('admin.sanpham') }}" class="mb-4"><i class="nav-icon fas fa-arrow-left mr-2"></i>Danh sách sản phẩm</a>
<ul class="nav nav-tabs" id="productTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="hasDetailsTab" data-bs-toggle="tab" href="#hasDetailsContent" role="tab" aria-controls="hasDetailsContent">Có chi tiết</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="noDetailsTab" data-bs-toggle="tab" href="#noDetailsContent" role="tab" aria-controls="noDetailsContent">Không có chi tiết</a>
    </li>
</ul>
<div class="tab-content mt-3">
    <div class="tab-pane fade show active" id="hasDetailsContent" role="tabpanel" aria-labelledby="hasDetailsTab">
        <form action="{{ route('admin.sanpham.create-with-details') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="tab_selected" id="tab_selected" value="hasDetailsContent">
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
                    <label>Hình ảnh<span class="text-danger">*</span></label>
                    <input type="file" accept="image/*" name="hinh_anh" class="image-input form-control" id="image-input-1">
                    <img src="" class="show-image" alt="" width="150px" id="show-image-1" style="display:none;">
                    @error('hinh_anh')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Các chi tiết sản phẩm -->
                <div class="form-group">
                    <label>Chi tiết sản phẩm</label>
                    <div id="detail-container">
                        <div class="row detail-row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Thuộc tính<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="chiTietSanPham[0][thuoc_tinh]" placeholder="Nhập thuộc tính" value="{{ old('chiTietSanPham[0][thuoc_tinh]') }}">
                                    @error('chiTietSanPham.*.thuoc_tinh')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Giá<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="chiTietSanPham[0][gia]" placeholder="Nhập giá" value="{{ old('chiTietSanPham[0][gia]') }}">
                                    @error('chiTietSanPham.*.gia')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Số lượng<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="chiTietSanPham[0][so_luong]" placeholder="Nhập số lượng" value="{{ old('chiTietSanPham[0][so_luong]') }}">
                                    @error('chiTietSanPham.*.so_luong')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label>Hình ảnh</label>
                                <input type="file" name="chiTietSanPham[0][hinh_anh_chi_tiet]" accept="image/*" class="image-input-detail form-control" data-image-id="detail-image-0">
                                <input type="hidden" name="chiTietSanPham[0][hinh_anh_chi_tiet_an]" id="avt-detail-hidden-0" value="">
                                <img src="" class="show-image-detail" alt="" width="80px">
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <a href="javascript:;" class="btn btn-success" id="add-new-detail">+</a>
                        </div>
                    </div>
                </div>
            </div>
            <div style="border-top: 1px solid rgba(0, 0, 0);">
                <button type="submit" class="btn btn-primary mt-2">Lưu co chi tiet</button>
            </div>
            @csrf
        </form>
    </div>
    <div class="tab-pane fade" id="noDetailsContent" role="tabpanel" aria-labelledby="noDetailsTab">
        <form action="{{ route('admin.sanpham.create-with-no-details') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="tab_selected" id="tab_selected" value="noDetailsContent">
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
                    <label>Hình ảnh<span class="text-danger">*</span></label>
                    <input type="file" accept="image/*" name="hinh_anh" class="image-input form-control" id="image-input-2">
                    <img src="" class="show-image" alt="" width="150px" id="show-image-2" style="display:none;">
                    @error('hinh_anh')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Giá<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="gia" placeholder="Nhập giá">
                    @error('gia')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Số lượng<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="so_luong" placeholder="Nhập số lượng">
                    @error('so_luong')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div style="border-top: 1px solid rgba(0, 0, 0);">
                <button type="submit" class="btn btn-primary mt-2">Lưu</button>
            </div>
            @csrf
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="/template/admin/js/product.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.nav-link').forEach(tab => {
        tab.addEventListener('click', function() {
            const activeTabId = this.getAttribute('href').substring(1);
            document.querySelectorAll('input[name="tab_selected"]').forEach(input => {
                input.value = activeTabId;
            });
        });
    });
</script>

@endsection