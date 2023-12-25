@extends('layouts.app_other')

@section('content')
    <div class="container">
        <div class="row">
            <div class="main-content col-12 col-md-7 col-lg-5 mx-auto mt-5">
                <div class="account-box">
                    <a href="#" class="logo">
                        <img src="{{ asset('img/logo.png') }}" alt="">
                    </a>
                    <div class="account-box-title text-right">بازیابی رمز عبور</div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="account-box-content">
                        <form class="form-account" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-account-title">ایمیل</div>
                            <div class="form-account-row">
                                <label for="email" class="input-label"><i class="now-ui-icons users_single-02"></i></label>
                                <input class="input-field @error('email') is-invalid @enderror" type="email"
                                       id="email" value="{{ old('email') }}"
                                       required autocomplete="email" autofocus
                                       name="email"
                                       placeholder="ایمیل خود را وارد نمایید">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>


                            <div class="form-account-row form-account-submit">
                                <div class="parent-btn">
                                    <button type="submit" class="dk-btn dk-btn-info">
                                        بازیابی
                                        <i class="fa fa-sign-in"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="account-box-footer">
                        <span>کاربر جدید هستید؟</span>
                        <a href="{{ url('register') }}" class="btn-link-border">ثبت‌نام در
                            قالی خانه</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>--}}
@endsection
