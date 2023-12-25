@extends('layouts.app')

@section('content')
    <main class="profile-user-page default">
        <div class="container">
            <div class="row">
                <div class="profile-page col-xl-9 col-lg-8 col-md-12 order-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12">
                                <h1 class="title-tab-content">ویرایش اطلاعات شخصی</h1>
                            </div>
                            <div class="content-section default">
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="title-tab-content">حساب شخصی</h1>
                                    </div>
                                </div>
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
                                <form class="form-account" method="post" action="{{ route('profile.update',Auth::user()->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-account-title">نام</div>
                                            <div class="form-account-row">
                                                <input class="input-field text-right" type="text"
                                                       name="name" id="name"
                                                       required value="{{ Auth::user()->name }}"
                                                       placeholder="نام خود را وارد نمایید">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-account-title">نام خانوادگی</div>
                                            <div class="form-account-row">
                                                <input class="input-field text-right" type="text"
                                                       name="family" id="family"
                                                       required value="{{ Auth::user()->family }}"
                                                       placeholder="نام خانوادگی خود را وارد نمایید">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-account-title">کد ملی</div>
                                            <div class="form-account-row">
                                                <input class="input-field" type="text" minlength="10" maxlength="10"
                                                       name="national_code" id="national_code"
                                                       value="{{ Auth::user()->detail != '' ? Auth::user()->detail->national_code : '' }}"
                                                       placeholder="کد ملی خود را وارد نمایید">
                                            </div>
                                           {{-- <div class="form-account-agree">
                                                <label class="checkbox-form checkbox-primary">
                                                    <input type="checkbox">
                                                    <span class="checkbox-check"></span>
                                                </label>
                                                <label for="agree">
                                                    تبعه خارجی فاقد کد ملی هستم
                                                </label>
                                            </div>--}}
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-account-title">جنسیت</div>
                                            <div class="form-account-row">
                                                <select class="input-field"
                                                        name="sex" id="sex" required>
                                                    <option value="">انتخاب جنسیت</option>
                                                    @if(Auth::user()->detail != '')
                                                        <option {{ Auth::user()->detail->sex == 1 ? 'selected' : '' }} value="1">آقا</option>
                                                        <option {{ Auth::user()->detail->sex == 2 ? 'selected' : '' }} value="2">خانم</option>
                                                    @else
                                                        <option value="1">آقا</option>
                                                        <option value="2">خانم</option>
                                                    @endif
                                                </select>
                                                {{--<input class="input-field" type="text"
                                                       placeholder="شماره موبایل خود را وارد نمایید">--}}
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-account-title">شماره کارت</div>
                                            <div class="form-account-row">
                                                <input class="input-field" type="text"
                                                       name="bill_cart" id="bill_cart" minlength="16" maxlength="16"
                                                       value="{{ Auth::user()->detail != '' ? Auth::user()->detail->bill_cart : '' }}"
                                                       placeholder=" شماره کارت خود را وارد نمایید">
                                            </div>
                                        </div>
                                       {{-- <div class="col-sm-12 col-md-6">
                                            <div class="form-account-title">آدرس ایمیل</div>
                                            <div class="form-account-row">
                                                <input class="input-field" type="email" placeholder=" آدرس ایمیل خود را وارد نمایید">
                                            </div>
                                        </div>--}}
                                    </div>
                                   {{-- <div class="col-12 no-padding">
                                        <div class="form-account-agree">
                                            <label class="checkbox-form checkbox-primary">
                                                <input type="checkbox" id="agree-newspaper">
                                                <span class="checkbox-check"></span>
                                            </label>
                                            <label for="agree-newspaper">
                                                اشتراک در خبرنامه قالی خانه
                                            </label>
                                        </div>
                                    </div>--}}
                                    <div class="col-12 text-center">
                                        <button class="btn btn-success btn-lg">ذخیره</button>
                                        <a href="{{ url('profile') }}" class="btn btn-default btn-lg">انصراف</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @include('user.temp.sidebar')
            </div>
        </div>
    </main>
@endsection
