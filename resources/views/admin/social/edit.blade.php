@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('Admin/Social') }}" class="pull-left text-white">
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
                        <form method="post" enctype="multipart/form-data" action="{{ route('Social.update',$query->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="title" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان
                                    </label>

                                    <div class="col-md-9">
                                        <input id="title" type="text" placeholder="مثال : تلگرام" title="مقدار دهی الزامی"
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
                                    <label for="url" class="col-md-3 col-form-label">
                                        آدرس صفحه
                                    </label>
                                    <div class="col-md-9">
                                        <input id="url" type="text" placeholder="مثال : https://t.me/jobteamir"
                                               class="form-control @error('url') is-invalid @enderror" name="url"
                                               value="{{ $query->url }}">
                                        @error('url')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="type" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        نوع</label>

                                    <div class="col-md-9">
                                        <select class="form-control @error('type') is-invalid @enderror"
                                                required id="type" name="type">
                                            <option value="">یک مورد را انتخاب کنید</option>
                                            <option {{ $query->type == 1 ? 'selected' : '' }} value="1">آدرس</option>
                                            <option {{ $query->type == 2 ? 'selected' : '' }} value="2">موبایل</option>
                                            <option {{ $query->type == 3 ? 'selected' : '' }} value="3">تلفن</option>
                                            <option {{ $query->type == 4 ? 'selected' : '' }} value="4">تلگرام</option>
                                            <option {{ $query->type == 5 ? 'selected' : '' }} value="5">اینستاگرام</option>
                                            <option {{ $query->type == 6 ? 'selected' : '' }} value="6">فیسبوک</option>
                                            <option {{ $query->type == 7 ? 'selected' : '' }} value="7">آپارات</option>
                                            <option {{ $query->type == 8 ? 'selected' : '' }} value="8">توییتر</option>
                                            <option {{ $query->type == 9 ? 'selected' : '' }} value="9">لینکدین</option>
                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="status" class="col-md-3 col-form-label">وضعیت نمایش</label>

                                    <div class="col-md-9">
                                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
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


                                <div class="col-md-12 form-group">
                                    <label for="description" class="col-md-12 col-form-label">توضیحات</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                  rows="5" id="description" name="description"
                                                  placeholder="اختیاری">{{ $query->description }}</textarea>
                                        @error('description')
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
                                            <a href="{{ url('Admin/Brand') }}" class="btn btn-outline-primary w-100">
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

        CKEDITOR.replace('text', {
            language: 'fa',
            filebrowserImageBrowseUrl: '{{asset('/laravel-filemanager?type=Images')}}',
            filebrowserImageUploadUrl: '{{asset('/laravel-filemanager/upload?type=Images&_token=')}}',
            filebrowserBrowseUrl: '{{asset('/laravel-filemanager?type=Files')}}',
            filebrowserUploadUrl: '{{asset('/laravel-filemanager/upload?type=Files&_token=')}}'
        });
    </script>
@endsection
