@extends('layouts.app_other')

@section('content')

    <div class="container">
        <div class="row">
            <div class="main-content col-12 col-md-7 col-lg-5 mx-auto">
                <div class="account-box">
                    <a href="#" class="logo">
                        <img src="{{ asset('img/logo.png') }}" alt="">
                    </a>
                    <div class="account-box-title">تغییر رمز عبور</div>
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
                        <form class="form-account" method="POST" action="{{ route('UserPassword.store') }}">
                            @csrf
                            <div class="form-account-title">رمز عبور قبلی</div>
                            <div class="form-account-row">
                                <label class="input-label"><i
                                        class="now-ui-icons ui-1_lock-circle-open"></i></label>
                                <input class="input-field  @error('password_old') is-invalid @enderror"
                                       type="password" id="password_old" name="password_old"
                                       autocomplete="off" autofocus required minlength="8"
                                       placeholder="رمز عبور قبلی خود را وارد نمایید">
                                @error('password_old')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-account-title">رمز عبور جدید</div>
                            <div class="form-account-row">
                                <label class="input-label"><i
                                        class="now-ui-icons ui-1_lock-circle-open"></i></label>
                                <input class="input-field @error('password') is-invalid @enderror"
                                       type="password" id="password" name="password"
                                       autocomplete="off" required minlength="8"
                                       placeholder="رمز عبور جدید خود را وارد نمایید">
                            </div>
                            <div class="form-account-title">تکرار رمز عبور جدید</div>
                            <div class="form-account-row">
                                <label class="input-label"><i
                                        class="now-ui-icons ui-1_lock-circle-open"></i></label>
                                <input class="input-field"
                                       id="password-confirm" type="password" minlength="8"
                                       name="password_confirmation" required autocomplete="off"
                                       placeholder="رمز عبور جدید خود را مجددا وارد نمایید">
                            </div>
                            <div class="form-account-row form-account-submit">
                                <div class="parent-btn">
                                    <button class="dk-btn dk-btn-info">
                                        تغییر رمز عبور
                                        <i class="now-ui-icons arrows-1_refresh-69"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
