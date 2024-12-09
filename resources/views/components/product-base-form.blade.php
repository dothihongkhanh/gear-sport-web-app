<div>
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
    </div>
    <div class="form-group">
        <label>Mô tả</label>
        <textarea name="mo_ta" class="form-control">{{ old('mo_ta') }}</textarea>
    </div>
    <div class="form-group">
        <label>Hình ảnh<span class="text-danger">*</span></label>
        <input type="file" accept="image/*" name="hinh_anh" class="form-control">
    </div>
</div>