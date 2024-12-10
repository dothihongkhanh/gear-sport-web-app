@extends('admin.layouts.app')
@section('title', 'Quản lý đơn hàng')
@section('content')
<form action="{{ route('admin.donhang.filter') }}" method="GET">
    <div class="form-group">
        <label for="trang_thai">Lọc theo trạng thái:</label>
        <select name="trang_thai" id="trang_thai" class="form-control" onchange="this.form.submit()">
            <option value="">-- Tất cả trạng thái --</option>
            @foreach(\App\Enums\TrangThaiDonHang::all() as $trangThai)
            <option value="{{ $trangThai }}" {{ (request('trang_thai') == $trangThai) ? 'selected' : '' }}>
                {{ $trangThai }}
            </option>
            @endforeach
        </select>
    </div>
</form>

<table class="table table-bordered table-hover">
    <tr>
        <th>Mã đơn hàng</th>
        <th>Tổng thanh toán</th>
        <th>Trạng thái</th>
        <th>Chi tiết</th>
    </tr>
    @forelse($dsDonHang as $donHang)
    <tr>
        <td>{{ $donHang->ma_don_hang }}</td>
        <td>{{ $donHang->tongGiaTri() }}</td>
        <td>
            <span
                class="badge 
               @if($donHang->trang_thai === \App\Enums\TrangThaiDonHang::DangChoXuLy) text-primary border border-primary
               @elseif($donHang->trang_thai === \App\Enums\TrangThaiDonHang::DangGiaoHang) text-warning border border-warning
               @elseif($donHang->trang_thai === \App\Enums\TrangThaiDonHang::HoanThanh) text-success border border-success
               @elseif($donHang->trang_thai === \App\Enums\TrangThaiDonHang::DaHuy) text-danger border border-danger
               @endif
               rounded-pill p-1">
                {{ $donHang->trang_thai }}
            </span>
        </td>
        <td>
            <a href="{{ route('admin.donhang.detail', ['ma_don_hang' => $donHang->ma_don_hang]) }}" class="btn btn-primary text-truncate">Chi tiết</a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4" class="text-center">Không có đơn hàng nào!</td>
    </tr>
    @endforelse
</table>
@endsection