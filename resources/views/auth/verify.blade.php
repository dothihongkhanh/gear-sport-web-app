@extends('client.layouts.app')
@section('title', 'FitSmart')
@section('content')
<section class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 my-5">
                <div class="card border border-0">
                    <div class="card-header bg-white text-primary">Xác thực địa chỉ email</div>

                    <div class="card-body">
                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Một liên kết xác thực mới đã được gửi đến địa chỉ email của bạn.') }}
                        </div>
                        @endif

                        {{ __('Trước khi tiếp tục, vui lòng kiểm tra email của bạn để lấy liên kết xác thực.') }}
                        {{ __('Nếu bạn không nhận được email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn p-0 m-0 align-baseline text-primary">{{ __('hãy nhấp vào đây để yêu cầu một email khác') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection