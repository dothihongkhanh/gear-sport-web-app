@extends('client.layouts.app')
@section('title', 'Đăng nhập')
@section('content')
<section class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 my-5">
                <div class="card border border-0">
                    <div class="card-body my-4">
                        <h4 class="d-flex justify-content-center mb-2 text-primary">Đăng nhập</h4>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row d-flex justify-content-center">
                                <div class="col-8 mb-2">
                                    <label>Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror border border-dark" name="email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-8 mb-4">
                                    <label>Mật khẩu</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror border border-dark" name="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-8 mb-2">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Đăng nhập
                                    </button>
                                </div>
                                <div class="col-8 mb-2"><span class="d-flex justify-content-center">Hoặc</span></div>
                                <div class="col-8 mb-3">
                                    <a class="btn btn-outline-primary w-100" href="{{ route('auth.google') }}">
                                        <i class="fab fa-google fa-fw"></i> Đăng nhập với Google
                                    </a>
                                </div>
                                <div class="col-8 mb-3">
                                    @if (Route::has('password.request'))
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            <snap>Quên mật khẩu?</snap>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-8">
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-link" href="{{ route('register') }}">
                                            <snap>Đăng ký ngay!</snap>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection