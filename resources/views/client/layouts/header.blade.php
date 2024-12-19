<header>
    <div class="container-fluid">
        <div class="row py-3 border-bottom">

            <div class="col-sm-4 col-lg-2 text-center text-sm-start d-flex gap-3 justify-content-center justify-content-md-start">
                <div class="d-flex align-items-center my-3 my-sm-0">
                    <a href="/" class="text-decoration-none">
                        <h2 class="text-primary"><b>Fit</b>Smart</h2>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-4">
                <div class="search-bar row bg-light p-2 rounded-4">
                    <div class="col-md-4 d-none d-md-block">
                        <select class="form-select border-0 bg-transparent">
                            <option>Danh mục</option>

                            @foreach ($dsDanhMuc as $danhMuc)
                            <option>{{ $danhMuc->ten_danh_muc }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-11 col-md-7">
                        <form id="search-form" class="text-center" action="index.html" method="post">
                            <input type="text" class="form-control border-0 bg-transparent" placeholder="Tìm kiếm...">
                        </form>
                    </div>
                    <div class="col-1">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <ul class="navbar-nav list-unstyled d-flex flex-row gap-3 gap-lg-5 justify-content-center flex-wrap align-items-center mb-0 fw-bold text-uppercase text-dark">
                    <li class="nav-item active">
                        <a href="/" class="nav-link">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a href="/" class="nav-link">Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a href="/" class="nav-link">Liên hệ</a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-8 col-lg-2 d-flex gap-5 align-items-center justify-content-center justify-content-sm-end">
                @auth

                <a href="{{ route('client.view-cart') }}" class="position-relative">
                    <i class="fa-solid fa-cart-shopping text-primary" style="font-size: 22px; width: 22px; height: 22px"></i>
                    <span class="cart-count position-absolute top-0 start-100 translate-middle-x translate-middle-y badge rounded-pill bg-danger">
                       {{ $spGioHang }}
                    </span>

                </a>

                <div class="dropdown">
                    <strong class="text-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->ten_nguoi_dung }}
                    </strong>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="{{ route('client.donhang.view-all') }}">Đơn mua</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('Đăng xuất') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>

                @else
                <div class="">
                    <a href="{{ route('login') }}" class="btn btn-primary rounded-1 p-2">
                        Đăng nhập
                    </a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline-primary rounded-1 p-2">
                        Đăng ký
                    </a>
                    @endif
                </div>
                @endauth

            </div>

        </div>
    </div>
</header>