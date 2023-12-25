@extends('layouts.app')
@section('img-seo')
    <meta property="og:url" content="{{ urldecode(url()->current()) }}"/>
    <meta name="robots" content="noindex,nofollow">
@endsection
@section('meta-next-prev')
    @if($product->nextPageUrl() != null)
        <link rel="next" href="{{ urldecode($product->nextPageUrl()) }}">
    @endif
    @if($product->previousPageUrl() != null)
        <link rel="prev" href="{{ urldecode($product->previousPageUrl()) }}">
    @endif
@endsection
@section('content')
    <!-- main -->
    <main class="search-page amazing-search default">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header-amazing-search"></div>
                </div>
                <div class=" col-12 order-2 px-0 px-lg-2">
                    <div class="sidebar-title-amazing pt-4 mb-0">
                        <h1 class="size-h1 font-weight-bold text-white mb-0">{{ $tag->title }}</h1>
                    </div>
                    <div class="breadcrumb-section default">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb-list" vocab="https://schema.org/" typeof="BreadcrumbList">
                                <li class="breadcrumb-item" property="itemListElement" typeof="ListItem">
                                    <a property="item" typeof="WebPage" href="{{ url('/') }}" title="قالی خانه">
                                        <span property="name">قالی خانه</span>

                                    </a>
                                    <meta property="position" content="1">
                                </li>
                                <li class="breadcrumb-item" property="itemListElement" typeof="ListItem">
                                    <a property="item" typeof="WebPage" title="{{ $tag->title }}"
                                       href="{{ url('tag/'.Illuminate\Support\Str::slug($tag->title_en)) }}">
                                        <span property="name">{{ $tag->title }}</span>
                                    </a>
                                    <meta property="position" content="2">
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="listing default">
                        <div class="listing-counter">
                            {{ App\Helper\Helper::number_latin_to_persian(number_format($product->total())) }} کالا
                        </div>
                        <div class="tab-content default text-center">

                            <div class="container no-padding-right">
                                @if($product->total() == 0)
                                    <div class="cart-empty m-0 border-0 shadow-none">
                                        <h3 class="cart-empty-title font-18 mb-4 mt-5">
                                            محصولی برای جستجوی
                                            <span class="text-danger btn-link-border font-18">
                                                {{ $tag->title }}
                                            </span>
                                            یافت نشد
                                        </h3>
                                        <div class="parent-btn">
                                            <a href="#" class="dk-btn dk-btn-success">
                                                بازگشت به صفحه اصلی
                                                <i class="fa fa-sign-in"></i>
                                            </a>
                                        </div>

                                    </div>
                                @else
                                <ul class="row listing-items">
                                    @foreach($product as $item)
                                        @if($item->awesome != null)
                                            @php
                                                $end=Carbon\Carbon::create($item->awesome->date_end_explode[0],$item->awesome->date_end_explode[1],$item->awesome->date_end_explode[2],$item->awesome->hour_end,0,0);
                                            @endphp
                                            @if(($end > Carbon\Carbon::now()->format('Y-m-d H:00:00')) && $item->awesome->entity > 0)
                                            <li class="col-xl-2 col-lg-3 col-md-4 col-6 no-padding">
                                                <div class="label-check">پیشنهاد شگفت انگیز</div>
                                                <div class="product-box px-lg-2 px-1">
                                                    <a class="product-box-img" target="_blank"
                                                       href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                       title="{{ $item->title }}">
                                                        <img class="lazy" data-src="{{ \App\Helper\Helper::getImage($item->picfirst) }}"
                                                             title="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}"
                                                             alt="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}">
                                                    </a>
                                                    <div class="product-box-content">
                                                        <div class="product-box-content-row">
                                                            <div class="product-box-title">
                                                                <a href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                                   title="{{ $item->title }}" target="_blank">
                                                                    <h2 class="size-h2-list">{{ $item->title }}</h2>
                                                                    {{--  {{ $item->title }}--}}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="product-box-row product-box-row-price">
                                                            <div class="price">
                                                                <div class="price-value">
                                                                    <div class="price-value-wrapper">
                                                                        <del>
                                                                        <span class="price-product price-discount-color">
                                                                        {{ \App\Helper\Helper::number_latin_to_persian(number_format($item->awesome->price)) }}
                                                                        </span>
                                                                        </del>

                                                                        <span class="price-discount mr-2">%{{ $item->awesome->price_percent }}</span>
                                                                        <br>
                                                                        <ins class="price-currency">
                                                                        <span>
                                                                            {{ number_format($item->awesome->price - ($item->awesome->price*($item->awesome->price_percent/100))) }}
                                                                            <span>
                                                                                تومان
                                                                            </span>
                                                                        </span>
                                                                        </ins>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 colors-product px-1">
                                                    <div class="colors">
                                                        @foreach($item->color as $color)
                                                            <div class="color"
                                                                 data-toggle="tooltip" data-placement="top" title="{{ $color->title_factory }}"
                                                                 style="background-color: {{ $color->color }}" data-hex="{{ $color->color }}"></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </li>
                                            @else
                                                <li class="col-xl-2 col-lg-3 col-md-4 col-6 no-padding">
                                                    @if($item->entity <=0 || $item->status==2)
                                                        <div class="label-check">موجود نیست</div>
                                                    @endif
                                                    <div class="product-box px-lg-2 px-1">
                                                        <a class="product-box-img" target="_blank"
                                                           href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                           title="{{ $item->title }}">
                                                            <img class="lazy" data-src="{{ \App\Helper\Helper::getImage($item->picfirst) }}"
                                                                 title="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}"
                                                                 alt="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}">
                                                        </a>
                                                        <div class="product-box-content">
                                                            <div class="product-box-content-row">
                                                                <div class="product-box-title">
                                                                    <a href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                                       title="{{ $item->title }}" target="_blank">
                                                                        <h2 class="size-h2-list">{{ $item->title }}</h2>
                                                                        {{--  {{ $item->title }}--}}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="product-box-row product-box-row-price">
                                                                <div class="price">
                                                                    <div class="price-value">
                                                                        @if($item->price_type == 1)
                                                                            <div class="price-value-wrapper">
                                                                                <ins class="price-currency">
                                                                                    {{ \App\Helper\Helper::number_latin_to_persian(number_format($item->price)) }}
                                                                                    <span class="price-currency">تومان</span>
                                                                                </ins>

                                                                            </div>
                                                                        @elseif($item->price_type == 2)
                                                                            <div class="price-value-wrapper">
                                                                                <del>
                                                                            <span class="price-product price-discount-color">
                                                                            {{ \App\Helper\Helper::number_latin_to_persian(number_format($item->price)) }}
                                                                            </span>
                                                                                </del>

                                                                                <span class="price-discount mr-2">%{{ $item->price_percent }}</span>
                                                                                <br>
                                                                                <ins class="price-currency">
                                                                            <span>
                                                                                {{ number_format($item->price - ($item->price*($item->price_percent/100))) }}
                                                                                <span>
                                                                                    تومان
                                                                                </span>
                                                                            </span>
                                                                                </ins>
                                                                            </div>

                                                                        @elseif($item->price_type == 3)
                                                                            <div class="price-value-wrapper">
                                                                                <a class="btn btn-sm btn-danger" href="tel:02144542991" title="تماس با قالی خانه">
                                                                            <span class="price-currency px-2 py-2">
                                                                                <i class="fa fa-phone"></i>
                                                                                تماس تلفنی

                                                                            </span>
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 colors-product px-1">
                                                        <div class="colors">
                                                            @foreach($item->color as $color)
                                                                <div class="color"
                                                                     data-toggle="tooltip" data-placement="top" title="{{ $color->title_factory }}"
                                                                     style="background-color: {{ $color->color }}" data-hex="{{ $color->color }}"></div>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @else
                                            <li class="col-xl-2 col-lg-3 col-md-4 col-6 no-padding">
                                                @if($item->entity <=0 || $item->status==2)
                                                    <div class="label-check">موجود نیست</div>
                                                @endif
                                                <div class="product-box px-lg-2 px-1">
                                                    <a class="product-box-img" target="_blank"
                                                       href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                       title="{{ $item->title }}">
                                                        <img class="lazy" data-src="{{ \App\Helper\Helper::getImage($item->picfirst) }}"
                                                             title="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}"
                                                             alt="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}">
                                                    </a>
                                                    <div class="product-box-content">
                                                        <div class="product-box-content-row">
                                                            <div class="product-box-title">
                                                                <a href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                                   title="{{ $item->title }}" target="_blank">
                                                                    <h2 class="size-h2-list">{{ $item->title }}</h2>
                                                                    {{--  {{ $item->title }}--}}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="product-box-row product-box-row-price">
                                                            <div class="price">
                                                                <div class="price-value">
                                                                    @if($item->price_type == 1)
                                                                        <div class="price-value-wrapper">
                                                                            <ins class="price-currency">
                                                                                {{ \App\Helper\Helper::number_latin_to_persian(number_format($item->price)) }}
                                                                                <span class="price-currency">تومان</span>
                                                                            </ins>

                                                                        </div>
                                                                    @elseif($item->price_type == 2)
                                                                        <div class="price-value-wrapper">
                                                                            <del>
                                                                            <span class="price-product price-discount-color">
                                                                            {{ \App\Helper\Helper::number_latin_to_persian(number_format($item->price)) }}
                                                                            </span>
                                                                            </del>

                                                                            <span class="price-discount mr-2">%{{ $item->price_percent }}</span>
                                                                            <br>
                                                                            <ins class="price-currency">
                                                                            <span>
                                                                                {{ number_format($item->price - ($item->price*($item->price_percent/100))) }}
                                                                                <span>
                                                                                    تومان
                                                                                </span>
                                                                            </span>
                                                                            </ins>
                                                                        </div>

                                                                    @elseif($item->price_type == 3)
                                                                        <div class="price-value-wrapper">
                                                                            <a class="btn btn-sm btn-danger" href="tel:02144542991" title="تماس با قالی خانه">
                                                                            <span class="price-currency px-2 py-2">
                                                                                <i class="fa fa-phone"></i>
                                                                                تماس تلفنی

                                                                            </span>
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 colors-product px-1">
                                                    <div class="colors">
                                                        @foreach($item->color as $color)
                                                            <div class="color"
                                                                 data-toggle="tooltip" data-placement="top" title="{{ $color->title_factory }}"
                                                                 style="background-color: {{ $color->color }}" data-hex="{{ $color->color }}"></div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach

                                </ul>
                                @endif
                            </div>

                        </div>
                        <div class="pager default text-center">
                            {{ $product->links() }}
                        </div>
                    </div>
                </div>
            </div>
            @if($tag->text != '')
                <div class="row px-3">
                    <div class="col-12 mt-3 bg-white">
                        <div class="tab-content py-3">
                            <div class="parent-expert default">
                                <div class="content-expert size-show">
                                    {!! \App\Helper\Helper::last_text_article(\App\Helper\Helper::Nofollow($tag->text)) !!}
                                </div>
                                <div class="text-center">
                                    <a onclick="ShowMore();" id="more" class="w-100 btn-link-border d-inline show-less-a" >ادامه مطلب</a>
                                    <a onclick="ShowLess();" id="less" class="w-100 btn-link-border show-less-a d-none" >بستن</a>
                                    <div class="shadow-box"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </main>
    <!-- main -->
@endsection
