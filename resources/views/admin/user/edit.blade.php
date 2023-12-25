@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('Admin/User') }}" class="pull-left text-white">
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
                        <form method="post" enctype="multipart/form-data" action="{{ route('User.update',$query->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="name" class="col-md-3 col-form-label">
                                        نام
                                    </label>
                                    <div class="col-md-9">
                                        <input id="name" type="text" placeholder="مثال : بهزاد"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="name" value="{{ $query->name }}"
                                               autocomplete="name" autofocus >
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="family" class="col-md-3 col-form-label">
                                        نام خانوادگی
                                    </label>
                                    <div class="col-md-9">
                                        <input id="family" type="text" placeholder="مثال : میرزازاده"
                                               class="form-control @error('family') is-invalid @enderror"
                                               name="family" value="{{ $query->family }}" autocomplete="family">
                                        @error('family')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-6 form-group">
                                    <label for="email" class="col-md-3 col-form-label">
                                        ایمیل
                                    </label>
                                    <div class="col-md-9">
                                        <input id="email" type="email" placeholder="مثال : behzadamin@ymail.com"
                                               class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $query->email }}" autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="form-group col-md-6">
                                    <label for="password" class="col-md-3">
                                        پسورد
                                    </label>
                                    <div class="col-md-9">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                               autocomplete="password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="password-confirm" class="col-md-3">
                                        تکرار پسورد
                                    </label>
                                    <div class="col-md-9">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="password">
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="roles" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        سطح کاربری
                                    </label>
                                    <div class="col-md-9">
                                        <select name="roles[]" id="roles" data-live-search="true" data-hide-disabled="true" multiple data-actions-box="true"
                                                class="selectpicker form-control @error('roles') is-invalid @enderror">
                                            @foreach($roles as $value)
                                                @if(in_array($value->id,$role_has))
                                                    <option selected value="{{ $value->id }}">{{ $value->name }}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('roles')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="level" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        سطح دیتابیس
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control @error('level') is-invalid @enderror"
                                                name="level" id="level">
                                            <option {{ $query->level == 0 ? 'selected' : '' }} value="0">مشتری</option>
                                            <option {{ $query->level == 121 ? 'selected' : '' }} value="121">مدیر</option>
                                        </select>
                                        @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="mobile" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        موبایل
                                    </label>
                                    <div class="col-md-9">
                                        <input id="mobile" type="text" placeholder="مثال : 02155397207" minlength="11" maxlength="11"
                                               class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $query->mobile }}" required autocomplete="mobile">
                                        @error('mobile')
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
                                            <a href="{{ url('Admin/User') }}" class="btn btn-outline-primary w-100">
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
