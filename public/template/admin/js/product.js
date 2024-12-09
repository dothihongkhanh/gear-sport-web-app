// add image
$(document).ready(function() {
    // Hàm đọc và hiển thị hình ảnh sau khi chọn
    var readURL = function(input, imageId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();  // Tạo một đối tượng FileReader để đọc ảnh

            reader.onload = function(e) {
                // Cập nhật thuộc tính src cho thẻ img và hiển thị hình ảnh
                $(imageId).attr('src', e.target.result);  // Đặt nguồn ảnh cho thẻ img
                $(imageId).show();  // Hiển thị ảnh
            }

            reader.readAsDataURL(input.files[0]);  // Đọc tệp ảnh thành chuỗi base64
        }
    }

    // Khi người dùng chọn ảnh, cập nhật ảnh cho thẻ img tương ứng
    $(".image-input").on('change', function() {
        var inputId = $(this).attr('id');  // Lấy id của input
        if (!inputId) return;  // Nếu id không hợp lệ thì dừng

        var imageId = '#show-image-' + inputId.replace('image-input-', '');  // Tạo id tương ứng cho img dựa trên id của input

        // Kiểm tra xem id của input có hợp lệ không
        if (inputId) {
            readURL(this, imageId);  // Cập nhật ảnh cho tab tương ứng
        }
    });
});



$(document).ready(function() {
    var detailIndex = 1;

    $('#add-new-detail').on('click', function() {
        // Tăng chỉ mục để đảm bảo tính duy nhất cho mỗi chi tiết
        var currentDetailIndex = detailIndex++;

        // Tạo một div mới chứa thông tin chi tiết sản phẩm
        var newDetailDiv = $('<div class="row detail-row" id="detail-row-' + currentDetailIndex + '"></div>');

        // Nội dung chi tiết sản phẩm
        newDetailDiv.html(`
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Thuộc tính<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="chiTietSanPham[${currentDetailIndex}][thuoc_tinh]" placeholder="Nhập thuộc tính">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Giá<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="chiTietSanPham[${currentDetailIndex}][gia]" placeholder="Nhập giá">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Số lượng<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="chiTietSanPham[${currentDetailIndex}][so_luong]" placeholder="Nhập số lượng">
                </div>
            </div>
            <div class="col-sm-3">
                <label>Hình ảnh</label>
                <input type="file" name="chiTietSanPham[${currentDetailIndex}][hinh_anh_chi_tiet]" accept="image/*" class="image-input-detail form-control" data-image-id="detail-image-${currentDetailIndex}">
                <input type="hidden" name="chiTietSanPham[${currentDetailIndex}][hinh_anh_chi_tiet_an]" id="avt-detail-hidden-${currentDetailIndex}" value="">
                <img src="" class="show-image-detail" alt="" width="80px">
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    <button type="button" class="btn btn-danger js-remove-row mt-4">x</button>
                </div>
            </div>
        `);

        // Thêm div mới vào detail-container
        $('#detail-container').append(newDetailDiv);

        // Cập nhật sự kiện change cho input file
        $('.image-input-detail:last').off('change').on('change', handleImageChange);

        // Cập nhật sự kiện xóa cho nút xóa
        newDetailDiv.find('.js-remove-row').on('click', function() {
            newDetailDiv.remove();
        });
    });

    // Sự kiện thay đổi của input file
    function handleImageChange() {
        var showImage = $(this).closest('.row').find('.show-image-detail');
        readURL(this, showImage);
    }

    // Hiển thị hình ảnh đã chọn
    function readURL(input, showImage) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                showImage.attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Cập nhật sự kiện change cho input file khi trang được tải
    $('.image-input-detail').on('change', handleImageChange);
});

