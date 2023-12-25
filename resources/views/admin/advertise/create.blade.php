@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('Admin/Advertise') }}" class="pull-left text-white">
                            برگشت
                            <i class="fa fa-arrow-left"></i>
                        </a>

                    </div>
                    <div class="card-body">
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
                        <form method="post" enctype="multipart/form-data" action="{{ route('Advertise.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="title" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان
                                    </label>

                                    <div class="col-md-9">
                                        <input id="title" type="text" placeholder="مثال : راکت" title="مقدار دهی الزامی"
                                               class="form-control @error('title') is-invalid @enderror" name="title"
                                               value="{{ old('title') }}" required>

                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="title_en" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان انگلیسی
                                    </label>
                                    <div class="col-md-9">
                                        <input id="title_en" type="text" placeholder="مثال : rocket" title="مقدار دهی الزامی"
                                               class="form-control @error('title_en') is-invalid @enderror" name="title_en"
                                               value="{{ old('title_en') }}" required>

                                        @error('title_en')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="pic" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        تصویر
                                    </label>
                                    <div class="col-md-9">
                                        <input id="pic" type="file"
                                               class="form-control @error('pic') is-invalid @enderror" name="pic" required>
                                        @error('pic')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="pic_alt" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان تصویر
                                    </label>
                                    <div class="col-md-9">
                                        <input id="pic_alt" type="text" placeholder="مثال : راکت" required
                                               class="form-control @error('pic_alt') is-invalid @enderror" name="pic_alt"
                                               value="{{ old('pic_alt') }}">
                                        @error('pic_alt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="url" class="col-md-12 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        آدرس صفحه مقصد
                                    </label>
                                    <div class="col-md-12">
                                        <input id="url" type="text"
                                               class="form-control @error('url') is-invalid @enderror" name="url"
                                               value="{{ old('url') }}" required>
                                        @error('url')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="description" class="col-md-12 col-form-label">
                                        توضیحات
                                    </label>
                                    <div class="col-md-12">
                                        <input id="description" type="text"
                                               class="form-control @error('description') is-invalid @enderror"
                                               name="description"
                                               value="{{ old('description') }}">
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="status" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        وضعیت نمایش</label>

                                    <div class="col-md-9">
                                        <select class="form-control" id="status" name="status" required>
                                            <option {{ old('status') == 1 ? 'selected' : '' }} value="1">فعال</option>
                                            <option {{ old('status') == 0 ? 'selected' : '' }} value="0">غیرفعال</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="where_page" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        نمایش در صفحه
                                    </label>

                                    <div class="col-md-9">
                                        <select class="form-control" id="where_page" name="where_page" required>
                                            <option value="">انتخاب</option>
                                            <option {{ old('where_page') == 1 ? 'selected' : '' }} value="1">صفحه اصلی</option>
                                            <option {{ old('where_page') == 2 ? 'selected' : '' }} value="2">دسته بندی</option>
                                            <option {{ old('where_page') == 3 ? 'selected' : '' }} value="3">برند</option>
                                            <option {{ old('where_page') == 4 ? 'selected' : '' }} value="4">محصول</option>
                                            <option {{ old('where_page') == 5 ? 'selected' : '' }} value="5">تگ</option>
                                        </select>
                                        @error('where_page')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="location" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        مکان در صفحه
                                    </label>

                                    <div class="col-md-9">
                                        <select class="form-control" id="location" name="location" required>
                                            <option value="">انتخاب</option>
                                            <option {{ old('location') == 1 ? 'selected' : '' }} value="1">اسلایدر اصلی</option>
                                            <option {{ old('location') == 2 ? 'selected' : '' }} value="2">بالای صفحه</option>
                                            <option {{ old('location') == 3 ? 'selected' : '' }} value="3">سمت راست صفحه</option>
                                            <option {{ old('location') == 4 ? 'selected' : '' }} value="4">بین محصولات 1</option>
                                            <option {{ old('location') == 5 ? 'selected' : '' }} value="5">بین محصولات 2</option>
                                            <option {{ old('location') == 6 ? 'selected' : '' }} value="6">بین محصولات 3</option>
                                            <option {{ old('location') == 7 ? 'selected' : '' }} value="7">بین محصولات 4</option>
                                            <option {{ old('location') == 8 ? 'selected' : '' }} value="8">پایان صفحه</option>
                                        </select>
                                        @error('location')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="size" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        اندازه
                                    </label>

                                    <div class="col-md-9">
                                        <select class="form-control" id="size" name="size" required>
                                            <option value="">انتخاب</option>
                                            <option {{ old('size') == 1 ? 'selected' : '' }} value="1">کامل</option>
                                            <option {{ old('size') == 2 ? 'selected' : '' }} value="2">نیمه</option>
                                            <option {{ old('size') == 3 ? 'selected' : '' }} value="3">یک چهارم</option>
                                        </select>
                                        @error('size')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="platform_status" class="col-md-3 col-form-label">
                                        نمایش برای دستگاه
                                    </label>

                                    <div class="col-md-9">
                                        <select class="form-control" id="platform_status" name="platform_status">
                                            <option {{ old('platform_status') == 0 ? 'selected' : '' }} value="0">همه</option>
                                            <option {{ old('platform_status') == 1 ? 'selected' : '' }} value="1">فقط pc</option>
                                            <option {{ old('platform_status') == 2 ? 'selected' : '' }} value="2">فقط موبایل</option>
                                            <option {{ old('platform_status') == 3 ? 'selected' : '' }} value="3">فقط تبلت</option>
                                        </select>
                                        @error('platform_status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="type_open" class="col-md-3 col-form-label">
                                        نحوه نمایش
                                    </label>

                                    <div class="col-md-9">
                                        <select class="form-control" id="type_open" name="type_open">
                                            <option {{ old('type_open') == 1 ? 'selected' : '' }} value="1">صفحه جدید</option>
                                            <option {{ old('type_open') == 2 ? 'selected' : '' }} value="2">صفحه فعلی</option>
                                        </select>
                                        @error('type_open')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="ads_type" class="col-md-3 col-form-label">
                                        نحوه تبلیغ
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="ads_type" name="ads_type">
                                            <option {{ old('ads_type') == 1 ? 'selected' : '' }} value="1">بنر داخلی</option>
                                            <option {{ old('ads_type') == 2 ? 'selected' : '' }} value="2">تبلیغ داخلی</option>
                                            <option {{ old('ads_type') == 3 ? 'selected' : '' }} value="3">تبلیغ خارجی</option>
                                        </select>
                                        @error('ads_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="banner_type" class="col-md-3 col-form-label">
                                        نوع بنر
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="banner_type" name="banner_type">
                                            <option {{ old('banner_type') == 1 ? 'selected' : '' }} value="1">تصویر</option>
                                            <option {{ old('banner_type') == 2 ? 'selected' : '' }} value="2">تصویر و متن</option>
                                            <option {{ old('banner_type') == 3 ? 'selected' : '' }} value="3">متن</option>
                                        </select>
                                        @error('banner_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="button_title" class="col-md-3 col-form-label">
                                        عنوان دکمه
                                    </label>
                                    <div class="col-md-9">
                                        <input id="button_title" type="text" placeholder="مثال : خرید"
                                               class="form-control @error('button_title') is-invalid @enderror"
                                               name="button_title"
                                               value="{{ old('button_title') }}">
                                        @error('button_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="date_start" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        تاریخ شروع نمایش
                                    </label>
                                    <div class="col-md-9">
                                        <input id="date_start" type="text" placeholder="مثال : خرید" required autocomplete="off"
                                               class="form-control @error('date_start') is-invalid @enderror" name="date_start"
                                               value="{{ old('date_start') }}">
                                        @error('date_start')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="date_end" class="col-md-3 col-form-label">
                                        تاریخ پایان نمایش
                                    </label>
                                    <div class="col-md-9">
                                        <input id="date_end" type="text" placeholder="مثال : خرید" autocomplete="off"
                                               class="form-control @error('date_end') is-invalid @enderror" name="date_end"
                                               value="{{ old('date_end') }}">
                                        @error('date_end')
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
                                            <a href="{{ url('Admin/Advertise') }}" class="btn btn-outline-primary w-100">
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
@section('js')
    <script>
        $("#date_start, #date_end").persianDatepicker({
            formatDate: "YYYY/0M/0D",
            showGregorianDate: true
        });

    </script>
@endsection
