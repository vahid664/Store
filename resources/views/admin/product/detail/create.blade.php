@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('Admin/ProductDetail?id='.$query->id) }}" class="pull-left text-white">
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
                        <form method="post" enctype="multipart/form-data" action="{{ route('ProductDetail.store') }}">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="product_id" value="{{ $query->id }}">
                                <div class="col-md-6 form-group">
                                    <label for="type" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        دسته</label>

                                    <div class="col-md-9">
                                        <select name="type" id="type" data-live-search="true" data-hide-disabled="true" data-actions-box="true"
                                                class="selectpicker form-control @error('type') is-invalid @enderror">
                                            <option value="1">ویژگی های محصول</option>
                                            <option value="2">مشخصات کلی</option>
                                            <option value="3">امکانات</option>
                                            <option value="4">سایر مشخصات</option>
                                            <option value="5">ویدئو</option>
                                           {{-- @foreach(\App\Color::all() as $value)
                                                @if(old('title_parent') != '' && in_array($value->id,old('title_parent')))
                                                    <option selected value="{{ $value->id }}">{{ $value->title }}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                @endif
                                            @endforeach--}}
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="title2" class="col-md-3 col-form-label">
                                        عناوین قبل
                                    </label>
                                    <div class="col-md-9">
                                        <select name="title2" id="title2" class="form-control @error('title2') is-invalid @enderror">
                                            <option value="">انتخاب</option>
                                            @foreach($titles as $val)
                                                <option value="{{ $val }}">{{ $val }}</option>
                                            @endforeach
                                        </select>
                                        @error('title2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="title" class="col-md-3 col-form-label">
                                        عنوان
                                    </label>
                                    <div class="col-md-9">
                                        <input id="title" type="text" placeholder="مثال : الیت"
                                               class="form-control @error('title') is-invalid @enderror" name="title"
                                               value="{{ old('title') }}">
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="text" class="col-md-12 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        توضیحات
                                    </label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('text') is-invalid @enderror" rows="5" id="text" name="text" required
                                                  placeholder="توضیحات محصول">{{ old('text') }}</textarea>
                                        @error('text')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="status" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        وضعیت</label>
                                    <div class="col-md-9">
                                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                            <option value="1">نمایش</option>
                                            <option value="0">مخفی</option>
                                        </select>
                                        @error('status')
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
                                            @can(\App\Helper\Helper::getTypePermission('create'))
                                                <button type="submit" class="btn btn-primary w-100">
                                                    ثبت
                                                </button>
                                            @endcan
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ url('Admin/ProductDetail?id='.$query->id) }}" class="btn btn-outline-primary w-100">
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
{{--@section('js')
    <script>

        CKEDITOR.replace('long_text', {
            language: 'fa',
            filebrowserImageBrowseUrl: '{{asset('/laravel-filemanager?type=Images')}}',
            filebrowserImageUploadUrl: '{{asset('/laravel-filemanager/upload?type=Images&_token=')}}',
            filebrowserBrowseUrl: '{{asset('/laravel-filemanager?type=Files')}}',
            filebrowserUploadUrl: '{{asset('/laravel-filemanager/upload?type=Files&_token=')}}'
        });
    </script>
@endsection--}}
