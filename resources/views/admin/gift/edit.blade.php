@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('Admin/Gift') }}" class="pull-left text-white">
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
                        <form method="post" enctype="multipart/form-data" action="{{ route('Gift.update',$query->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="title" class="col-md-3 col-form-label">
                                        عنوان
                                    </label>
                                    <div class="col-md-9">
                                        <input id="title" type="text" placeholder="مثال : هدیه نرم کننده"
                                               class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $query->title }}" >
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="product_id" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        محصول</label>
                                    <div class="col-md-9">
                                        <select name="product_id" id="product_id" data-live-search="true" data-hide-disabled="true" data-actions-box="true"
                                                class="selectpicker form-control @error('product_id') is-invalid @enderror" required>
                                            <option value="">انتخاب</option>
                                            @foreach(\App\Product::active()->orderByDesc('id')->get() as $value)
                                                @if($value->id==$query->product_id)
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
                                    <label for="count" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        تعداد هدیه
                                    </label>
                                    <div class="col-md-9">
                                        <input id="count" type="number"
                                               class="form-control @error('count') is-invalid @enderror" name="count"
                                               value="{{ $query->count }}" required>
                                        @error('count')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="floor_price_basket" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        حداقل سبد خرید
                                        (تومان)
                                    </label>
                                    <div class="col-md-9">
                                        <input id="floor_price_basket" type="number"
                                               class="form-control @error('floor_price_basket') is-invalid @enderror"
                                               name="floor_price_basket" value="{{ $query->floor_price_basket }}" required >
                                        @error('floor_price_basket')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="date_start" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        تاریخ شروع
                                    </label>
                                    <div class="col-md-9">
                                        <input id="date_start" type="text" required autocomplete="off"
                                               class="form-control @error('date_start') is-invalid @enderror" name="date_start"
                                               value="{{ $query->date_start }}">
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
                                        تاریخ پایان
                                    </label>
                                    <div class="col-md-9">
                                        <input id="date_end" type="text" autocomplete="off"
                                               required
                                               class="form-control @error('date_end') is-invalid @enderror" name="date_end"
                                               value="{{ $query->date_end }}">
                                        @error('date_end')
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
                                    <label for="text" class="col-md-3 col-form-label">
                                        توضیحات
                                    </label>
                                    <div class="col-md-9">
                                        <input id="text" type="text" placeholder="مثال : هدیه عمومی به مناسبت عید"
                                               class="form-control @error('text') is-invalid @enderror"
                                               name="text" value="{{ $query->text }}" >
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
                                            <a href="{{ url('Admin/Gift') }}" class="btn btn-outline-primary w-100">
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
        $("#date_start, #date_end").persianDatepicker({
            formatDate: "YYYY/0M/0D",
            showGregorianDate: true
        });
    </script>
@endsection
