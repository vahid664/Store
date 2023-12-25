@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('Admin/Peyk') }}" class="pull-left text-white">
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
                        <form method="post" enctype="multipart/form-data" action="{{ route('Peyk.update',$query->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="date" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        تاریخ
                                    </label>
                                    <div class="col-md-9">
                                        <input id="date" type="text" placeholder="مثال : خرید" required autocomplete="off"
                                               class="form-control @error('date') is-invalid @enderror" name="date"
                                               value="{{ $query->date }}">
                                        @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="time_start" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        ساعت شروع
                                    </label>
                                    <div class="col-md-9">
                                        <input id="time_start" type="number"
                                               class="form-control @error('time_start') is-invalid @enderror"
                                               name="time_start"
                                               value="{{ $query->time_start }}" required>
                                        @error('time_start')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="time_end" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        ساعت پایان
                                    </label>
                                    <div class="col-md-9">
                                        <input id="time_end" type="number"
                                               class="form-control @error('time_end') is-invalid @enderror"
                                               name="time_end"
                                               value="{{ $query->time_end }}" required>
                                        @error('time_end')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="count" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        تعداد ارسال
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
                                    <label for="price" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        قیمت (تومان)
                                    </label>
                                    <div class="col-md-9">
                                        <input id="price" type="number"
                                               class="form-control @error('price') is-invalid @enderror" name="price"
                                               value="{{ $query->price }}" required >
                                        @error('price')
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
                                            <a href="{{ url('Admin/Peyk') }}" class="btn btn-outline-primary w-100">
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
        $("#date").persianDatepicker({
            formatDate: "YYYY/0M/0D",
            showGregorianDate: true
        });
    </script>
@endsection
