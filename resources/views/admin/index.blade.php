@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-success float-right">روز  {{ $v->dayOfWeek }}</span>
                    <h5>تعداد ورودی</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$visit}}</h1>
                    <div class="stat-percent font-bold text-success"><i class="fa fa-bolt"></i></div>
                    <small>&nbsp;</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-info float-right">کل</span>
                    <h5>سفارشات</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ \App\Factor::active()->count() }}</h1>
                    <div class="stat-percent font-bold text-info">
                        {{ \App\Factor::active()->whereDate('created_at',$now)->count() }}
                        <i class="fa fa-level-up"></i></div>
                    <small>جدید</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-primary float-right">کل</span>
                    <h5>خبرنامه</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ \App\NewsEmail::count() }}</h1>
                    <div class="stat-percent font-bold text-navy">
                        {{ \App\NewsEmail::whereDate('created_at',$now)->count() }}
                        <i class="fa fa-level-up"></i></div>
                    <small>جدید امروز</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-danger float-right">کل</span>
                    <h5>کاربران</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">
                        {{ \App\User::where('level',0)->count() }}
                    </h1>
                    <div class="stat-percent font-bold text-danger">
                        {{ \App\User::where('level',0)->whereDate('created_at',$now)->count() }}
                        <i class="fa fa-level-down"></i></div>
                    <small>جدید امروز</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">داشبورد</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @can('user-index')
                    <a href="{{ url('Admin/User') }}" class="col-xl-4 col-lg-6 col-12">
                        <div class="widget navy-bg p-lg text-center">
                            <div class="row border-bottom border-success pb-2">
                                <div class="col-4">
                                    <i class="fa fa-user-circle fa-5x"></i>
                                </div>
                                <div class="col-8">
                                    <div class="pt-2">
                                        <h3 class="font-bold text-white font-22">لیست کاربران</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 font-14">
                                    <div class="d-flex justify-content-between my-1 text-white">
                                        <div class="align-items-center">
                                            کل :
                                        </div>
                                        <div class="align-items-center">
                                            <span class="font-14">{{ \App\User::withTrashed()->count() }}</span>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between my-1">
                                        <div class="align-items-center">
                                            فعال :
                                        </div>
                                        <div class="align-items-center">
                                            <span class="font-14">{{ \App\User::count() }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between my-1">
                                        <div class="align-items-center">
                                            غیرفعال :
                                        </div>
                                        <div class="align-items-center">
                                            <span class="font-14">{{ \App\User::onlyTrashed()->count() }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                    @endcan
                    @can('product-index')
                        <a href="{{ url('Admin/Product') }}" class="col-xl-4 col-lg-6 col-12">
                            <div class="widget red-bg p-lg text-center">
                                <div class="row border-bottom border-success pb-2">
                                    <div class="col-4">
                                        <i class="fa fa-product-hunt fa-5x"></i>
                                    </div>
                                    <div class="col-8">
                                        <div class="pt-2">
                                            <h3 class="font-bold text-white font-22">لیست محصولات</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12 font-14">
                                        <div class="d-flex justify-content-between my-1 text-white">
                                            <div class="align-items-center">
                                                کل :
                                            </div>
                                            <div class="align-items-center">
                                                <span class="font-14">{{ \App\Product::withTrashed()->count() }}</span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between my-1">
                                            <div class="align-items-center">
                                                فعال :
                                            </div>
                                            <div class="align-items-center">
                                                <span class="font-14">{{ \App\Product::count() }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between my-1">
                                            <div class="align-items-center">
                                                غیرفعال :
                                            </div>
                                            <div class="align-items-center">
                                                <span class="font-14">{{ \App\Product::onlyTrashed()->count() }}</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </a>
                    @endcan
                    @can('advertise-index')
                        <a href="{{ url('Admin/Advertise') }}" class="col-xl-4 col-lg-6 col-12">
                            <div class="widget blue-bg p-lg text-center">
                                <div class="row border-bottom border-success pb-2">
                                    <div class="col-4">
                                        <i class="fa fa-braille fa-5x"></i>
                                    </div>
                                    <div class="col-8">
                                        <div class="pt-2">
                                            <h3 class="font-bold text-white font-22">لیست بنرها</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12 font-14">
                                        <div class="d-flex justify-content-between my-1 text-white">
                                            <div class="align-items-center">
                                                کل :
                                            </div>
                                            <div class="align-items-center">
                                                <span class="font-14">{{ \App\Advertise::withTrashed()->count() }}</span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between my-1">
                                            <div class="align-items-center">
                                                فعال :
                                            </div>
                                            <div class="align-items-center">
                                                <span class="font-14">{{ \App\Advertise::count() }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between my-1">
                                            <div class="align-items-center">
                                                غیرفعال :
                                            </div>
                                            <div class="align-items-center">
                                                <span class="font-14">{{ \App\Advertise::onlyTrashed()->count() }}</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
