@extends('layouts.app')

@section('content')
    <main class="profile-user-page default">
        <div class="container">
            <div class="row">
                <div class="profile-page col-xl-9 col-lg-8 col-md-12 order-2">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-12">
                                <h1 class="title-tab-content">اطلاعات شخصی</h1>
                            </div>
                            <div class="content-section default">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <p>
                                            <span class="title">نام و نام خانوادگی :</span>
                                            <span>
                                                {{ Auth::user()->full_name }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <p>
                                            <span class="title">پست الکترونیک :</span>
                                            <span>{{ Auth::user()->email }}</span>
                                        </p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <p>
                                            <span class="title">شماره تلفن همراه:</span>
                                            <span>{{ Auth::user()->mobile }}</span>
                                        </p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <p>
                                            <span class="title">کد ملی :</span>
                                            <span>
                                                {{ Auth::user()->detail != '' ? Auth::user()->detail->national_code : '-' }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <p>
                                            <span class="title">دریافت خبرنامه :</span>
                                            <span>
                                                @if(Auth::user()->detail != '')
                                                    @if(Auth::user()->detail->news_receive == 1)
                                                        بله
                                                    @else
                                                        خیر
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <p>
                                            <span class="title">شماره کارت :</span>
                                            <span>
                                                 @if(Auth::user()->detail != '')
                                                    @if(Auth::user()->detail->bill_cart != '')
                                                        {{Auth::user()->detail->bill_cart}}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-12 text-center">
                                        <a href="{{ route('profile.edit',Auth::user()->id) }}" class="btn-link-border form-account-link">
                                            ویرایش اطلاعات شخصی
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-12">
                                <h1 class="title-tab-content">لیست آخرین علاقمندی ها</h1>
                            </div>
                            <div class="content-section default">
                                <div class="row">
                                    <div class="col-12">
                                        @foreach($query_favorite as $item)
                                            <div class="profile-recent-fav-row">
                                                <a href="#" class="profile-recent-fav-col profile-recent-fav-col-thumb">
                                                    <img src="{{ asset($item->product->picfirst->link) }}"></a>
                                                <div class="profile-recent-fav-col profile-recent-fav-col-title">
                                                    <a href="#">
                                                        <h4 class="profile-recent-fav-name">
                                                            {{ $item->product->title }}
                                                        </h4>
                                                    </a>
                                                    <div class="profile-recent-fav-price">
                                                        @if($item->product->status == 1)
                                                            موجود
                                                        @else
                                                            ناموجود
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="profile-recent-fav-col profile-recent-fav-col-actions">
                                                    <button class="btn-action btn-action-remove"
                                                            onclick="event.preventDefault();
                                                 document.getElementById('delete-favorite').submit();">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <form id="delete-favorite" action="{{ route('favorite.destroy', $item->id) }}" method="POST"  class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-12 text-center">
                                        <a href="{{ route('favorite.index') }}" class="btn-link-border form-account-link">
                                            مشاهده و ویرایش لیست مورد علاقه
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="row">
                        <div class="col-12">
                            <h1 class="title-tab-content">آخرین سفارش ها</h1>
                        </div>
                        <div class="col-12 text-center">
                            <div class="content-section pt-5 pb-5">
                                <div class="icon-empty">
                                    <i class="now-ui-icons travel_info"></i>
                                </div>
                                <h1 class="text-empty">موردی برای نمایش وجود ندارد!</h1>
                            </div>
                        </div>
                    </div>--}}
                </div>
                @include('user.temp.sidebar')
            </div>
        </div>
    </main>
@endsection
