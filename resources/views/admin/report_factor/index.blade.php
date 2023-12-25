@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">گزارش گیری
                        <a href="{{ url('/Admin') }}" class="pull-left text-white"> برگشت
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
                        <form method="post" enctype="multipart/form-data" action="{{ route('ReportFactor.index') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="start_date" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        حضور
                                    </label>
                                    <div class="col-md-9">
                                        <select name="start_date" id="start_date" data-live-search="true"
                                                data-hide-disabled="true"  data-actions-box="true"
                                                class="selectpicker form-control @error('start_date') is-invalid @enderror">
                                            <option value="">انتخاب کنید</option>
                                            @for($i=1;$i<=12;$i++)
                                                @if(old('start_date') != '' && in_array($date->year-1 .'/'.$i,old('start_date')))
                                                    <option selected value="{{ $date->year-1 }}/{{$i < 10 ? '0'.$i : $i}}">{{ $date->year-1 }}/{{$i < 10 ? '0'.$i : $i}}</option>
                                                @else
                                                    <option value="{{ $date->year-1 }}/{{$i < 10 ? '0'.$i : $i}}">{{ $date->year-1 }}/{{$i < 10 ? '0'.$i : $i}}</option>
                                                @endif
                                            @endfor
                                            @for($i=1;$i<=12;$i++)
                                                @if(old('start_date') != '' && in_array($date->year.'/'.$i,old('start_date')))
                                                    <option selected value="{{ $date->year }}/{{$i < 10 ? '0'.$i : $i}}">{{ $date->year }}/{{$i < 10 ? '0'.$i : $i}}</option>
                                                @else
                                                    <option value="{{ $date->year }}/{{$i < 10 ? '0'.$i : $i}}">{{ $date->year }}/{{$i < 10 ? '0'.$i : $i}}</option>
                                                @endif
                                            @endfor
                                        </select>
                                        @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="end_date" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عدم حضور
                                    </label>
                                    <div class="col-md-9">
                                        <select name="end_date" id="end_date" data-live-search="true"
                                                data-hide-disabled="true" data-actions-box="true"
                                                class="selectpicker form-control @error('end_date') is-invalid @enderror">
                                            <option value="">انتخاب کنید</option>
                                            @for($i=1;$i<=12;$i++)
                                                @if(old('end_date') != '' && in_array($date->year-1 .'/'.$i,old('end_date')))
                                                    <option selected value="{{ $date->year-1 }}/{{$i < 10 ? '0'.$i : $i}}">{{ $date->year-1 }}/{{$i < 10 ? '0'.$i : $i}}</option>
                                                @else
                                                    <option value="{{ $date->year-1 }}/{{$i < 10 ? '0'.$i : $i}}">{{ $date->year-1 }}/{{$i < 10 ? '0'.$i : $i}}</option>
                                                @endif
                                            @endfor
                                            @for($i=1;$i<=12;$i++)
                                                @if(old('end_date') != '' && in_array($date->year.'/'.$i,old('end_date')))
                                                    <option selected value="{{ $date->year }}/{{$i < 10 ? '0'.$i : $i}}">{{ $date->year }}/{{$i < 10 ? '0'.$i : $i}}</option>
                                                @else
                                                    <option value="{{ $date->year }}/{{$i < 10 ? '0'.$i : $i}}">{{ $date->year }}/{{$i < 10 ? '0'.$i : $i}}</option>
                                                @endif
                                            @endfor
                                        </select>
                                        @error('end_date')
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
                                                گزارش
                                            </button>
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
