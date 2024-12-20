@extends('client.layouts.app')
@section('title', 'Đăng ký')
@section('content')
<section class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 my-5">
                <div class="card border border-0">
                    <div class="card-body my-4">
                        <h4 class="d-flex justify-content-center mb-2 text-primary">Đăng ký</h4>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row d-flex justify-content-center">
                                <div class="col-8 mb-2">
                                    <label>Tên người dùng</label>
                                    <input id="name" type="text" class="form-control border border-dark @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-8 mb-4">
                                    <label>Email</label>
                                    <input id="email" type="email" class="form-control border border-dark @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-8 mb-4">
                                    <label>Mật khẩu</label>
                                    <input id="password" type="password" class="form-control border border-dark @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-8 mb-4">
                                    <label>Nhập lại mật khẩu</label>
                                    <input id="password-confirm" type="password" class="form-control border border-dark" name="password_confirmation">
                                </div>
                                <div class="col-8 mb-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    Đăng ký
                                </button>
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