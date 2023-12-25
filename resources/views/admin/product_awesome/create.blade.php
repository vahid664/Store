@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('Admin/ProductAwesome') }}" class="pull-left text-white">
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
                        <form method="post" enctype="multipart/form-data" action="{{ route('ProductAwesome.store') }}">
                            @csrf

                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label for="product_id" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        محصول</label>

                                    <div class="col-md-9">
                                        <select name="product_id" id="product_id" data-live-search="true" data-hide-disabled="true" data-actions-box="true"
                                                class="selectpicker form-control @error('product_id') is-invalid @enderror" required>
                                            <option value="">انتخاب</option>
                                            @foreach($product as $value)
                                                @if($value->id==old('product_id'))
                                                    <option selected value="{{ $value->id }}">{{ $value->title }}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="title" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان در نمایش
                                    </label>

                                    <div class="col-md-9">
                                        <input id="title" type="text" placeholder="مثال : راکت" title="مقدار دهی الزامی"
                                               class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>

                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="date_start" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        تاریخ شروع نمایش
                                    </label>
                                    <div class="col-md-9">
                                        <input id="date_start" type="text" placeholder="مثال : خرید" required autocomplete="off"
                                               class="form-control @error('date_start') is-invalid @enderror" name="date_start"
                                               value="{{ old('date_start') }}">
                                        @error('date_start')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="date_end" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        تاریخ پایان نمایش
                                    </label>
                                    <div class="col-md-9">
                                        <input id="date_end" type="text" placeholder="مثال : خرید"
                                               class="form-control @error('date_end') is-invalid @enderror"
                                               name="date_end" required
                                               value="{{ old('date_end') }}" autocomplete="off">
                                        @error('date_end')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="hour_start" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        ساعت شروع
                                    </label>
                                    <div class="col-md-9">
                                        <input id="hour_start" type="number"
                                               class="form-control @error('hour_start') is-invalid @enderror"
                                               name="hour_start"
                                               value="{{ old('hour_start',0) }}" required>
                                        @error('hour_start')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="hour_end" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        ساعت پایان
                                    </label>
                                    <div class="col-md-9">
                                        <input id="hour_end" type="number"
                                               class="form-control @error('hour_end') is-invalid @enderror"
                                               name="hour_end"
                                               value="{{ old('hour_end',0) }}" required>
                                        @error('hour_end')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="price" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        قیمت
                                    </label>

                                    <div class="col-md-9">
                                        <input id="price" type="text" title="مقدار دهی الزامی"
                                               class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="price_percent" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        درصد تخفیف
                                    </label>

                                    <div class="col-md-9">
                                        <input id="price_percent" type="number" title="مقدار دهی الزامی"
                                               class="form-control @error('price_percent') is-invalid @enderror" name="price_percent" value="{{ old('price_percent',0) }}" required>
                                        @error('price_percent')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{--<div class="col-md-6 form-group">
                                    <label for="entity" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        موجودی
                                    </label>

                                    <div class="col-md-9">
                                        <input id="entity" type="number" title="مقدار دهی الزامی"
                                               class="form-control @error('entity') is-invalid @enderror" name="entity" value="{{ old('entity',0) }}" required>
                                        @error('entity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>--}}

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
                                            <a href="{{ url('Admin/ProductAwesome') }}" class="btn btn-outline-primary w-100">
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
        $("#date_start, #date_end").persianDatepicker({ showGregorianDate: true,formatDate: "YYYY/0M/0D" });
    </script>
@endsection
