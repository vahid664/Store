@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('Admin/Page') }}" class="pull-left text-white">
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
                        <form method="post" enctype="multipart/form-data" action="{{ route('Page.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="title" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان
                                    </label>

                                    <div class="col-md-9">
                                        <input id="title" type="text" placeholder="مثال : راکت" title="مقدار دهی الزامی" maxlength="100"
                                               class="form-control input-char-count @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>

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
                                        <input id="title_en" type="text" placeholder="مثال : rocket" title="مقدار دهی الزامی" maxlength="100"
                                               class="form-control input-char-count @error('title_en') is-invalid @enderror" name="title_en"
                                               value="{{ old('title_en') }}" required>

                                        @error('title_en')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="category_id" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        دسته بندی</label>

                                    <div class="col-md-9">
                                        <select name="category_id" id="category_id" data-live-search="true" data-hide-disabled="true" data-actions-box="true"
                                                class="selectpicker form-control @error('category_id') is-invalid @enderror" required>
                                            @foreach(\App\Category::active()->where('parent',14)->with('childern_all')->get() as $value)
                                                @if(old('category_id') != '' && in_array($value->id,old('category_id')))
                                                    <option selected value="{{ $value->id }}">{{ $value->title }}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                @endif
                                                @if($value->childern_all->count())
                                                    @php $i=2; @endphp
                                                    @include('admin.category.cat',['child' => $value->childern_all ,'i' => $i])
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="status" class="col-md-3 col-form-label">وضعیت نمایش</label>

                                    <div class="col-md-9">
                                        <select class="form-control" id="status" name="status">
                                            <option selected value="1">فعال</option>
                                            <option  value="0">غیرفعال</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="keywords" class="col-md-12 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        کلمات کلیدی
                                    </label>
                                    <div class="col-md-12">
                                        <input id="keywords" type="text" pattern=".{3,70}" maxlength="70"
                                               class="form-control input-char-count @error('keywords') is-invalid @enderror"
                                               name="keywords" value="{{ old('keywords') }}">
                                        @error('keywords')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="description" class="col-md-12 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        توضیحات کلمات کلیدی
                                    </label>
                                    <div class="col-md-12">
                                        <input id="description" type="text" pattern=".{3,150}" maxlength="150"
                                               class="form-control input-char-count @error('description') is-invalid @enderror"
                                               name="description" value="{{ old('description') }}">
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="text" class="col-md-12 col-form-label">توضیحات</label>

                                    <div class="col-md-12">
                                        <textarea class="form-control @error('text') is-invalid @enderror" rows="5" id="text" name="text"
                                                  placeholder="اختیاری">{{ old('text') }}</textarea>
                                        @error('text')
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
                                            <a href="{{ url('Admin/Page') }}" class="btn btn-outline-primary w-100">
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
