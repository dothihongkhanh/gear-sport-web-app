@extends('client.layouts.app')
@section('title', 'Danh sách đơn hàng')
@section('content')
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-12 mt-4">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <nav>
                                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-all-tab" data-bs-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">Tất cả</a>
                                        <a class="nav-item nav-link" id="nav-confirm-tab" data-bs-toggle="tab" href="#nav-confirm" role="tab" aria-controls="nav-confirm" aria-selected="false">Chờ xác nhận</a>
                                        <a class="nav-item nav-link" id="nav-delivery-tab" data-bs-toggle="tab" href="#nav-delivery" role="tab" aria-controls="nav-delivery" aria-selected="false">Đang giao hàng</a>
                                        <a class="nav-item nav-link" id="nav-complete-tab" data-bs-toggle="tab" href="#nav-complete" role="tab" aria-controls="nav-complete" aria-selected="false">Hoàn thành</a>
                                        <a class="nav-item nav-link" id="nav-cancel-tab" data-bs-toggle="tab" href="#nav-cancel" role="tab" aria-controls="nav-cancel" aria-selected="false">Đã hủy</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>ID</th>
                                                <th>Tổng tiền</th>
                                                <th>Phương thức</th>
                                                <th>Trạng thái</th>
                                                <th>Thao tác</th>
                                            </tr>
                                            @foreach ($dsDonHang as $donHang)
                                            <tr>
                                                <td>{{ $donHang->ma_don_hang }}</td>
                                                <td class="text-danger">{{ number_format($donHang->tongGiaTri(), 0, '.', '.') }} VND</td>
                                                <td>{{ $donHang->phuong_thuc_thanh_toan }}</td>
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
                                                    <a href="{{ route('client.donhang.detail', ['ma_don_hang' => $donHang->ma_don_hang]) }}" class="btn btn-outline-primary rounded-1">Xem</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="nav-confirm" role="tabpanel" aria-labelledby="nav-confirm-tab">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>ID</th>
                                                <th>Tổng tiền</th>
                                                <th>Phương thức</th>
                                                <th>Trạng thái</th>
                                                <th>Thao tác</th>
                                            </tr>
                                            @foreach ($dsDonHang as $donHang)
                                            @if ($donHang->dangChoXuLy())
                                            <tr>
                                                <td>{{ $donHang->ma_don_hang }}</td>
                                                <td class="text-danger">{{ number_format($donHang->tongGiaTri(), 0, '.', '.') }} VND</td>
                                                <td>{{ $donHang->phuong_thuc_thanh_toan }}</td>
                                                <td><span class="text-primary border border-primary rounded-pill px-1">{{ $donHang->trang_thai }}</span></td>
                                                <td>
                                                    <a href="{{ route('client.donhang.detail', ['ma_don_hang' => $donHang->ma_don_hang]) }}" class="btn btn-outline-primary rounded-1">Xem</a>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="nav-delivery" role="tabpanel" aria-labelledby="nav-delivery-tab">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>ID</th>
                                                <th>Tổng tiền</th>
                                                <th>Phương thức</th>
                                                <th>Trạng thái</th>
                                                <th>Thao tác</th>
                                            </tr>
                                            @foreach ($dsDonHang as $donHang)
                                            @if ($donHang->dangGiaoHang())
                                            <tr>
                                                <td>{{ $donHang->ma_don_hang }}</td>
                                                <td class="text-danger">{{ number_format($donHang->tongGiaTri(), 0, '.', '.') }} VND</td>
                                                <td>{{ $donHang->phuong_thuc_thanh_toan }}</td>
                                                <td><span class="text-warning border border-warning rounded-pill px-1">{{ $donHang->trang_thai }}</span></td>
                                                <td>
                                                    <a href="{{ route('client.donhang.detail', ['ma_don_hang' => $donHang->ma_don_hang]) }}" class="btn btn-outline-primary rounded-1">Xem</a>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="nav-complete" role="tabpanel" aria-labelledby="nav-complete-tab">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>ID</th>
                                                <th>Tổng tiền</th>
                                                <th>Phương thức</th>
                                                <th>Trạng thái</th>
                                                <th>Thao tác</th>
                                            </tr>
                                            @foreach ($dsDonHang as $donHang)
                                            @if ($donHang->hoanThanh())
                                            <tr>
                                                <td>{{ $donHang->ma_don_hang }}</td>
                                                <td class="text-danger">{{ number_format($donHang->tongGiaTri(), 0, '.', '.') }} VND</td>
                                                <td>{{ $donHang->phuong_thuc_thanh_toan }}</td>
                                                <td><span class="text-success border border-success rounded-pill px-1">{{ $donHang->trang_thai }}</span></td>
                                                <td>
                                                    <a href="{{ route('client.donhang.detail', ['ma_don_hang' => $donHang->ma_don_hang]) }}" class="btn btn-outline-primary rounded-1">Xem</a>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="nav-cancel" role="tabpanel" aria-labelledby="nav-cancel-tab">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>ID</th>
                                                <th>Tổng tiền</th>
                                                <th>Phương thức</th>
                                                <th>Trạng thái</th>
                                                <th>Thao tác</th>
                                            </tr>
                                            @foreach ($dsDonHang as $donHang)
                                            @if ($donHang->daHuy())
                                            <tr>
                                                <td>{{ $donHang->ma_don_hang }}</td>
                                                <td class="text-danger">{{ number_format($donHang->tongGiaTri(), 0, '.', '.') }} VND</td>
                                                <td>{{ $donHang->phuong_thuc_thanh_toan }}</td>
                                                <td><span class="text-danger border border-danger rounded-pill px-1">{{ $donHang->trang_thai }}</span></td>
                                                <td>
                                                    <a href="{{ route('client.donhang.detail', ['ma_don_hang' => $donHang->ma_don_hang]) }}" class="btn btn-outline-primary rounded-1">Xem</a>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection