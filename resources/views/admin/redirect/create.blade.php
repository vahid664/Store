@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('Admin/Redirect') }}" class="pull-left text-white">
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
                        <form method="post" enctype="multipart/form-data" action="{{ route('Redirect.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="before" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        آدرس قبلی
                                    </label>
                                    <div class="col-md-9">
                                        <input id="before" type="text" title="مقدار دهی الزامی"
                                               class="form-control @error('before') is-invalid @enderror"
                                               name="before" value="{{ old('before') }}" required>
                                        @error('before')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="after" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        آدرس بعدی
                                    </label>
                                    <div class="col-md-9">
                                        <input id="after" type="text" title="مقدار دهی الزامی"
                                               class="form-control @error('after') is-invalid @enderror"
                                               name="after" value="{{ old('after') }}" required>
                                        @error('after')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="type" class="col-md-3 col-form-label">نوع</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="type" name="type">
                                            <option selected value="1">ریدایرکت 301</option>
                                            <option  value="2">کنونیکال</option>
                                        </select>
                                        @error('type')
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
                                            <a href="{{ url('Admin/Redirect') }}" class="btn btn-outline-primary w-100">
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
