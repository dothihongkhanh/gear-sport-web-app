@extends('client.layouts.app')
@section('title', 'Đặt lại mật khẩu')
@section('content')
<section class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 my-5">
                <div class="card border border-0">
                    <div class="card-body my-4">
                        <h4 class="d-flex justify-content-center mb-2 text-primary">Đặt lại mật khẩu</h4>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="row d-flex justify-content-center">
                                <div class="col-8 mb-2">
                                    <label>Email</label>
                                    <input id="email" type="email" class="form-control border border-dark @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-8 mb-4">
                                    <label>Mật khẩu mới</label>
                                    <input id="password" type="password" class="form-control border border-dark @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-8 mb-4">
                                    <label>Xác nhận mật khẩu</label>
                                    <input id="password-confirm" type="password" class="form-control border border-dark" name="password_confirmation" required autocomplete="new-password">
                                </div>
                                <div class="col-8 mb-2">
                                    <button type="submit" class="btn btn-primary w-100 py-2">
                                        Đặt lại mật khẩu
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