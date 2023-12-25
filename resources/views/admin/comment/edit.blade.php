@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('Admin/CommentAdmin') }}" class="pull-left text-white">
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
                        <form method="post" enctype="multipart/form-data" action="{{ route('CommentAdmin.update',$query->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="title" class="col-md-3 col-form-label">
                                        عنوان
                                    </label>
                                    <div class="col-md-9">
                                        <input id="title" type="text" placeholder="مثال : راکت" title="مقدار دهی الزامی" maxlength="255"
                                               class="form-control input-char-count @error('title') is-invalid @enderror" name="title" value="{{ $query->title }}" >

                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="status" class="col-md-3 col-form-label">وضعیت: </label>
                                    <div class="col-md-9">
                                        <select id="status" name="status" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}">
                                            <option {{ $query->status == 0 ? 'selected' : '' }} value="0">در انتظار</option>
                                            <option {{ $query->status == 1 ? 'selected' : '' }} value="1">تایید شده</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="accept" class="col-md-3 col-form-label">جواب برتر: </label>
                                    <div class="col-md-9">
                                        <select id="accept" name="accept"
                                                class="form-control {{ $errors->has('accept') ? ' is-invalid' : '' }}">
                                            <option {{ $query->accept == 0 ? 'selected' : '' }} value="0">خیر</option>
                                            <option {{ $query->accept == 1 ? 'selected' : '' }} value="1">بله</option>
                                        </select>
                                        @if($errors->has('accept'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('accept') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-12">
                                    <label for="vote" class="col-md-3 col-form-label">رای: </label>
                                    <div class="col-md-9">
                                        <input id="vote" type="number"
                                           class="form-control {{ $errors->has('vote') ? ' is-invalid' : '' }}"
                                           name="vote" value="{{  $query->vote }}">
                                        @if ($errors->has('vote'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('vote') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-lg-6 col-12">
                                    <label for="parent" class="col-md-3 col-form-label">
                                        پاسخ به
                                    </label>
                                    <div class="col-md-9">
                                        <select name="parent" id="parent" data-live-search="true"
                                                class="selectpicker text-right
                                                     form-control {{ $errors->has('parent') ? ' is-invalid' : '' }}">
                                            <option value="0">انتخاب</option>
                                            @if($query->parent == 0)
                                                @foreach(\App\Comment::where('id',$query->id)->with('child')->get() as $value)
                                                    <option {{ $query->parent == $value->id ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->title == '' ? \Illuminate\Support\Str::limit(strip_tags($value->text),60) : $value->title }}</option>
                                                    @if($value->child->count())
                                                        @php $i=1; @endphp
                                                        @include('admin.comment.child',['child' => $value->child ,'i' => $i])
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach(\App\Comment::where('id',$query->parent)->with('child')->get() as $value)
                                                    <option {{ $query->parent == $value->id ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->title == '' ? \Illuminate\Support\Str::limit(strip_tags($value->text),60) : $value->title }}</option>
                                                    @if($value->child->count())
                                                        @php $i=1; @endphp
                                                        @include('admin.comment.child',['child' => $value->child ,'i' => $i])
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('parent'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('parent') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="text" class="col-md-12 col-form-label">توضیحات</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('text') is-invalid @enderror" rows="5" id="text" name="text"
                                                  placeholder="اختیاری">{{ $query->text }}</textarea>
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
                                            @can(\App\Helper\Helper::getTypePermission('update'))
                                                <button type="submit" class="btn btn-primary w-100">
                                                    ثبت
                                                </button>
                                            @endcan
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ url('Admin/CommentAdmin') }}" class="btn btn-outline-primary w-100">
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
