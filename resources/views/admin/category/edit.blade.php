@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('Admin/Category') }}" class="pull-left text-white">
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
                        <form method="post" enctype="multipart/form-data" action="{{ route('Category.update',$query->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="title" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان
                                    </label>

                                    <div class="col-md-9">
                                        <input id="title" type="text" placeholder="مثال : راکت" title="مقدار دهی الزامی" maxlength="100"
                                               class="form-control input-char-count @error('title') is-invalid @enderror" name="title" value="{{ $query->title }}" required>

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
                                               value="{{ $query->title_en }}" required>

                                        @error('title_en')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="title_page" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان صفحه
                                    </label>

                                    <div class="col-md-9">
                                        <input id="title_page" type="text" title="مقدار دهی الزامی" maxlength="100"
                                               class="form-control input-char-count {{ $errors->has('title_page') ? ' is-invalid' : '' }}"
                                               name="title_page" value="{{  $query->title_page }}"
                                               required autocomplete="title_page">
                                        @if ($errors->has('title_page'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title_page') }}</strong>
                                            </span>
                                        @endif
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
                                        عنوان تصویر
                                    </label>
                                    <div class="col-md-9">
                                        <input id="pic_alt" type="text" placeholder="مثال : راکت" maxlength="100"
                                               class="form-control input-char-count @error('pic_alt') is-invalid @enderror" name="pic_alt"
                                               value="{{ $query->pic_alt }}">
                                        @error('pic_alt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="type" class="col-md-3 col-form-label"> لوگو روی محصول</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="type" name="type">
                                            <option {{ $query->type == 2 ? 'selected' : '' }} value="2">فعال</option>
                                            <option {{ $query->type == 1 ? 'selected' : '' }} value="1">غیرفعال</option>
                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="keywords" class="col-md-12 col-form-label">
                                        کلمات کلیدی
                                    </label>
                                    <div class="col-md-12">
                                        <input id="keywords" type="text" placeholder="مثال : راکت" maxlength="70"
                                               class="form-control input-char-count @error('keywords') is-invalid @enderror" name="keywords"
                                               value="{{ $query->keywords }}">
                                        @error('keywords')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="description" class="col-md-12 col-form-label">
                                        توضیحات کلمات کلیدی
                                    </label>
                                    <div class="col-md-12">
                                        <input id="description" type="text" placeholder="مثال : راکت" maxlength="150"
                                               class="form-control input-char-count @error('description') is-invalid @enderror" name="description"
                                               value="{{ $query->description }}">
                                        @error('description')
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
                                    <label for="menu" class="col-md-3 col-form-label">نمایش در منو</label>

                                    <div class="col-md-9">
                                        <select class="form-control" id="menu" name="menu">
                                            <option {{ $query->menu == 1 ? 'selected' : '' }} value="1">فعال</option>
                                            <option {{ $query->menu == 0 ? 'selected' : '' }} value="0">غیرفعال</option>
                                        </select>
                                        @error('menu')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="short_text" class="col-md-12 col-form-label">توضیحات کوتاه</label>

                                    <div class="col-md-12">
                                        <textarea class="form-control @error('short_text') is-invalid @enderror"
                                                  rows="5" id="short_text" name="short_text"
                                                  placeholder="اختیاری">{{ $query->short_text }}</textarea>
                                        @error('short_text')
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
                                                  placeholder="اختیاری">{{$query->text }}</textarea>
                                        @error('text')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12  table-responsive">
                                <div class="col-md-12 form-group">
                                    <label for="category_id" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        گروه</label>

                                    <div class="col-md-9">
                                        <div id="jstree2">
                                            <ul>
                                                <li>
                                                    <a onclick="cat(0);">هیچ کدام</a>
                                                </li>
                                                @foreach(\App\Category::where('parent',0)->with('childern')->get() as $value)
                                                    <li id="cat{{ $value->id }}">
                                                        <a onclick="cat({{ $value->id }})">{{ $value->title }}</a>
                                                        @if($value->childern()->count())
                                                            @include('admin.temp.cat',['child' => $value->childern])
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <input type="hidden" id="parent" name="parent" value="{{ $query->parent }}">

                                        <div class="col-12 text-info mt-5">
                                            حتما یکی از گروه ها باید انتخاب شود، با کلیک، گروه مورد نظر انتخاب می گردد.
                                        </div>
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
                                            <a href="{{ url('Admin/Category') }}" class="btn btn-outline-primary w-100">
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

        CKEDITOR.replace('short_text', {
            language: 'fa',
            filebrowserImageBrowseUrl: '{{asset('/laravel-filemanager?type=Images')}}',
            filebrowserImageUploadUrl: '{{asset('/laravel-filemanager/upload?type=Images&_token=')}}',
            filebrowserBrowseUrl: '{{asset('/laravel-filemanager?type=Files')}}',
            filebrowserUploadUrl: '{{asset('/laravel-filemanager/upload?type=Files&_token=')}}'
        });


        function cat(id)
        {
            $('#parent').val(id);
        }
        $(document).ready(function() {
            $('#jstree2').jstree({
                'core': {
                    'check_callback': true
                },
                'plugins': ['types', 'dnd'],
                'types': {
                    'default': {
                        'icon': 'fa fa-folder'
                    },
                    'html': {
                        'icon': 'fa fa-file-code-o'
                    },
                    'svg': {
                        'icon': 'fa fa-file-picture-o'
                    },
                    'css': {
                        'icon': 'fa fa-file-code-o'
                    },
                    'img': {
                        'icon': 'fa fa-file-image-o'
                    },
                    'js': {
                        'icon': 'fa fa-file-text-o'
                    }

                }
            });
            $('#cat{{$query->parent}}').parents('li').addClass('jstree-open');
            $('#cat{{$query->parent}}').addClass('jstree-open');
            $('#cat{{$query->id}} > a').addClass('jstree-clicked');
        });
    </script>
@endsection
