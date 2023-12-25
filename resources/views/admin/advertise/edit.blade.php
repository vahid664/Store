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
                        <form method="post" enctype="multipart/form-data" action="{{ route('Advertise.update',$query->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="title" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان
                                    </label>

                                    <div class="col-md-9">
                                        <input id="title" type="text" placeholder="مثال : راکت" title="مقدار دهی الزامی"
                                               class="form-control @error('title') is-invalid @enderror" name="title"
                                               value="{{ $query->title }}" required>

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
                                               value="{{ $query->title_en }}" required>

                                        @error('title_en')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="pic" class="col-md-3 col-form-label">
                                        تصویر
                                    </label>
                                    <div class="col-md-9">
                                        <input id="pic" type="file"
                                               class="form-control @error('pic') is-invalid @enderror" name="pic">
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
                                               value="{{ $query->pic_alt }}">
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
                                               value="{{ $query->url }}" required>
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
                                               value="{{ $query->description }}">
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
                                            <option {{ $query->status == 1 ? 'selected' : '' }} value="1">فعال</option>
                                            <option {{ $query->status == 0 ? 'selected' : '' }} value="0">غیرفعال</option>
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
                                            <option {{ $query->where_page == 1 ? 'selected' : '' }} value="1">صفحه اصلی</option>
                                            <option {{ $query->where_page == 2 ? 'selected' : '' }} value="2">دسته بندی</option>
                                            <option {{ $query->where_page == 3 ? 'selected' : '' }} value="3">برند</option>
                                            <option {{ $query->where_page == 4 ? 'selected' : '' }} value="4">محصول</option>
                                            <option {{ $query->where_page == 5 ? 'selected' : '' }} value="5">تگ</option>
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
                                            <option {{ $query->location == 1 ? 'selected' : '' }} value="1">اسلایدر اصلی</option>
                                            <option {{ $query->location == 2 ? 'selected' : '' }} value="2">بالای صفحه</option>
                                            <option {{ $query->location == 3 ? 'selected' : '' }} value="3">سمت راست صفحه</option>
                                            <option {{ $query->location == 4 ? 'selected' : '' }} value="4">بین محصولات 1</option>
                                            <option {{ $query->location == 5 ? 'selected' : '' }} value="5">بین محصولات 2</option>
                                            <option {{ $query->location == 6 ? 'selected' : '' }} value="6">بین محصولات 3</option>
                                            <option {{ $query->location == 7 ? 'selected' : '' }} value="7">بین محصولات 4</option>
                                            <option {{ $query->location == 8 ? 'selected' : '' }} value="8">پایان صفحه</option>
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
                                            <option {{ $query->size == 1 ? 'selected' : '' }} value="1">کامل</option>
                                            <option {{ $query->size == 2 ? 'selected' : '' }} value="2">نیمه</option>
                                            <option {{ $query->size == 3 ? 'selected' : '' }} value="3">یک چهارم</option>
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
                                            <option {{ $query->platform_status == 0 ? 'selected' : '' }} value="0">همه</option>
                                            <option {{ $query->platform_status == 1 ? 'selected' : '' }} value="1">فقط pc</option>
                                            <option {{ $query->platform_status == 2 ? 'selected' : '' }} value="2">فقط موبایل</option>
                                            <option {{ $query->platform_status == 3 ? 'selected' : '' }} value="3">فقط تبلت</option>
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
                                            <option {{ $query->type_open == 1 ? 'selected' : '' }} value="1">صفحه جدید</option>
                                            <option {{ $query->type_open == 2 ? 'selected' : '' }} value="2">صفحه فعلی</option>
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
                                            <option {{ $query->ads_type == 1 ? 'selected' : '' }} value="1">بنر داخلی</option>
                                            <option {{ $query->ads_type == 2 ? 'selected' : '' }} value="2">تبلیغ داخلی</option>
                                            <option {{ $query->ads_type == 3 ? 'selected' : '' }} value="3">تبلیغ خارجی</option>
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
                                            <option {{ $query->banner_type == 1 ? 'selected' : '' }} value="1">تصویر</option>
                                            <option {{ $query->banner_type == 2 ? 'selected' : '' }} value="2">تصویر و متن</option>
                                            <option {{ $query->banner_type == 3 ? 'selected' : '' }} value="3">متن</option>
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
                                               value="{{ $query->button_title }}">
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
                                        <input id="date_start" type="text" placeholder="مثال : خرید" required
                                               class="form-control @error('date_start') is-invalid @enderror" name="date_start"
                                               value="{{ \Carbon\Carbon::parse($query->date_start)->format('Y/m/d') }}">
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
                                        <input id="date_end" type="text" placeholder="مثال : خرید"
                                               class="form-control @error('date_end') is-invalid @enderror" name="date_end"
                                               value="{{ $query->date_end != '' ? \Carbon\Carbon::parse($query->date_end)->format('Y/m/d') : '' }}">
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
                                            @can(\App\Helper\Helper::getTypePermission('update'))
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
