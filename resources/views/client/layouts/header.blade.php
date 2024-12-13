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
                            <option>Groceries</option>
                            <option>Drinks</option>
                            <option>Chocolates</option>
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
                <ul class="d-flex justify-content-end list-unstyled m-0">
                    <li>
                        <a href="#" class="p-2 mx-1">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </li>
                </ul>
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