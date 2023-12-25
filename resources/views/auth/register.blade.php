@extends('layouts.app_other')

@section('content')
    <div class="container">
        <div class="row">
            <div class="main-content col-12 col-md-7 col-lg-5 mx-auto">
                <div class="account-box">
                    <a href="#" class="logo">
                        <img src="{{ asset('img/logo.png') }}" alt="">
                    </a>
                    <div class="account-box-title">ثبت‌نام در قالی خانه</div>
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
                        <form class="form-account" method="POST" action="{{ route('register') }}">
                            @csrf
                            {{--<div class="form-account-title">ایمیل</div>
                            <div class="form-account-row">
                                <label class="input-label"><i class="fa fa-envelope-square"></i></label>
                                <input class="input-field @error('email') is-invalid @enderror" type="text" id="email"
                                       name="email" required autocomplete="off" autofocus
                                       onkeyup="toEnglishNumber(this.value,'email');"
                                       value="{{ old('email') }}"
                                       placeholder="ایمیل خود را وارد نمایید">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>--}}
                            <div class="form-account-title">تلفن همراه</div>
                            <div class="form-account-row">
                                <label class="input-label"><i class="fa fa-mobile"></i></label>
                                <input class="input-field @error('mobile') is-invalid @enderror" type="text" id="mobile"
                                       name="mobile" required autocomplete="off"
                                       onkeyup="toEnglishNumber(this.value,'mobile');"
                                       value="{{ old('mobile') }}"
                                       placeholder="تلفن همراه خود را وارد نمایید">
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-account-title">کلمه عبور</div>
                            <div class="form-account-row">
                                <label class="input-label"><i
                                        class="now-ui-icons ui-1_lock-circle-open"></i></label>
                                <input class="input-field @error('password') is-invalid @enderror"
                                       id="password" type="password"
                                       onkeyup="toEnglishNumber(this.value,'password');"
                                       name="password" required autocomplete="off"
                                       placeholder="کلمه عبور خود را وارد نمایید">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-account-title">تکرار کلمه عبور</div>
                            <div class="form-account-row">
                                <label class="input-label"><i
                                        class="now-ui-icons ui-1_lock-circle-open"></i></label>
                                <input class="input-field"
                                       onkeyup="toEnglishNumber(this.value,'password-confirm');"
                                       id="password-confirm" type="password"
                                       name="password_confirmation" required autocomplete="off"
                                       placeholder="تکرار کلمه عبور">
                            </div>

                            <div class="form-account-agree">
                                <label class="checkbox-form checkbox-primary">
                                    <input type="checkbox" checked="checked">
                                    <span class="checkbox-check"></span>
                                </label>
                                <label for="agree">
                                    <a href="#" class="btn-link-border">حریم خصوصی</a> و <a href="#"
                                                                                            class="btn-link-border">شرایط و قوانین</a> استفاده از سرویس های سایت
                                    قالی خانه را مطالعه نموده و با کلیه موارد آن موافقم.</label>
                            </div>
                            <div class="form-account-row form-account-submit">
                                <div class="parent-btn">
                                    <button class="dk-btn dk-btn-info">
                                        ثبت نام در قالی خانه
                                        <i class="now-ui-icons users_circle-08"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="account-box-footer">
                        <span>قبلا در قالی خانه ثبت‌نام کرده‌اید؟</span>
                        <a href="{{ url('login') }}" class="btn-link-border">وارد شوید</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
