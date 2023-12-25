@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('Admin/Code') }}" class="pull-left text-white">
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
                        <form method="post" enctype="multipart/form-data" action="{{ route('Code.update',$query->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="title" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان
                                    </label>

                                    <div class="col-md-9">
                                        <input id="title" type="text" placeholder="مثال : کد تخفیف عید" title="مقدار دهی الزامی"
                                               class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $query->title }}" required>

                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="code" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        کد تخفیف
                                    </label>
                                    <div class="col-md-9">
                                        <input id="code" type="text" placeholder="مثال : Rqeid" title="مقدار دهی الزامی"
                                               class="form-control @error('code') is-invalid @enderror" name="code"
                                               value="{{ $query->code }}" required>
                                        @error('code')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="count" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        تعداد تخفیف
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
                                    <label for="type_off" class="col-md-3 col-form-label">نوع تخفیف</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="type_off" name="type_off">
                                            <option {{ $query->type_off == 1 ? 'selected' : '' }} value="1">نقدی</option>
                                            <option {{ $query->type_off == 2 ? 'selected' : '' }} value="2">درصدی</option>
                                            {{--<option value="3">درصد بر مبلغ فاکتور</option>--}}
                                        </select>
                                        @error('type_off')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="price" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        قیمت (تومان)
                                    </label>
                                    <div class="col-md-9">
                                        <input id="price" type="number"
                                               class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $query->price }}" required >
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
                                        <input id="price_percent" type="number"
                                               class="form-control @error('price_percent') is-invalid @enderror" name="price_percent" value="{{ $query->price_percent }}"  >
                                        @error('price_percent')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-md-6 form-group">
                                     <label for="price_factor" class="col-md-3 col-form-label">
                                         <i class="fa fa-star text-danger"></i>
                                         حداقل مبلغ سبد
                                     </label>
                                     <div class="col-md-9">
                                         <input id="price_factor" type="number" required
                                                class="form-control @error('price_factor') is-invalid @enderror"
                                                name="price_factor" value="{{ $query->price_factor }}"  >
                                         @error('price_factor')
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
                                        <input id="date_start" type="text" placeholder="مثال : خرید" required autocomplete="off"
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
                                        <input id="date_end" type="text" placeholder="مثال : خرید" autocomplete="off"
                                               class="form-control @error('date_end') is-invalid @enderror" name="date_end"
                                               required
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
                                            <a href="{{ url('Admin/Code') }}" class="btn btn-outline-primary w-100">
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
