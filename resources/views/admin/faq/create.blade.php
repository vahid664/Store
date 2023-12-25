@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('Admin/Faq/'.$query->id.'?model='.$request->model) }}" class="pull-left text-white">
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
                        <form method="post" enctype="multipart/form-data" action="{{ route('Faq.store') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $query->id }}">
                            <input type="hidden" name="model" value="{{ $request->model }}">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="question" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        سوال
                                    </label>
                                    <div class="col-md-9">
                                        <input id="question" type="text" placeholder="مثال : راکت"
                                               title="مقدار دهی الزامی"
                                               class="form-control @error('question') is-invalid @enderror"
                                               name="question" value="{{ old('question') }}" required>
                                        @error('question')
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
                                    <label for="answer" class="col-md-12 col-form-label">جواب</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('answer') is-invalid @enderror"
                                                  rows="5" id="answer" name="answer"
                                                  placeholder="اختیاری">{{ old('answer') }}</textarea>
                                        @error('answer')
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
                                            <button type="submit" class="btn btn-primary w-100">
                                                ثبت
                                            </button>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ url('Admin/Faq/'.$query->id.'?model='.$request->model) }}" class="btn btn-outline-primary w-100">
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
        CKEDITOR.replace('answer', {
            language: 'fa',
            filebrowserImageBrowseUrl: '{{asset('/laravel-filemanager?type=Images')}}',
            filebrowserImageUploadUrl: '{{asset('/laravel-filemanager/upload?type=Images&_token=')}}',
            filebrowserBrowseUrl: '{{asset('/laravel-filemanager?type=Files')}}',
            filebrowserUploadUrl: '{{asset('/laravel-filemanager/upload?type=Files&_token=')}}'
        });
    </script>
@endsection
