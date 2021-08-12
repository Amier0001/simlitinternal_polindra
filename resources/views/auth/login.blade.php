@extends('layout.auth_main')

@section('title', 'SIMLITABMAS - Login')

@section('auth_page')

@include('layout.flash_alert')

<div class=" login-box">
    <!-- /.login-logo -->
    <div class="card card-outline">
        <div class="card-header text-center">
            <a href="{{url('/')}}" class="h1"><img src="{{URL::asset('assets/img/logo/polindra.png')}}" alt="" style="width: 100px;"></a>
            <P>
            <h3 class="mt-22">SIMLITINTERNAL POLINDRA</h3>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Login Sistem Penelitian dan Pengabdian Polindra</p>

            <form action="{{route('login_process')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('login_email') is-invalid @enderror" placeholder="Email" name="login_email" id="login_email" value="{{old('login_email')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('login_email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                    <div id="login_email_field"></div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control  @error('login_password') is-invalid @enderror" placeholder="Password" name="login_password" id="login_password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('login_password')
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
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" id="login_submit">Masuk</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            </form>

            <p class="mt-3 mb-1 text-center">
                Lupa <a href="{{route('forgot_password')}}">Password?</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
@endsection