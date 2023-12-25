@extends('layouts.app_other')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-2 col-5 pt-5">
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('img/logo.png') }}" alt="">
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 px-lg-2 px-1">
                <ul class="nav nav-tabs col-12 px-0 d-flex justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item col-6 col-lg-4 px-0 text-center">
                        <a class="nav-link active"
                           id="home-tab" data-toggle="tab"
                           href="#home" role="tab" aria-controls="home" aria-selected="true">
                            ورود
                        </a>
                    </li>
                    <li class="nav-item col-6 col-lg-4 px-0 text-center">
                        <a class="nav-link" id="profile-tab" data-toggle="tab"
                           href="#profile" role="tab" aria-controls="profile"
                           aria-selected="false">
                            ثبت نام
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home"
                         role="tabpanel" aria-labelledby="home-tab">
                        <div class="main-content col-12 mx-auto px-0">
                            <div class="account-box mt-0">
                                <div class="account-box-title text-right">ورود به قالی خانه</div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                {{-- <div class="message-light">اگر قبلا با ایمیل ثبت‌نام کرده‌اید، نیاز به
                                     ثبت‌نام مجدد با شماره
                                     همراه ندارید</div>--}}
                                <div class="account-box-content">
                                    <form class="form-account" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-account-title">ایمیل یا شماره موبایل</div>
                                        <div class="form-account-row">
                                            <label for="email" class="input-label"><i class="now-ui-icons users_single-02"></i></label>
                                            <input class="input-field @error('email') is-invalid @enderror" type="text" id="email"
                                                   required autocomplete="off" autofocus
                                                   name="email" onkeyup="toEnglishNumber(this.value,'email');"
                                                   placeholder="ایمیل یا شماره موبایل خود را وارد نمایید">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-account-title">رمز عبور
                                            @if (Route::has('password.request'))
                                                <a class="btn-link-border form-account-link"
                                                   href="{{ route('password.request') }}">
                                                    رمز
                                                    عبور خود را فراموش
                                                    کرده ام !
                                                </a>
                                            @endif
                                        </div>
                                        <div class="form-account-row">
                                            <label for="password" class="input-label"><i
                                                    class="now-ui-icons ui-1_lock-circle-open"></i></label>
                                            <input class="input-field @error('password') is-invalid @enderror" type="password"
                                                   id="password" name="password" required
                                                   autocomplete="current-password"
                                                   placeholder="رمز عبور خود را وارد نمایید">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-account-row form-account-submit">
                                            <div class="parent-btn">
                                                <button type="submit" class="dk-btn dk-btn-info">
                                                    ورود به قالی خانه
                                                    <i class="fa fa-sign-in"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-account-agree">
                                            <label class="checkbox-form checkbox-primary">
                                                <input type="checkbox" checked="checked" name="remember" id="remember"
                                                    {{ old('remember') ? 'checked' : '' }}>
                                                <span class="checkbox-check"></span>
                                            </label>
                                            <label for="remember">مرا به خاطر داشته باش</label>
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
                    <div class="tab-pane fade" id="profile"
                         role="tabpanel" aria-labelledby="profile-tab">
                        <div class="main-content col-12 mx-auto px-0">
                            <div class="account-box mt-0">
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
                                        {{--<div class="form-account-title">پست الکترونیک</div>
                                        <div class="form-account-row">
                                            <label class="input-label"><i class="fa fa-envelope-square"></i></label>
                                            <input class="input-field @error('email') is-invalid @enderror" type="text" id="email"
                                                   name="email" required autocomplete="off" autofocus
                                                   onkeyup="toEnglishNumber(this.value,'email');"
                                                   value="{{ old('email') }}"
                                                   placeholder="پست الکترونیک خود را وارد نمایید">
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
                                                   name="mobile" required autocomplete="off" onkeyup="toEnglishNumber(this.value,'mobile');"
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
                                                   onkeyup="toEnglishNumber(this.value,'password');"
                                                   id="password" type="password"
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
            </div>
        </div>
        {{-- <div class="row">
             <div class="main-content col-12 col-md-7 col-lg-5 mx-auto">
                 <div class="account-box">

                     <div class="account-box-title text-right">ورود به قالی خانه</div>
                     @if ($errors->any())
                         <div class="alert alert-danger">
                             <ul>
                                 @foreach ($errors->all() as $error)
                                     <li>{{ $error }}</li>
                                 @endforeach
                             </ul>
                         </div>
                     @endif
                    --}}{{-- <div class="message-light">اگر قبلا با ایمیل ثبت‌نام کرده‌اید، نیاز به
                         ثبت‌نام مجدد با شماره
                         همراه ندارید</div>--}}{{--
                     <div class="account-box-content">
                         <form class="form-account" method="POST" action="{{ route('login') }}">
                             @csrf
                             <div class="form-account-title">ایمیل یا شماره موبایل</div>
                             <div class="form-account-row">
                                 <label for="email" class="input-label"><i class="now-ui-icons users_single-02"></i></label>
                                 <input class="input-field @error('email') is-invalid @enderror" type="text" id="email"
                                        required autocomplete="off" autofocus
                                        name="email" onkeyup="toEnglishNumber(this.value,'email');"
                                        placeholder="ایمیل یا شماره موبایل خود را وارد نمایید">
                                 @error('email')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                             </div>
                             <div class="form-account-title">رمز عبور
                                 @if (Route::has('password.request'))
                                     <a class="btn-link-border form-account-link"
                                        href="{{ route('password.request') }}">
                                         رمز
                                         عبور خود را فراموش
                                         کرده ام
                                     </a>
                                 @endif
                             </div>
                             <div class="form-account-row">
                                 <label for="password" class="input-label"><i
                                         class="now-ui-icons ui-1_lock-circle-open"></i></label>
                                 <input class="input-field @error('password') is-invalid @enderror" type="password"
                                        id="password" name="password" required
                                        autocomplete="current-password"
                                        placeholder="رمز عبور خود را وارد نمایید">
                                 @error('password')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                             </div>
                             <div class="form-account-row form-account-submit">
                                 <div class="parent-btn">
                                     <button type="submit" class="dk-btn dk-btn-info">
                                         ورود به قالی خانه
                                         <i class="fa fa-sign-in"></i>
                                     </button>
                                 </div>
                             </div>
                             <div class="form-account-agree">
                                 <label class="checkbox-form checkbox-primary">
                                     <input type="checkbox" checked="checked" name="remember" id="remember"
                                         {{ old('remember') ? 'checked' : '' }}>
                                     <span class="checkbox-check"></span>
                                 </label>
                                 <label for="remember">مرا به خاطر داشته باش</label>
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
         </div>--}}
    </div>
@endsection
