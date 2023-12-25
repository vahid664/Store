@extends('layouts.app_admin')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-danger">افزودن دسترسی
                        <a href="{{ url('Admin/Permission') }}" class="float-right text-white">
                            بازگشت
                            <i class="fa fa-arrow-left"></i>
                        </a>

                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="post" action="{{ route('Permission.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="name" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان
                                    </label>
                                    <div class="col-md-9">
                                        <input id="name" type="text" placeholder="مثال : post-list"
                                               class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                               required autocomplete="name" autofocus >
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="title" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        بخش
                                    </label>
                                    <div class="col-md-9">
                                        <select id="title" name="title" class="form-control">
                                            <option value="">انتخاب</option>
                                            <option value="user">کاربری</option>
                                            <option value="product">محصولات</option>
                                            <option value="productfile">فایل های محصولات</option>
                                            <option value="factor">فاکتور</option>
                                            <option value="article">مقالات</option>
                                            <option value="articlefile">فایل های مقالات</option>
                                            <option value="brand">برند</option>
                                            <option value="advertise">بنر</option>
                                            <option value="tag">تگ</option>
                                            <option value="page">صفحات ثابت</option>
                                            <option value="news">لیست خبرنامه</option>
                                            <option value="social">شبکه های اجتماعی</option>
                                            <option value="group">گروه بندی</option>
                                            <option value="role">سطوح کاربری</option>
                                            <option value="permission">سطح دسترسی</option>
                                            <option value="productdetail">ویژگی های محصول</option>
                                            <option value="productawesome">محصولات ویژه</option>
                                            <option value="color">رنگبندی</option>
                                            <option value="contact">مشاوره</option>
                                            <option value="off">کد تخفیف</option>
                                            <option value="peyk">پیک</option>
                                            <option value="financial">گزارش مالی</option>
                                            <option value="size">سایز بندی محصولات</option>
                                            <option value="productupdate">به روزرسانی آنی محصول</option>
                                            <option value="search">جستجو</option>
                                            <option value="redirect">ریدایرکت</option>
                                            <option value="gift">هدیه</option>
                                            <option value="productreport">گزارش گیری محصول</option>
                                            <option value="copyproduct">کپی محصول</option>
                                            <option value="copyprocat">کپی محصول دسته</option>
                                            <option value="managementbrand">مدیریت محصول با برند</option>
                                            <option value="productreturned">مرجوعی محصول</option>
                                            <option value="faq">faq</option>
                                            <option value="commentadmin">نظرات</option>
                                            <option value="reportfactor">گزارش گیری رفتار خرید</option>
                                            <option value="productsize">مدیریت سایزبندی محصول</option>
                                            <option value="productofferadmin">قیمت پیشنهادی</option>
                                            <option value="managementcategory">مدیریت محصول با دسته بندی</option>
                                        </select>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="roles" class="col-md-3 col-form-label">
                                        سطوح کاربری
                                    </label>

                                    <div class="col-md-9">

                                        <select name="roles[]" id="roles" data-live-search="true" data-hide-disabled="true" multiple data-actions-box="true"
                                                class="selectpicker form-control @error('roles') is-invalid @enderror">
                                            @foreach($roles as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('roles')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between">
                                        <div class="col-md-6">
                                            @can(\App\Helper\Helper::getTypePermission('store'))
                                                <button type="submit" class="btn btn-primary w-100">
                                                    ثبت
                                                </button>
                                            @endcan
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ url('Admin/Permission') }}" class="btn btn-outline-primary w-100">
                                                انصراف
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

