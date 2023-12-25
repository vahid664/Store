@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('Admin/Brand') }}" class="pull-left text-white">
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
                        <form method="post" action="{{ route('ManagementBrand.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="brand_id" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        برند </label>
                                    <div class="col-md-9">
                                        <select name="brand_id" id="brand_id" data-live-search="true"
                                                class="selectpicker form-control @error('brand_id') is-invalid @enderror" required>
                                            <option value="">انتخاب</option>
                                            @foreach(\App\Brand::active()->get() as $value)
                                                <option {{ old('brand_id') == $value->id ? 'selected' : ''}} value="{{ $value->id }}">{{ $value->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="section" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        بخش</label>
                                    <div class="col-md-9">
                                        <select name="section" id="section" class="form-control @error('section') is-invalid @enderror" required>
                                            <option {{ old('section') == 1 ? 'selected' : ''}} value="1">وضعیت کالا</option>
                                            <option {{ old('section') == 2 ? 'selected' : ''}} value="2">افزایش درصدی قیمت</option>
                                            <option {{ old('section') == 3 ? 'selected' : ''}} value="3">کاهش درصدی قیمت</option>
                                        </select>
                                        @error('section')
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
                                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                            <option {{ old('status') == 1 ? 'selected' : ''}} value="1">موجود</option>
                                            <option {{ old('status') == 2 ? 'selected' : ''}} value="2">ناموجود</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="darsad" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        درصد افزایش قیمت
                                    </label>
                                    <div class="col-md-9">
                                        <input id="darsad" type="number"
                                               class="form-control @error('darsad') is-invalid @enderror"
                                               name="darsad" value="{{ old('darsad') }}">
                                        @error('darsad')
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
