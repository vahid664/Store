@extends('layouts.app_admin')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">ویرایش
                        <span class="text-danger">{{ $query->name }}</span>
                        <a href="{{ url('Admin/Permission') }}" class="float-right text-white">بازگشت
                            <i class="fa fa-arrow-left"></i>
                        </a>

                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="post" action="{{ route('Permission.update',$query->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="name" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان
                                    </label>
                                    <div class="col-md-9">
                                        <input id="name" type="text" placeholder="مثال : post-list"
                                               class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $query->name }}"
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
                                            <option {{ $query->title=='user' ? 'selected' : ''  }} value="user">کاربری</option>
                                            <option {{ $query->title=='product' ? 'selected' : ''  }} value="product">محصولات</option>
                                            <option {{ $query->title=='productfile' ? 'selected' : ''  }} value="productfile">فایل های محصولات</option>
                                            <option {{ $query->title=='factor' ? 'selected' : ''  }} value="factor">فاکتور</option>
                                            <option {{ $query->title=='article' ? 'selected' : ''  }} value="article">مقالات</option>
                                            <option {{ $query->title=='articlefile' ? 'selected' : ''  }} value="articlefile">فایل های مقالات</option>
                                            <option {{ $query->title=='brand' ? 'selected' : ''  }} value="brand">برند</option>
                                            <option {{ $query->title=='advertise' ? 'selected' : ''  }} value="advertise">بنر</option>
                                            <option {{ $query->title=='tag' ? 'selected' : ''  }} value="tag">تگ</option>
                                            <option {{ $query->title=='page' ? 'selected' : ''  }} value="page">صفحات ثابت</option>
                                            <option {{ $query->title=='news' ? 'selected' : ''  }} value="news">لیست خبرنامه</option>
                                            <option {{ $query->title=='social' ? 'selected' : ''  }} value="social">شبکه های اجتماعی</option>
                                            <option {{ $query->title=='group' ? 'selected' : ''  }} value="group">گروه بندی</option>
                                            <option {{ $query->title=='role' ? 'selected' : ''  }} value="role">سطوح کاربری</option>
                                            <option {{ $query->title=='permission' ? 'selected' : ''  }} value="permission">سطح دسترسی</option>
                                            <option {{ $query->title=='productdetail' ? 'selected' : ''  }} value="productdetail">ویژگی های محصول</option>
                                            <option {{ $query->title=='productawesome' ? 'selected' : ''  }} value="productawesome">محصولات ویژه</option>
                                            <option {{ $query->title=='color' ? 'selected' : ''  }} value="color">رنگبندی</option>
                                            <option {{ $query->title=='contact' ? 'selected' : ''  }} value="contact">مشاوره</option>
                                            <option {{ $query->title=='off' ? 'selected' : ''  }} value="off">کد تخفیف</option>
                                            <option {{ $query->title=='peyk' ? 'selected' : ''  }} value="peyk">پیک</option>
                                            <option {{ $query->title=='financial' ? 'selected' : ''  }} value="financial">گزارش مالی</option>
                                            <option {{ $query->title=='size' ? 'selected' : ''  }} value="size">سایز بندی محصولات</option>
                                            <option {{ $query->title=='productupdate' ? 'selected' : ''  }} value="productupdate">به روزرسانی آنی محصول</option>
                                            <option {{ $query->title=='search' ? 'selected' : ''  }} value="search">جستجو</option>
                                            <option {{ $query->title=='redirect' ? 'selected' : ''  }} value="redirect">ریدایرکت</option>
                                            <option {{ $query->title=='gift' ? 'selected' : ''  }} value="gift">هدیه</option>
                                            <option {{ $query->title=='productreport' ? 'selected' : ''  }} value="productreport">گزارش گیری محصول</option>
                                            <option {{ $query->title=='copyproduct' ? 'selected' : ''  }} value="copyproduct">کپی محصول</option>
                                            <option {{ $query->title=='copyprocat' ? 'selected' : ''  }} value="copyprocat">کپی محصول دسته</option>
                                            <option {{ $query->title=='managementbrand' ? 'selected' : ''  }} value="managementbrand">مدیریت محصول با برند</option>
                                            <option {{ $query->title=='productreturned' ? 'selected' : ''  }} value="productreturned">مرجوعی محصول</option>
                                            <option {{ $query->title=='faq' ? 'selected' : ''  }} value="faq">faq</option>
                                            <option {{ $query->title=='commentadmin' ? 'selected' : ''  }} value="commentadmin">نظرات</option>
                                            <option {{ $query->title=='reportfactor' ? 'selected' : ''  }} value="reportfactor">گزارش گیری رفتار خرید</option>
                                            <option {{ $query->title=='productsize' ? 'selected' : ''  }} value="productsize">مدیریت سایزبندی محصول</option>
                                            <option {{ $query->title=='productofferadmin' ? 'selected' : ''  }} value="productofferadmin">قیمت پیشنهادی</option>
                                            <option {{ $query->title=='managementcategory' ? 'selected' : ''  }} value="managementcategory">مدیریت محصول با دسته بندی</option>
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
                                        <i class="fa fa-star text-danger"></i>
                                        سطوح کاربری
                                    </label>

                                    <div class="col-md-9">

                                        <select name="roles[]" id="roles" data-live-search="true" data-hide-disabled="true" multiple data-actions-box="true"
                                                class="selectpicker {{ __('direction.text-position') }} form-control @error('roles') is-invalid @enderror">
                                            @foreach(\Spatie\Permission\Models\Role::all() as $value)
                                                @if(in_array($value->id,$role_has))
                                                    <option selected value="{{ $value->id }}">{{ $value->name }}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endif
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
                                            @can(\App\Helper\Helper::getTypePermission('update'))
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

