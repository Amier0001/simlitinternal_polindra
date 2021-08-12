@extends('layout.auth_main')

@section('title', 'Forgot Password')

@section('auth_page')

@include('layout.flash_alert')

<div class=" login-box">
    <!-- /.login-logo -->
    <div class="card card-outline">
        <div class="card-header text-center">
            <a href="{{url('/')}}" class="h1"><img src="{{URL::asset('assets/img/logo/polindra.png')}}" alt="" style="width: 100px;"></a>
            <p>
            <h3 class="mt-22">SIMLITINTERNAL POLINDRA</h3>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Lupa password? Silahkan pulihkan disini.</p>
            <form action="{{route('forgot_password_process')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}" {{--style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"--}}></div>
                    @if($errors->has('g-recaptcha-response'))
                    <small class="text-danger">
                        {{$errors->first('g-recaptcha-response')}}
                    </small>
                    @endif
                </div>
                <div class="row ">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Lupa Password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mt-3 mb-1 text-center">
                Kembali Ke <a href="{{route('login')}}">Login</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
@endsection