@extends('admin.layouts.app')
@section('title', 'Quản lý đơn hàng')
@section('content')
<table class="table table-bordered table-hover">

    <tr>
        <th>Mã đơn hàng</th>
        <th>Tổng thanh toán</th>
        <th>Trạng thái</th>
        <th>Chi tiết</th>
    </tr>


    @foreach ($dsDonHang as $donHang)
    <tr>
        <td>{{ $donHang->ma_don_hang }}</td>
        <td>{{ $donHang->tongGiaTri() }}</td>
        <td>{{ $donHang->trang_thai }}</td>
        <td>
            <a href="{{ route('admin.donhang.detail', ['ma_don_hang' => $donHang->ma_don_hang]) }}" class="btn btn-primary mb-2 w-100 text-truncate">Chi tiết</a>
        </td>
    </tr>
    @endforeach

</table>
@endsection