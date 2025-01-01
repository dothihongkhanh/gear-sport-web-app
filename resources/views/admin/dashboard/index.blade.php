@extends('admin.layouts.app')
@section('title', 'Trang quản trị')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box border border-info">
                    <div class="inner text-info text-center">
                        <b>Danh mục</b>
                        <h3>{{ $tongDanhMuc }}</h3>
                    </div>
                    <a href="/admin/danhmuc" class="small-box-footer text-info">Xem <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box border border-success">
                    <div class="inner text-success text-center">
                        <b>Sản phẩm</b>
                        <h3>{{ $tongSanPham }}</h3>
                    </div>
                    <a href="/admin/sanpham" class="small-box-footer text-success">Xem <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box border border-warning">
                    <div class="inner text-warning text-center">
                        <b>Đơn hàng</b>
                        <h3>{{ $tongDonHang }}</h3>
                    </div>
                    <a href="/admin/donhang" class="small-box-footer text-warning">Xem <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box border border-danger">
                    <div class="inner text-danger text-center">
                        <b>Doanh thu</b>
                        <h3>{{ number_format($doanhThu, 0, '.', '.') }} VND</h3>
                    </div>
                    <a href="/admin/donhang" class="small-box-footer text-danger">Xem <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header text-primary font-weight-bold">Top 5 sản phẩm bán chạy</div>
                <div class="card-body">
                    <ol>
                        @foreach ($top5SanPham as $sanPham)
                        <li>
                            <p><b>{{ $sanPham->ten_san_pham }}</b>
                                <br> Đã bán: <i class="text-danger">{{ $sanPham->chi_tiet_san_pham_count }} sản phẩm</i>
                            </p>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header text-primary font-weight-bold">Thống kê doanh thu</div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="doanhThuChart" width="400" height="200"></canvas>

                        <div id="doanhThuData" data-doanh-thu-data="{{ json_encode($doanhThuData) }}"></div>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <script>
                            var doanhThuDataElement = document.getElementById('doanhThuData');
                            var doanhThuData = JSON.parse(doanhThuDataElement.getAttribute('data-doanh-thu-data'));

                            var ctx = document.getElementById('doanhThuChart').getContext('2d');

                            var labels = [];
                            var data = [];

                            doanhThuData.forEach(function(item) {
                                labels.push(item.monthYear);
                                data.push(item.totalRevenue);
                            });

                            var doanhThuChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Doanh Thu (VND)',
                                        data: data,
                                        backgroundColor: 'rgba(30, 144, 255, 0.4)',
                                        borderColor: 'rgb(30, 144, 255)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                callback: function(value) {
                                                    return new Intl.NumberFormat('vi-VN', {
                                                        style: 'currency',
                                                        currency: 'VND'
                                                    }).format(value);
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection