@extends('layouts.app')

@if(count($advertise))
    @php
        $top_adver=$advertise->where('location',2)->first();
    @endphp
    @if(isset($top_adver->id))
        @section('top_banner')
            <div class="col-12 px-0">
                <section class="banner">
                    <a title="{{ $top_adver->title }}" href="{{ $top_adver->url }}" {{ $top_adver->type_open==1 ? 'target="_blank"' : ''}}>
                        <img src="{{ asset($top_adver->pic) }}" alt="{{ $top_adver->pic_alt }}">
                    </a>
                </section>
            </div>
        @endsection
    @endif
@endif
@section('content')
    <main class="main default">
        <div class="container pt-4 pt-md-0">
            <div class="row pb-0 mb-0">
                <div class="col-12 col-lg-12 px-0">
                    @php
                        $slider=$advertise->where('location',1);
                    @endphp
                    @if(count($slider))
                        <section id="main-slider" class="carousel slide carousel-fade card mb-0" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach($slider as $slide)
                                    @if($loop->first)
                                        <li data-target="#main-slider" data-slide-to="{{ $loop->index }}" class="active"></li>
                                    @else
                                        <li data-target="#main-slider" data-slide-to="{{ $loop->index }}"></li>
                                    @endif
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach($slider as $slide)
                                    @if($loop->first)
                                        <div class="carousel-item active">
                                            <a class="d-block" title="{{ $slide->title }}" href="{{ $slide->url }}"
                                                {{ $slide->type_open==1 ? 'target="_blank"' : ''}}>
                                                <img data-src="{{ asset($slide->pic) }}"
                                                     class="d-block w-100 lazy img-slider rounded-0" alt="{{ $slide->pic_alt }}" title="{{ $slide->title }}">
                                            </a>
                                        </div>
                                    @else
                                        <div class="carousel-item">
                                            <a class="d-block" title="{{ $slide->title }}" href="{{ $slide->url }}"
                                                {{ $slide->type_open==1 ? 'target="_blank"' : ''}}>
                                                <img data-src="{{ asset($slide->pic) }}"
                                                     class="d-block w-100 lazy img-slider rounded-0" alt="{{ $slide->pic_alt }}" title="{{ $slide->title }}">
                                            </a>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                            <a class="carousel-control-prev" href="#main-slider" role="button" data-slide="prev">
                                <i class="now-ui-icons arrows-1_minimal-right"></i>
                            </a>
                            <a class="carousel-control-next" href="#main-slider" data-slide="next">
                                <i class="now-ui-icons arrows-1_minimal-left"></i>
                            </a>
                        </section>
                    @endif
                </div>
            </div>
            <div class="container d-none d-md-block pb-1">
                <div class="row">
                    <div class="col-12 d-flex d-flex align-items-center justify-content-center">
                        <div class="px-1 col-2 text-center">
                            <img class="lazy img-fluid rounded width-img-mazaya" src="{{asset('img/mazaya/return.png')}}">
							<p class="text-center font-weight-bold">
								ضمانت بازگشت کالا
							</p>
                        </div>
                        <div class="px-1 col-2 text-center">
                            <img class="lazy img-fluid rounded width-img-mazaya" src="{{asset('img/mazaya/free-send.png')}}">
							<p class="text-center font-weight-bold">
								ارسال سریع
							</p>
                        </div>
                        <div class="px-1 col-2 text-center">
                            <img class="lazy img-fluid rounded width-img-mazaya" src="{{asset('img/mazaya/pardakht.png')}}">
							<p class="text-center font-weight-bold">
								پرداخت در محل
							</p>
                        </div>
                        <div class="px-1 col-2 text-center">
                            <img class="lazy img-fluid rounded width-img-mazaya" src="{{asset('img/mazaya/price-best.png')}}">
							<p class="text-center font-weight-bold">
								تضمین قیمت
							</p>
                        </div>
                        <div class="px-1 col-2 text-center">
                            <img class="lazy img-fluid rounded width-img-mazaya" src="{{asset('img/mazaya/zemanat.png')}}">
							<p class="text-center font-weight-bold">
								ضمانت اصالت کالا
							</p>
                        </div>
                        <div class="px-1 col-2 text-center">
                            <img class="lazy img-fluid rounded width-img-mazaya" src="{{asset('img/mazaya/support.png')}}">
							<p class="text-center font-weight-bold">
								پیگیری سفارشات
							</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container d-block d-md-none pb-1">
                <div class="row justify-content-center">
                    <div class="col-4 px-1 py-1 text-center">
                        <img class="lazy img-fluid rounded width-img-mazaya" src="{{asset('img/mazaya/return.png')}}">
						<p class="text-center font-weight-bold">
								ضمانت بازگشت کالا
						</p>
                    </div>
                    <div class="col-4 px-1 py-1 text-center">
                        <img class="lazy img-fluid rounded width-img-mazaya" src="{{asset('img/mazaya/free-send.png')}}">
						<p class="text-center font-weight-bold">
								ارسال سریع
						</p>
                    </div>
                    <div class="col-4 px-1 py-1 text-center">
                        <img class="lazy img-fluid rounded width-img-mazaya" src="{{asset('img/mazaya/pardakht.png')}}">
						<p class="text-center font-weight-bold">
								پرداخت در محل
						</p>
                    </div>
                    <div class="col-4 px-1 py-1 text-center">
                        <img class="lazy img-fluid rounded width-img-mazaya" src="{{asset('img/mazaya/price-best.png')}}">
						<p class="text-center font-weight-bold">
								تضمین قیمت
						</p>
                    </div>
                    <div class="col-4 px-1 py-1 text-center">
                        <img class="lazy img-fluid rounded width-img-mazaya" src="{{asset('img/mazaya/zemanat.png')}}">
						<p class="text-center font-weight-bold">
								ضمانت اصالت کالا
						</p>
                    </div>
                    <div class="col-4 px-1 py-1 text-center">
                        <img class="lazy img-fluid rounded width-img-mazaya" src="{{asset('img/mazaya/support.png')}}">
						<p class="text-center font-weight-bold">
								پیگیری سفارشات
						</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            @if($product_awesome->count() > 0)
                <div class="row">
                    <div class="sidebar col-12 col-lg-3 order-1 order-lg-2">
                        @if(count($product_off))
                            <div class="widget-suggestion widget card">
                                <header class="card-header">
                                    <h3 class="card-title font-14">پیشنهاد لحظه ای</h3>
                                </header>
                                <div id="progressBar">
                                    <div class="slide-progress"></div>
                                </div>
                                <div id="suggestion-slider" class="owl-carousel owl-theme">
                                    @foreach($product_off as $val)
                                        <div class="item">
                                            <a title="{{ $val->title }}" href="{{ route('product.show',$val->id.'-'.Illuminate\Support\Str::slug($val->title_en)) }}">
                                                <img title="{{ \App\Helper\Helper::getImageAlt($val->picfirst) }}"
                                                     src="{{ \App\Helper\Helper::getImage($val->picfirst) }}" class="w-100"
                                                     alt="{{ \App\Helper\Helper::getImageAlt($val->picfirst) }}">
                                            </a>
                                            <h4 class="product-title">
                                                <a href="{{ route('product.show',$val->id.'-'.Illuminate\Support\Str::slug($val->title_en)) }}"
                                                   title="{{ $val->title }}">{{ $val->title }}</a>
                                            </h4>
                                            <div class="price">
                                                <del><span class="amount">{{ \App\Helper\Helper::number_latin_to_persian(number_format($val->price)) }}<span>تومان</span></span></del>
                                                <span class="amount">{{ number_format($val->price - ($val->price*($val->price_percent/100))) }}<span>تومان</span></span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-lg-9 order-1 order-lg-2">
                        @include('temp.awesome',['product_awesome' => $product_awesome])
                    </div>
                </div>
            @endif
            @php
                $product_ads1=$advertise->where('location',4);
            @endphp
            @if(count($product_ads1))
                <div class="row banner-ads pt-3 justify-content-center font-weight-bold">
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach($product_ads1 as $pa)
                                @if($pa->size==3)
                                    @if($loop->iteration % 2 == 0)
                                        <div class="col-12 col-lg-3 pr-lg-3">
                                            <div class="widget-banner card">
                                                <a href="{{ $pa->url }}" title="{{ $pa->title }}"
                                                    {{ $pa->type_open==1 ? 'target="_blank"' : ''}}>
                                                    <img title="{{ $pa->pic_alt }}" class="img-fluid"
                                                         src="{{ asset($pa->pic) }}" alt="{{ $pa->pic_alt }}">
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12 col-lg-3 pl-lg-3">
                                            <div class="widget-banner card">
                                                <a href="{{ $pa->url }}" title="{{ $pa->title }}"
                                                    {{ $pa->type_open==1 ? 'target="_blank"' : ''}}>
                                                    <img title="{{ $pa->pic_alt }}" class="img-fluid"
                                                         src="{{ asset($pa->pic) }}" alt="{{ $pa->pic_alt }}">
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @elseif($pa->size==2)
                                    <div class="col-12 col-lg-6">
                                        <div class="widget-banner card">
                                            <a href="{{ $pa->url }}" title="{{ $pa->title }}"
                                                {{ $pa->type_open==1 ? 'target="_blank"' : ''}}>
                                                <img title="{{ $pa->pic_alt }}" class="img-fluid"
                                                     src="{{ asset($pa->pic) }}" alt="{{ $pa->pic_alt }}">
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-12 col-lg-12">
                                        <div class="widget-banner card">
                                            <a href="{{ $pa->url }}" title="{{ $pa->title }}"
                                                {{ $pa->type_open==1 ? 'target="_blank"' : ''}}>
                                                <img title="{{ $pa->pic_alt }}" class="img-fluid"
                                                     src="{{ asset($pa->pic) }}" alt="{{ $pa->pic_alt }}">
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="row pt-1 back-khardal">
                <div class="col-lg-3 text-center">
                    <h3 class="pt-2 font-weight-bold font-18">
                        محصولات پر فروش
                    </h3>
                    <img class="lazy d-none d-md-block" data-src="{{ asset('img/porfrosh.jpg') }}">
                    <a href="{{ url('tag/Best-selling-products') }}"
                       class="btn btn-info w-50 btn-organization d-none d-md-block">
                        مشاهده همه
                    </a>
                </div>
                <div class="col-lg-9 col-12 back-khardal">
                    <div class="widget widget-product card shadow-none pb-0 mb-0 back-khardal">
                        <header class="card-header border-0">
                            {{-- <h3 class="card-title border-0">
                                 <span class="font-12">محصولات پر فروش</span>
                             </h3>
                             <a href="{{ url('tag/Best-selling-products') }}" class="view-all">
                                 مشاهده همه
                             </a>--}}
                        </header>
                        <div class="porfrosh product-carousel product-carousel2 owl-carousel owl-theme">
                            @foreach($best_seller as $ball)
                                @if($ball->product_exist != '')
                                    @if($ball->product_exist->price_type==1)
                                        <div class="item bg-white">
                                            <a title="{{ $ball->product_exist->title }}"
                                               href="{{ route('product.show',$ball->product_exist->id.'-'.Illuminate\Support\Str::slug($ball->product_exist->title_en)) }}">
                                                <div class="d-flex align-items-center justify-content-center img-size-swiper bg-gradient">
                                                    <img src="{{ \App\Helper\Helper::getImage($ball->product_exist->picfirst) }}"
                                                         class="img-fluid" alt="{{ \App\Helper\Helper::getImageAlt($ball->product_exist->picfirst) }}"
                                                         title="{{ \App\Helper\Helper::getImageAlt($ball->product_exist->picfirst) }}">
                                                </div>
                                            </a>
                                            <h2 class="post-title">
                                                <a title="{{ $ball->product_exist->title }}"
                                                   href="{{ route('product.show',$ball->product_exist->id.'-'.Illuminate\Support\Str::slug($ball->product_exist->title_en)) }}">
                                                    {{ $ball->product_exist->title }}
                                                </a>
                                            </h2>
                                            <div class="price">
                                                    <span>
                                                        {{ \App\Helper\Helper::number_latin_to_persian(number_format($ball->product_exist->price)) }}
                                                        <span>
                                                            تومان
                                                        </span>
                                                    </span>
                                            </div>
                                        </div>
                                    @elseif($ball->product_exist->price_type==2)
                                        <div class="item bg-white">
                                            <a title="{{ $ball->product_exist->title }}"
                                               href="{{ route('product.show',$ball->product_exist->id.'-'.Illuminate\Support\Str::slug($ball->product_exist->title_en)) }}">
                                                <div class="d-flex align-items-center justify-content-center img-size-swiper bg-gradient">
                                                    <img src="{{ \App\Helper\Helper::getImage($ball->product_exist->picfirst) }}"
                                                         class="img-fluid" alt="{{ \App\Helper\Helper::getImageAlt($ball->product_exist->picfirst) }}"
                                                         title="{{ \App\Helper\Helper::getImageAlt($ball->product_exist->picfirst) }}">
                                                </div>
                                            </a>
                                            <h2 class="post-title">
                                                <a title="{{ $ball->product_exist->title }}"
                                                   href="{{ route('product.show',$ball->product_exist->id.'-'.Illuminate\Support\Str::slug($ball->product_exist->title_en)) }}">
                                                    {{ $ball->product_exist->title }}
                                                </a>
                                            </h2>
                                            <div class="price">
                                                <del>
                                                        <span>
                                                            {{ \App\Helper\Helper::number_latin_to_persian(number_format($ball->product_exist->price)) }}
                                                            <span>
                                                                تومان
                                                            </span>
                                                        </span>
                                                </del>
                                                <ins>
                                                        <span>
                                                            {{ number_format($ball->product_exist->price - ($ball->product_exist->price*($ball->product_exist->price_percent/100))) }}
                                                            <span>
                                                                تومان
                                                            </span>
                                                        </span>
                                                </ins>
                                            </div>
                                        </div>
                                    @elseif($ball->product_exist->price_type==3)
                                        <div class="item bg-white">
                                            <a title="{{ $ball->product_exist->title }}"
                                               href="{{ route('product.show',$ball->product_exist->id.'-'.Illuminate\Support\Str::slug($ball->product_exist->title_en)) }}">
                                                <div class="d-flex align-items-center justify-content-center img-size-swiper bg-gradient">
                                                    <img src="{{ \App\Helper\Helper::getImage($ball->product_exist->picfirst) }}"
                                                         class="img-fluid" alt="{{ \App\Helper\Helper::getImageAlt($ball->product_exist->picfirst) }}"
                                                         title="{{ \App\Helper\Helper::getImageAlt($ball->product_exist->picfirst) }}">
                                                </div>
                                            </a>
                                            <h2 class="post-title">
                                                <a title="{{ $ball->product_exist->title }}"
                                                   href="{{ route('product.show',$ball->product_exist->id.'-'.Illuminate\Support\Str::slug($ball->product_exist->title_en)) }}">
                                                    {{ $ball->product_exist->title }}
                                                </a>
                                            </h2>
                                            <div class="price-value-wrapper">
                                                <a class="btn btn-sm btn-danger" href="tel:02166710867" title="تماس با استاویتا">
                                                        <span class="price-currency px-2 py-2">
                                                            <i class="fa fa-phone"></i>
                                                            تماس تلفنی

                                                        </span>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <section class="video-area">
                <div class="overlay overlay-bg"></div>
                <div class="container">
                    <div class="video-content">
                        <a title="" href="{{ asset('img/ghalikhane.mp4') }}" class="play-btn">
                            <img src="{{ asset('img/play-btn.png') }}" alt="" title="">
                        </a>
                        <h3 class="h2 text-white">درباره قالی خانه</h3>
                    </div>
                </div>
            </section>
            @php
                $shane=$advertise->where('location',5);
            @endphp
            @if(count($shane))
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="widget widget-product card  border-top border-3 py-1">
                            <header class="card-header">
                                <h3 class="card-title">
                                    <span class="font-12">براساس شانه فرش</span>
                                </h3>
                                {{-- <a href="{{ url('tag/popular-products') }}" class="view-all">مشاهده همه</a>--}}
                            </header>
                            <div class="product-carousel shane owl-carousel owl-theme">
                                @foreach($shane as $shan)
                                    <div class="item">
                                        <a title="{{ $shan->title }}" href="{{ $shan->url }}"
                                            {{ $shan->type_open==1 ? 'target="_blank"' : ''}} >
                                            <div class="d-flex align-items-center justify-content-center img-size-swiper bg-gradient">
                                                <img data-src="{{ asset($shan->pic) }}"
                                                     class="img-fluid lazy" alt="{{ $shan->pic_alt }}" title="{{ $shan->title }}">
                                            </div>
                                        </a>
                                        <h2 class="post-title">
                                            <a title="{{ $shan->title }}" href="{{ $shan->url }}"
                                                {{ $shan->type_open==1 ? 'target="_blank"' : ''}} >
                                                {{ $shan->title }}
                                            </a>
                                        </h2>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card rounded-site bg-grey moshavere mb-2">
                        <div class="pr-lg-5">
                            <p class="pt-5 font-18 font-weight-bold text-white mb-4">
                                مشاوره خرید فرش
                            </p>
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
                            <form class="form-account d-none d-lg-block" method="post"
                                  action="{{ route('ContactUser.store') }}">
                                @csrf
                                <div class="row justify-content-start">
                                    <div class="col-lg-7 col-12 px-0 text-left">
                                        <div class="row">
                                            <div class="col-lg-3 col-12">
                                                <input type="text" class="form-control moshavere-input"
                                                       name="name" required maxlength="50" minlength="2"
                                                       placeholder="نام">
                                            </div>
                                            <div class="col-lg-3 col-12">
                                                <input type="text" class="form-control moshavere-input"
                                                       name="mobile" minlength="11" maxlength="11"
                                                       placeholder="شماره تماس">
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <input type="text" class="form-control moshavere-input"
                                                       name="comment"
                                                       placeholder="توضیحات">
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-organization" value="ارسال">
                                    </div>
                                </div>
                            </form>
                            <form class="form-account d-block d-lg-none" method="post"
                                  action="{{ route('Contact.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control moshavere-input"
                                               name="name" required maxlength="50" minlength="2"
                                               placeholder="نام">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control moshavere-input"
                                               name="mobile" minlength="11" maxlength="11"
                                               placeholder="شماره تماس">
                                    </div>
                                    <div class="col-12 mt-3">
                                        <input type="text" class="form-control moshavere-input"
                                               name="comment"
                                               placeholder="توضیحات">
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-organization" value="ارسال">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="widget widget-product card  border-top border-3 pb-0 mb-1">
                        <header class="card-header">
                            <h3 class="card-title">
                                <span class="font-12">پیشنهادات قالی خانه</span>
                            </h3>
                            <a href="{{ url('tag/Offers') }}" class="view-all">مشاهده همه</a>
                        </header>
                        <div class="offer product-carousel owl-carousel owl-theme">
                            @foreach($offer as $ball)
                                @if($ball->product_exist != '')
                                    @if($ball->product_exist->price_type==1)
                                        <div class="item">
                                            <a title="{{ $ball->product_exist->title }}"
                                               href="{{ route('product.show',$ball->product_exist->id.'-'.Illuminate\Support\Str::slug($ball->product_exist->title_en)) }}">
                                                <div class="d-flex align-items-center justify-content-center img-size-swiper bg-gradient">
                                                    <img src="{{ \App\Helper\Helper::getImage($ball->product_exist->picfirst) }}"
                                                         class="img-fluid" alt="{{ \App\Helper\Helper::getImageAlt($ball->product_exist->picfirst) }}"
                                                         title="{{ \App\Helper\Helper::getImageAlt($ball->product_exist->picfirst) }}">
                                                </div>
                                            </a>
                                            <h2 class="post-title mb-0">
                                                <a title="{{ $ball->product_exist->title }}"
                                                   href="{{ route('product.show',$ball->product_exist->id.'-'.Illuminate\Support\Str::slug($ball->product_exist->title_en)) }}">
                                                    {{ $ball->product_exist->title }}
                                                </a>
                                            </h2>
                                            <div class="price">
                                                    <span>
                                                        {{ \App\Helper\Helper::number_latin_to_persian(number_format($ball->product_exist->price)) }}
                                                        <span>
                                                            تومان
                                                        </span>
                                                    </span>
                                            </div>
                                        </div>
                                    @elseif($ball->product_exist->price_type==2)
                                        <div class="item">
                                            <a title="{{ $ball->product_exist->title }}"
                                               href="{{ route('product.show',$ball->product_exist->id.'-'.Illuminate\Support\Str::slug($ball->product_exist->title_en)) }}">
                                                <div class="d-flex align-items-center justify-content-center img-size-swiper bg-gradient">
                                                    <img src="{{ \App\Helper\Helper::getImage($ball->product_exist->picfirst) }}"
                                                         class="img-fluid" alt="{{ \App\Helper\Helper::getImageAlt($ball->product_exist->picfirst) }}"
                                                         title="{{ \App\Helper\Helper::getImageAlt($ball->product_exist->picfirst) }}">
                                                </div>
                                            </a>
                                            <h2 class="post-title">
                                                <a title="{{ $ball->product_exist->title }}"
                                                   href="{{ route('product.show',$ball->product_exist->id.'-'.Illuminate\Support\Str::slug($ball->product_exist->title_en)) }}">
                                                    {{ $ball->product_exist->title }}
                                                </a>
                                            </h2>
                                            <div class="price">
                                                <del>
                                                        <span>
                                                            {{ \App\Helper\Helper::number_latin_to_persian(number_format($ball->product_exist->price)) }}
                                                            <span>
                                                                تومان
                                                            </span>
                                                        </span>
                                                </del>
                                                <ins>
                                                        <span>
                                                            {{ number_format($ball->product_exist->price - ($ball->product_exist->price*($ball->product_exist->price_percent/100))) }}
                                                            <span>
                                                                تومان
                                                            </span>
                                                        </span>
                                                </ins>
                                            </div>
                                        </div>
                                    @elseif($ball->product_exist->price_type==3)
                                        <div class="item">
                                            <a title="{{ $ball->product_exist->title }}"
                                               href="{{ route('product.show',$ball->product_exist->id.'-'.Illuminate\Support\Str::slug($ball->product_exist->title_en)) }}">
                                                <div class="d-flex align-items-center justify-content-center img-size-swiper bg-gradient">
                                                    <img src="{{ \App\Helper\Helper::getImage($ball->product_exist->picfirst) }}"
                                                         class="img-fluid" alt="{{ \App\Helper\Helper::getImageAlt($ball->product_exist->picfirst) }}"
                                                         title="{{ \App\Helper\Helper::getImageAlt($ball->product_exist->picfirst) }}">
                                                </div>
                                            </a>
                                            <h2 class="post-title">
                                                <a title="{{ $ball->product_exist->title }}"
                                                   href="{{ route('product.show',$ball->product_exist->id.'-'.Illuminate\Support\Str::slug($ball->product_exist->title_en)) }}">
                                                    {{ $ball->product_exist->title }}
                                                </a>
                                            </h2>
                                            <div class="price-value-wrapper">
                                                <a class="btn btn-sm btn-danger" href="tel:02144542991" title="تماس با قالی خانه">
                                                        <span class="price-currency px-2 py-2">
                                                            <i class="fa fa-phone"></i>
                                                            تماس تلفنی

                                                        </span>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @php
                $banner=$advertise->where('location',6);
            @endphp
            @if(count($banner))
                <div class="row banner-ads">
                    <div class="col-12">
                        <div class="row">
                            @foreach($banner as $pa)
                                @if($pa->size==3)
                                    @if($loop->iteration % 2 == 0)
                                        <div class="col-6 col-lg-3 pr-lg-3 pr-1">
                                            <div class="widget-banner card">
                                                <a href="{{ $pa->url }}" title="{{ $pa->title }}"
                                                    {{ $pa->type_open==1 ? 'target="_blank"' : ''}}>
                                                    <img title="{{ $pa->pic_alt }}" class="img-fluid"
                                                         src="{{ asset($pa->pic) }}" alt="{{ $pa->pic_alt }}">
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-6 col-lg-3 pl-lg-3 pl-1">
                                            <div class="widget-banner card">
                                                <a href="{{ $pa->url }}" title="{{ $pa->title }}"
                                                    {{ $pa->type_open==1 ? 'target="_blank"' : ''}}>
                                                    <img title="{{ $pa->pic_alt }}" class="img-fluid"
                                                         src="{{ asset($pa->pic) }}" alt="{{ $pa->pic_alt }}">
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @elseif($pa->size==2)
                                    @if($loop->iteration % 2 == 0)
                                        <div class="col-12 col-lg-6 pr-lg-1 pr-3">
                                            <div class="widget-banner card">
                                                <a href="{{ $pa->url }}" title="{{ $pa->title }}"
                                                    {{ $pa->type_open==1 ? 'target="_blank"' : ''}}>
                                                    <img title="{{ $pa->pic_alt }}" class="img-fluid"
                                                         src="{{ asset($pa->pic) }}" alt="{{ $pa->pic_alt }}">
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12 col-lg-6 pl-lg-1 pl-3">
                                            <div class="widget-banner card">
                                                <a href="{{ $pa->url }}" title="{{ $pa->title }}"
                                                    {{ $pa->type_open==1 ? 'target="_blank"' : ''}}>
                                                    <img title="{{ $pa->pic_alt }}" class="img-fluid"
                                                         src="{{ asset($pa->pic) }}" alt="{{ $pa->pic_alt }}">
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="col-12 col-lg-12">
                                        <div class="widget-banner card">
                                            <a href="{{ $pa->url }}" title="{{ $pa->title }}"
                                                {{ $pa->type_open==1 ? 'target="_blank"' : ''}}>
                                                <img title="{{ $pa->pic_alt }}" class="img-fluid"
                                                     src="{{ asset($pa->pic) }}" alt="{{ $pa->pic_alt }}">
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            {{--<div class="row">
                <div class="col-12">
                    <div class="brand-slider card">
                        <header class="card-header">
                            <h3 class="card-title"><span>برندهای ویژه</span></h3>
                        </header>
                        <div class="owl-carousel">
                            @foreach(\App\Brand::active()->get() as $value)
                                <div class="item">
                                    <a target="_" href="{{ route('brand.show',Illuminate\Support\Str::slug($value->title_en,'-')) }}" title="{{ $value->title }}">
                                        <img class="owl-lazy" data-src="{{ asset($value->pic) }}" alt="{{ $value->pic_alt }}" title="{{ $value->pic_alt }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>--}}
            <div class="row">
                <div class="col-12">
                    <div class="widget widget-product card  border-top border-3 pb-0 mb-1">
                        <header class="card-header">
                            <h3 class="card-title">
                                <span class="font-12">برندها</span>
                            </h3>
                        </header>
                        <div class="brand-owl owl-carousel owl-theme">
                            @foreach(\App\Brand::active()->get() as $value)
                                <div class="item">
                                    <a target="_blank" href="{{ route('brand.show',Illuminate\Support\Str::slug($value->title_en,'-')) }}" title="{{ $value->title }}">
                                        <img class="lazy" data-src="{{ asset($value->pic) }}" alt="{{ $value->pic_alt }}" title="{{ $value->pic_alt }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-light nav-botton d-block d-lg-none">
            <div class="d-flex justify-content-around align-items-center h-100">
                <a href="{{ url('cart') }}"><button type="button" class="btn bg-red  now-ui-icons shopping_basket"></button></a>
                <a href="#"><button type="button" class="btn bg-red fa fa-search search" data-toggle="modal" data-target="#exampleModalLong" required></button></a>
                <a href="{{ url('profile') }}"><button type="button" class="btn bg-red now-ui-icons users_single-02"></button></a>
                <a href=""><button type="button" class="btn bg-red fa fa-whatsapp"></button></a>
            </div>
        </div>
    </main>

@endsection

