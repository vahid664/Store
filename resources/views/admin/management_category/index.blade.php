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
                        <form method="post" action="{{ route('ManagementCategory.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="category_id" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        دسته بندی </label>
                                    <div class="col-md-9">
                                        <select name="category_id" id="category_id" data-live-search="true"
                                                class="selectpicker form-control @error('category_id') is-invalid @enderror" required>
                                            <option value="">انتخاب</option>
                                            @foreach(\App\Category::where('parent' , 1)->with('childern')->get() as $value)
                                                <option {{ old('category_id') == $value->id ? 'selected' : ''}} value="{{ $value->id }}">{{ $value->title }}</option>
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
                                    <label for="section" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        بخش</label>
                                    <div class="col-md-9">
                                        <select name="section" id="section" class="form-control @error('section') is-invalid @enderror" required>
                                            <option {{ old('section') == 1 ? 'selected' : ''}} value="1">افزایش درصدی قیمت</option>
                                            <option {{ old('section') == 2 ? 'selected' : ''}} value="2">کاهش درصدی قیمت</option>
                                        </select>
                                        @error('section')
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
