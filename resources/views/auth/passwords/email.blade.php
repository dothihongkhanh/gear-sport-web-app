@extends('client.layouts.app')
@section('title', 'Đặt lại mật khẩu')
@section('content')
<section class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 my-5">
                <div class="card border border-0">
                    <div class="card-header bg-white text-primary">Đặt lại mật khẩu</div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="row d-flex justify-content-center">
                                <div class="col-8 mb-4">
                                    <label>Email</label>
                                    <input id="email" type="email" class="form-control border border-dark @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-8 mb-2">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Gửi liên kết đặt lại mật khẩu
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