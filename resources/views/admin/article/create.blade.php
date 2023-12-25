@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('Admin/Article') }}" class="pull-left text-white">
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
                        <form method="post" enctype="multipart/form-data" action="{{ route('Article.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="title_en" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان لاتین
                                    </label>
                                    <div class="col-md-9">
                                        <input id="title_en" type="text" placeholder="example:Elit" maxlength="100"
                                               class="form-control input-char-count text-left latin @error('title_en') is-invalid @enderror" name="title_en" value="{{ old('title_en') }}"
                                               required  title=" نام برند به لاتین و فقط برای ادمین قابل نمایش می باشد.">
                                        @error('title_en')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="title" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان فارسی
                                    </label>
                                    <div class="col-md-9">
                                        <input id="title" type="text" placeholder="مثال : الیت" maxlength="100"
                                               class="form-control input-char-count @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="index" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        پین شده</label>
                                    <div class="col-md-9">
                                        <select name="index" id="index" class="form-control @error('index') is-invalid @enderror" required>
                                            <option {{ old('index') == 0 ? 'selected' : '' }} value="0">هیچکدام</option>
                                            <option {{ old('index') == 1 ? 'selected' : '' }} value="1">مقالات اصلی</option>
                                        </select>
                                        @error('index')
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
                                             <option value="">انتخاب</option>
                                             @foreach(\App\Category::active()->where('parent',2)->with('childern_all')->get() as $value)
                                                 @if($value->id == old('category_id'))
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


                                <div class="col-md-12 form-group">
                                    <label for="keywords" class="col-md-12 col-form-label">
                                        تگ های مقاله
                                    </label>
                                    <div class="col-md-12">
                                        <select class="js-example-basic-multiple form-control @error('tags') is-invalid @enderror"
                                                name="tags[]" id="tags" multiple="multiple">
                                            @foreach(\App\Tag::all() as $value)
                                                @if(old('tags') != null && in_array($value->id,old('tags')))
                                                    <option selected value="{{ $value->id }}">{{ $value->title }} / {{ $value->title_en }}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->title }} / {{ $value->title_en }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('tags')
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
                                    <label for="short_text" class="col-md-12 col-form-label">
                                        متن کوتاه
                                    </label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('short_text') is-invalid @enderror" rows="3" id="short_text" name="short_text"
                                                  placeholder="غیرضروری">{{ old('short_text') }}</textarea>
                                        @error('short_text')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-12 form-group">
                                    <label for="long_text" class="col-md-12 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        متن طولانی
                                    </label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('long_text') is-invalid @enderror" rows="5" id="long_text" name="long_text" required
                                                  placeholder="توضیحات ">{{ old('long_text') }}</textarea>
                                        @error('long_text')
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
                                    <label for="before" class="col-md-3 col-form-label">
                                        مقاله قبلی</label>

                                    <div class="col-md-9">
                                        <select name="before" id="before" data-live-search="true" data-hide-disabled="true"
                                                data-actions-box="true"
                                                class="selectpicker form-control @error('before') is-invalid @enderror">
                                            <option value="">انتخاب</option>
                                            @foreach(\App\Article::active()->orderByDesc('id')->get() as $value)
                                                <option {{ old('before') == $value->id ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('before')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="after" class="col-md-3 col-form-label">
                                        مقاله بعدی</label>

                                    <div class="col-md-9">
                                        <select name="after" id="after" data-live-search="true" data-hide-disabled="true"
                                                data-actions-box="true"
                                                class="selectpicker form-control @error('after') is-invalid @enderror">
                                            <option value="">انتخاب</option>
                                            @foreach(\App\Article::active()->orderByDesc('id')->get() as $value)
                                                <option {{ old('after') == $value->id ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('after')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="period" class="col-md-3 col-form-label">
                                        زمان مطالعه
                                    </label>
                                    <div class="col-md-9">
                                        <input id="period" type="number"
                                               class="form-control @error('period') is-invalid @enderror"
                                               name="period" value="{{ old('period',10) }}" >
                                        @error('period')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr>
                                </div>
                                <div class="col-12 mb-4">
                                    <div class="d-flex justify-content-between">
                                        <div><h3>تصاویر</h3></div>
                                        <div class="pr-lg-3">
                                            <button type="button" onclick="add_row();" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
                                            <button type="button" onclick="del_row();" class="btn btn-danger btn-sm mr-1"><i class="fa fa-minus"></i></button>
                                        </div>

                                    </div>
                                </div>

                                <div class="row col-12 row-file">
                                    <div class="col-md-6 form-group">
                                        <label for="title_file" class="col-md-3 col-form-label">
                                            عنوان</label>
                                        <div class="col-md-9">
                                            <input id="title_file" type="text" class="form-control @error('title_file') is-invalid @enderror" name="title_file[]">
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="files" class="col-md-3 col-form-label">
                                            فایل تصویر</label>
                                        <div class="col-md-9">
                                            <input id="files" type="file" class="form-control @error('files') is-invalid @enderror" name="files[]">
                                        </div>
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
                                            <a href="{{ url('Admin/Article') }}" class="btn btn-outline-primary w-100">
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

        CKEDITOR.replace('long_text', {
            language: 'fa',
            filebrowserImageBrowseUrl: '{{asset('/laravel-filemanager?type=Images')}}',
            filebrowserImageUploadUrl: '{{asset('/laravel-filemanager/upload?type=Images&_token=')}}',
            filebrowserBrowseUrl: '{{asset('/laravel-filemanager?type=Files')}}',
            filebrowserUploadUrl: '{{asset('/laravel-filemanager/upload?type=Files&_token=')}}'
        });

        function add_row() {
            $('.row-file').append('<div class="col-md-6 form-group">'+
                '<label for="title_file" class="col-md-3 col-form-label">عنوان</label>'+
                '<div class="col-md-9">'+
                '<input id="title_file" type="text" class="form-control" name="title_file[]">'+
                '</div>'+
                '</div>'+
                '<div class="col-md-6 form-group">'+
                '<label for="files" class="col-md-3 col-form-label">فایل تصویر</label>'+
                '<div class="col-md-9">'+
                '<input id="files" type="file" class="form-control" name="files[]"></div></div>');
        }

        function del_row() {
            $('.row-file .form-group:last').remove();
            $('.row-file .form-group:last').remove();
        }

    </script>
@endsection
