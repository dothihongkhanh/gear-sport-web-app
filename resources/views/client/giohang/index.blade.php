@extends('client.layouts.app')
@section('title', 'Giỏ hàng')
@section('content')
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-12 mt-4">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-white text-primary">Thông tin giỏ hàng</div>
                    <div class="card-body">
                        @foreach ($dsGioHang as $gioHang)
                        @if(isset($gioHang->chiTietGioHang) && $gioHang->chiTietGioHang->isNotEmpty())
                        <table class="table">
                            <tr>
                                <th>Sản phẩm</th>
                                <th style="width: 30%;"></th>
                                <th></th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th></th>
                            </tr>
                            @foreach ($gioHang->chiTietGioHang as $chiTietGH)
                            <tr>

                                <td><img src="{{ $chiTietGH->chiTietSanPham->hinh_anh_chi_tiet }}" class="card card-img border-0 shadow-sm" style="width: 100px;"></td>
                                <td>{{ $chiTietGH->chiTietSanPham->sanPham->ten_san_pham }}</td>
                                <td>{{ $chiTietGH->chiTietSanPham->thuoc_tinh }}
                                <td class="text-danger">{{ number_format($chiTietGH->chiTietSanPham->gia, 0, '.', '.') }} VND</td>
                                <td>
                                    <div class="input-group border border-dark rounded" style="width: 120px;">
                                        <button type="button" class="btn" onclick="updateQuantity('{{ $chiTietGH->ma_chi_tiet_gio_hang }}', -1)">-</button>
                                        <input type="text" class="form-control text-center" value="{{ $chiTietGH->so_luong }}" readonly id="quantity_{{ $chiTietGH->ma_chi_tiet_gio_hang }}" max="{{ $chiTietGH->chiTietSanPham->so_luong }}">
                                        <button type="button" class="btn" onclick="updateQuantity('{{ $chiTietGH->ma_chi_tiet_gio_hang }}', 1)">+</button>
                                    </div>
                                </td>
                                <td class="text-danger" id="total-price-{{ $chiTietGH->ma_chi_tiet_gio_hang }}">
                                    {{ number_format($chiTietGH->so_luong * $chiTietGH->chiTietSanPham->gia, 0, '.', '.') }} VND
                                </td>

                                <td>
                                    <form action="{{ route('client.giohang.delete', ['ma_chi_tiet_gio_hang' => $chiTietGH->ma_chi_tiet_gio_hang]) }}" method="POST">
                                        @csrf
                                        @method('DELETE') <!-- Phương thức DELETE -->
                                        <button class="btn btn-outline-danger rounded-1"><i class="fa-regular fa-trash-can"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="row">
                            <div class="col-lg-10 d-flex justify-content-end align-items-center">
                                <p class="mb-0">Tổng thanh toán: <strong id="total-payment" class="text-danger">{{ number_format($tongThanhToan, 0, '.', '.') }} VND</strong></p>
                            </div>
                            <div class="col-lg-2">
                                <form action="{{ route('client.giohang.buy-from-cart') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100 py-2 rounded-5">Mua hàng</button>
                                </form>
                            </div>
                        </div>

                        @else
                        <p class="d-flex justify-content-center align-items-center">Không có sản phẩm nào trong giỏ hàng!</p>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function updateQuantity(maChiTietGioHang, change) {
        let quantityInput = $('#quantity_' + maChiTietGioHang);
        let currentQuantity = parseInt(quantityInput.val());

        let newQuantity = currentQuantity + change;

        if (newQuantity < 1) {
            alert('Số lượng đặt phải lớn hơn 1!');
            return;
        }

        let maxQuantity = quantityInput.attr('max');

        if (newQuantity > maxQuantity) {
            alert('Đã đạt số lượng tối đa!');
            return;
        }

        $.ajax({
            url: "{{ route('client.giohang.update') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                ma_chi_tiet_gio_hang: maChiTietGioHang,
                so_luong: newQuantity
            },
            success: function(response) {
                if (response.success) {
                    quantityInput.val(newQuantity);

                    let price = response.gia;
                    let totalPrice = newQuantity * price;
                    $('#total-price-' + maChiTietGioHang).text(number_format(totalPrice, 0, '.', '.') + ' VND');

                    $('#total-payment').text(number_format(response.tongThanhToan, 0, '.', '.') + ' VND');

                    $('#cart-count').text(response.spGioHang);

                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Đã xảy ra lỗi khi cập nhật giỏ hàng!');
            }
        });
    }

    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] = s[1] + new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>
@endsection
