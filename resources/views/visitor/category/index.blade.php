@extends('layouts.app')

@section('img-seo')
    <meta property="og:url" content="{{ urldecode(url()->current()) }}"/>
    @if(isset($category->pic))
        <meta property="og:image" content="{{ asset($category->pic) }}"/>
        <link rel="image_src" href="{{ asset($category->pic) }}">
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:image" content="{{ asset($category->pic) }}"/>
        <meta property="og:image:alt" content="{{ $category->pic_alt != '' ? $category->pic_alt : $category->title }}"/>
    @endif
@endsection
@section('meta-next-prev')
    @if($product->nextPageUrl() != null)
        <link rel="next" href="{{ urldecode($product->nextPageUrl()) }}">
    @endif
    @if($product->previousPageUrl() != null)
        <link rel="prev" href="{{ urldecode($product->previousPageUrl()) }}">
    @endif
@endsection
@if($category->faqs->count())
@section('faq')itemscope itemtype="https://schema.org/FAQPage"@endsection
@endif
@section('content')
    <!-- main -->
    <main class="search-page amazing-search default">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header-amazing-search"></div>
                </div>
                <aside class="sidebar-page col-12 col-sm-12 col-md-4 col-lg-3 order-1 pb-0 mb-0">
                    <div class="d-none d-md-block">
                        <div class="sidebar-title-amazing">
                            <h1 class="size-h1 font-weight-bold text-white mb-0">{{ $category->title }}</h1>
                        </div>
                    </div>
                    <div class="d-block d-md-none">
                        <div class="sidebar-title-amazing d-flex align-items-center justify-content-between">
                            <h1 class="size-h1 font-weight-bold text-white mb-0">{{ $category->title }}</h1>
                            <a class="btn btn-outline-success" href="#"  data-toggle="modal" data-target="#myModal">
                                فیلتر پیشرفته
                                <i class="fa fa-filter"></i>
                            </a>
                        </div>
                    </div>
                    @if($agent->isDesktop())
                        <div class="d-none d-md-block">
                            @if(count(request()->all()))
                                <div class="box">
                                    <div class="box-header">
                                        <div class="box-toggle d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapseExample1" role="button"
                                             aria-expanded="true" aria-controls="collapseExample1">
                                            فیلتر های اعمال شده:
                                            <a class="text-danger" href="{{ url()->current() }}">حذف</a>
                                        </div>
                                    </div>
                                    <div class="box-content">
                                        <div class="collapse show" id="collapseExample3">
                                            <div class="filter-option ">
                                                @foreach(request()->all() as $key=>$res)
                                                    <div class="btn-group btn-group-sm direction-ltr">
                                                        @switch($key)
                                                            @case('sort')
                                                            <button onclick="removeFilterUrl('{{$key}}');" type="button"
                                                                    class="btn bg-grey"><span class="text-danger fa fa-close"></span></button>
                                                            <button type="button" onclick="removeFilterUrl('{{$key}}');"
                                                                    class="btn bg-grey text-dark">مرتب سازی</button>
                                                            @break
                                                            @case('brand')
                                                            <button onclick="removeFilterUrl('{{$key}}');" type="button"
                                                                    class="btn bg-grey"><span class="text-danger fa fa-close"></span></button>
                                                            <button type="button" onclick="removeFilterUrl('{{$key}}');"
                                                                    class="btn bg-grey text-dark">برند</button>
                                                            @break
                                                            @case('entity')
                                                            <button onclick="removeFilterUrl('{{$key}}');" type="button"
                                                                    class="btn bg-grey"><span class="text-danger fa fa-close"></span></button>
                                                            <button type="button" onclick="removeFilterUrl('{{$key}}');"
                                                                    class="btn bg-grey text-dark">فقط کالاهای موجود</button>
                                                            @break
                                                            @case('color')
                                                            <button onclick="removeFilterUrl('{{$key}}');" type="button"
                                                                    class="btn bg-grey"><span class="text-danger fa fa-close"></span></button>
                                                            <button type="button" onclick="removeFilterUrl('{{$key}}');"
                                                                    class="btn bg-grey text-dark">رنگبندی</button>
                                                            @break
                                                            @case('size')
                                                            <button onclick="removeFilterUrl('{{$key}}');" type="button"
                                                                    class="btn bg-grey"><span class="text-danger fa fa-close"></span></button>
                                                            <button type="button" onclick="removeFilterUrl('{{$key}}');"
                                                                    class="btn bg-grey text-dark">سایزبندی</button>
                                                            @break
                                                            @case('discount')
                                                            <button onclick="removeFilterUrl('{{$key}}');" type="button"
                                                                    class="btn bg-grey"><span class="text-danger fa fa-close"></span></button>
                                                            <button type="button" onclick="removeFilterUrl('{{$key}}');"
                                                                    class="btn bg-grey text-dark">تخفیف دار</button>
                                                            @break
                                                        @endswitch
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="box">
                                <div class="box-header">
                                    <div class="box-toggle" data-toggle="collapse" href="#collapseExample2" role="button"
                                         aria-expanded="true" aria-controls="collapseExample2">
                                        دسته بندی محصولات
                                        <i class="now-ui-icons arrows-1_minimal-down"></i>
                                    </div>
                                </div>
                                <div class="box-content">
                                    <div class="collapse show" id="collapseExample2">
                                        <ul class="filter-option">
                                            @foreach($list_category as $value)
                                                <li class="py-1">
                                                    <a href="{{ url(Illuminate\Support\Str::slug($value->title_en)) }}" class="d-flex align-items-center justify-content-start text-black">
                                                        <span class="fa fa-angle-left"></span>
                                                        <span class="pr-2" for="checkbox{{ $loop->iteration }}">
                                                    {{ $value->title }}
                                                </span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header">
                                    <div class="box-toggle" data-toggle="collapse" href="#collapseExample3" role="button"
                                         aria-expanded="true" aria-controls="collapseExample3">
                                        برند
                                        <i class="now-ui-icons arrows-1_minimal-down"></i>
                                    </div>
                                </div>
                                <div class="box-content">
                                    <div class="collapse show" id="collapseExample3">
                                        <div class="filter-option ">
                                            @foreach($brand_list as $brand)
                                                <div class="col-12">
                                                    <input onchange="qwe();" id="brand{{ $brand->id }}" name="brand[]" value="{{$brand->id}}" type="checkbox"
                                                        {{ isset(request()->brand) ? (in_array($brand->id,explode(',',request()->brand)) ? 'checked' : '')  : '' }}>
                                                    <label for="brand{{ $brand->id }}">
                                                        {{ $brand->title }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header">
                                    <div class="box-toggle" data-toggle="collapse" href="#collapseExample4" role="button"
                                         aria-expanded="true" aria-controls="collapseExample4">
                                        سایز بندی
                                        <i class="now-ui-icons arrows-1_minimal-down"></i>
                                    </div>
                                </div>
                                <div class="box-content">
                                    <div class="collapse show" id="collapseExample4">
                                        <div class="filter-option ">
                                            @foreach($sizes as $size)
                                                <div class="col-12">
                                                    <input onchange="sizep();" id="size{{ $size->title }}" name="size[]"
                                                           value="{{$size->title}}" type="checkbox"
                                                        {{ isset(request()->size) ? (in_array($size->title,explode(',',request()->size)) ? 'checked' : '')  : '' }}>
                                                    <label for="size{{ $size->title }}">
                                                        {{ $size->title }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header">
                                    <div class="box-toggle" data-toggle="collapse" href="#collapseExample5" role="button"
                                         aria-expanded="true" aria-controls="collapseExample5">
                                        رنگبندی
                                        <i class="now-ui-icons arrows-1_minimal-down"></i>
                                    </div>
                                </div>
                                <div class="box-content">
                                    <div class="collapse show" id="collapseExample5">
                                        <div class="filter-option ">
                                            @foreach($colors as $color)
                                                <div class="col-12">
                                                    <input onchange="colorp();" id="size{{ $color->title }}" name="size[]"
                                                           value="{{$color->title}}" type="checkbox"
                                                        {{ isset(request()->color) ? (in_array($color->title,explode(',',request()->color)) ? 'checked' : '')  : '' }}>
                                                    <label for="size{{ $color->title }}">
                                                        {{ $color->title }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-content">
                                    <input type="checkbox" id="entity" name="entity" class="bootstrap-switch"
                                           onchange="{{ isset(request()->entity) ? (request()->entity == 1 ? 'entity(0)' : 'entity(1)') : 'entity(1)' }}"
                                        {{ isset(request()->entity) ? (request()->entity == 1 ? 'checked' : '') : '' }} />
                                    <label for="">فقط کالاهای موجود</label>
                                </div>
                            </div>
                        </div>
                    @else
                        @include('temp.modal_right')
                    @endif
                </aside>
                <div class="col-12 col-sm-12 col-md-8 col-lg-9 order-2 px-0 px-lg-2">
                    <div class="breadcrumb-section default">
                        <nav aria-label="breadcrumb">
                            {{ Breadcrumbs::render('category', $category) }}
                        </nav>
                    </div>
                    <div class="listing default">
                        <div class="listing-counter">
                            {{ App\Helper\Helper::number_latin_to_persian(number_format($product->total())) }} کالا
                        </div>
                        <div class="listing-header default">
                            <ul class="listing-sort nav nav-tabs justify-content-center" role="tablist"
                                data-label="مرتب‌سازی بر اساس :">
                                <li>
                                    <a {{ isset(request()->sort) ? (request()->sort == 1 ? 'class=active' : '') : '' }} href="{{ url()->current() }}?sort=1">پربازدیدترین</a>
                                </li>
                                <li>
                                    <a {{ isset(request()->sort) ? (request()->sort == 2 ? 'class=active' : '') : '' }} href="{{ url()->current() }}?sort=2">جدیدترین</a>
                                </li>
                                <li>
                                    <a {{ isset(request()->sort) ? (request()->sort == 3 ? 'class=active' : '') : '' }} href="{{ url()->current() }}?sort=3">ارزان‌ترین</a>
                                </li>
                                <li>
                                    <a {{ isset(request()->sort) ? (request()->sort == 4 ? 'class=active' : '') : '' }} href="{{ url()->current() }}?sort=4">گران‌ترین</a>
                                </li>
                                <li>
                                    <a {{ isset(request()->discount) ? (request()->discount == 5 ? 'class=active' : '') : '' }} href="{{ url()->current() }}?discount=5">تخفیف دار</a>
                                </li>
                            </ul>
                        </div>
                        @if($category->short_text != '')
                            <div class="col-12 pb-2 border-bottom">
                                {!! $category->short_text !!}
                            </div>
                        @endif
                        <div class="tab-content default text-center">
                            <div class="container no-padding-right">
                                @if($product->total() == 0)
                                    <div class="cart-empty m-0 border-0 shadow-none">
                                        <h3 class="cart-empty-title font-18 mb-4 mt-5">
                                            محصولی برای جستجوی
                                            <span class="text-danger btn-link-border font-18">
                                                {{ $category->title }}
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
                                        @if(isset(request()->size) && request()->size != '')
                                            @if($item->size->count() > 0 && !empty(array_intersect($item->size->pluck('title')->toArray(),\App\Helper\Helper::UrlParameterToArray(request()->size))))
                                                @if(isset(request()->color) && request()->color != '')
                                                    @if($item->color->count() > 0 && !empty(array_intersect($item->color->pluck('title')->toArray(),\App\Helper\Helper::UrlParameterToArray(request()->color))))
                                                        @if($item->awesome != null)
                                                            @php
                                                                $end=Carbon\Carbon::create($item->awesome->date_end_explode[0],$item->awesome->date_end_explode[1],$item->awesome->date_end_explode[2],$item->awesome->hour_end,0,0);
                                                            @endphp
                                                            @if(($end > Carbon\Carbon::now()->format('Y-m-d H:00:00')) && $item->awesome->entity > 0)
                                                                <li class="col-xl-3 col-lg-4 col-md-6 col-6 no-padding">
                                                                    <div class="label-check">پیشنهاد شگفت انگیز</div>
                                                                    {{--<div class="label-check">{{ $end }}</div>--}}
                                                                    <div class="product-box px-lg-2 px-1">
                                                                        <a class="product-box-img" target="_blank"
                                                                           href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                                           title="{{ $item->title }}">
                                                                            <img class="lazy" data-src="{{ \App\Helper\Helper::getImage($item->picfirst) }}"
                                                                                 title="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}"
                                                                                 alt="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}">
                                                                            @if($category->type==2)
                                                                                <img class="lazy position-absolute cat-img-small" data-src="{{ asset($category->pic) }}">
                                                                            @endif
                                                                        </a>
                                                                        <div class="product-box-content">
                                                                            <div class="product-box-content-row">
                                                                                <div class="product-box-title">
                                                                                    <a href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                                                       title="{{ $item->title }}" target="_blank">
                                                                                        <h2 class="size-h2-list">{{ $item->title }}</h2>
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
                                                                <li class="col-xl-3 col-lg-4 col-md-6 col-6 no-padding">
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
                                                                            @if($category->type==2)
                                                                                <img class="lazy position-absolute cat-img-small" data-src="{{ asset($category->pic) }}">
                                                                            @endif
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
                                                            <li class="col-xl-3 col-lg-4 col-md-6 col-6 no-padding">
                                                                @if($item->entity <=0 || $item->status==2)
                                                                    <div class="label-check">موجود نیست</div>
                                                                @endif
                                                                {{-- <ul class="position-absolute pr-3 pt-5 color-ul">
                                                                     @foreach($item->color as $color)
                                                                         <li class="d-flex mb-1">
                                                                             <span class="rounded-circle" style="background-color: {{ $color->color }};"></span>
                                                                         </li>
                                                                     @endforeach
                                                                 </ul>--}}
                                                                <div class="product-box px-lg-2 px-1">
                                                                    {{--<div class="product-seller-details product-seller-details-item-grid">
                                                                        <span class="product-main-seller">
                                                                            <span class="product-seller-details-label">فروشنده:
                                                                            </span>قالی خانه</span>
                                                                        <span class="product-seller-details-badge-container"></span>
                                                                    </div>--}}

                                                                    <a class="product-box-img" target="_blank"
                                                                       href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                                       title="{{ $item->title }}">
                                                                        <img class="lazy" data-src="{{ \App\Helper\Helper::getImage($item->picfirst) }}"
                                                                             title="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}"
                                                                             alt="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}">
                                                                        @if($category->type==2)
                                                                            <img class="lazy position-absolute cat-img-small" data-src="{{ asset($category->pic) }}">
                                                                        @endif
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
                                                    @endif
                                                @else
                                                    @if($item->awesome != null)
                                                        @php
                                                            $end=Carbon\Carbon::create($item->awesome->date_end_explode[0],$item->awesome->date_end_explode[1],$item->awesome->date_end_explode[2],$item->awesome->hour_end,0,0);
                                                        @endphp
                                                        @if(($end > Carbon\Carbon::now()->format('Y-m-d H:00:00')) && $item->awesome->entity > 0)
                                                            <li class="col-xl-3 col-lg-4 col-md-6 col-6 no-padding">
                                                                <div class="label-check">پیشنهاد شگفت انگیز</div>
                                                                {{--<div class="label-check">{{ $end }}</div>--}}
                                                                <div class="product-box px-lg-2 px-1">
                                                                    <a class="product-box-img" target="_blank"
                                                                       href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                                       title="{{ $item->title }}">
                                                                        <img class="lazy" data-src="{{ \App\Helper\Helper::getImage($item->picfirst) }}"
                                                                             title="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}"
                                                                             alt="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}">
                                                                        @if($category->type==2)
                                                                            <img class="lazy position-absolute cat-img-small" data-src="{{ asset($category->pic) }}">
                                                                        @endif
                                                                    </a>
                                                                    <div class="product-box-content">
                                                                        <div class="product-box-content-row">
                                                                            <div class="product-box-title">
                                                                                <a href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                                                   title="{{ $item->title }}" target="_blank">
                                                                                    <h2 class="size-h2-list">{{ $item->title }}</h2>
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
                                                            <li class="col-xl-3 col-lg-4 col-md-6 col-6 no-padding">
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
                                                                        @if($category->type==2)
                                                                            <img class="lazy position-absolute cat-img-small" data-src="{{ asset($category->pic) }}">
                                                                        @endif
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
                                                        <li class="col-xl-3 col-lg-4 col-md-6 col-6 no-padding">
                                                            @if($item->entity <=0 || $item->status==2)
                                                                <div class="label-check">موجود نیست</div>
                                                            @endif
                                                            {{-- <ul class="position-absolute pr-3 pt-5 color-ul">
                                                                 @foreach($item->color as $color)
                                                                     <li class="d-flex mb-1">
                                                                         <span class="rounded-circle" style="background-color: {{ $color->color }};"></span>
                                                                     </li>
                                                                 @endforeach
                                                             </ul>--}}
                                                            <div class="product-box px-lg-2 px-1">
                                                                {{--<div class="product-seller-details product-seller-details-item-grid">
                                                                    <span class="product-main-seller">
                                                                        <span class="product-seller-details-label">فروشنده:
                                                                        </span>قالی خانه</span>
                                                                    <span class="product-seller-details-badge-container"></span>
                                                                </div>--}}

                                                                <a class="product-box-img" target="_blank"
                                                                   href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                                   title="{{ $item->title }}">
                                                                    <img class="lazy" data-src="{{ \App\Helper\Helper::getImage($item->picfirst) }}"
                                                                         title="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}"
                                                                         alt="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}">
                                                                    @if($category->type==2)
                                                                        <img class="lazy position-absolute cat-img-small" data-src="{{ asset($category->pic) }}">
                                                                    @endif
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
                                                @endif
                                            @endif
                                        @else
                                            @if(isset(request()->color) && request()->color != '')
                                                @if($item->color->count() > 0 && !empty(array_intersect($item->color->pluck('title')->toArray(),\App\Helper\Helper::UrlParameterToArray(request()->color))))
                                                    @if($item->awesome != null)
                                                        @php
                                                            $end=Carbon\Carbon::create($item->awesome->date_end_explode[0],$item->awesome->date_end_explode[1],$item->awesome->date_end_explode[2],$item->awesome->hour_end,0,0);
                                                        @endphp
                                                        @if(($end > Carbon\Carbon::now()->format('Y-m-d H:00:00')) && $item->awesome->entity > 0)
                                                            <li class="col-xl-3 col-lg-4 col-md-6 col-6 no-padding">
                                                                <div class="label-check">پیشنهاد شگفت انگیز</div>
                                                                {{--<div class="label-check">{{ $end }}</div>--}}
                                                                <div class="product-box px-lg-2 px-1">
                                                                    <a class="product-box-img" target="_blank"
                                                                       href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                                       title="{{ $item->title }}">
                                                                        <img class="lazy" data-src="{{ \App\Helper\Helper::getImage($item->picfirst) }}"
                                                                             title="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}"
                                                                             alt="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}">
                                                                        @if($category->type==2)
                                                                            <img class="lazy position-absolute cat-img-small" data-src="{{ asset($category->pic) }}">
                                                                        @endif
                                                                    </a>
                                                                    <div class="product-box-content">
                                                                        <div class="product-box-content-row">
                                                                            <div class="product-box-title">
                                                                                <a href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                                                   title="{{ $item->title }}" target="_blank">
                                                                                    <h2 class="size-h2-list">{{ $item->title }}</h2>
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
                                                            <li class="col-xl-3 col-lg-4 col-md-6 col-6 no-padding">
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
                                                                        @if($category->type==2)
                                                                            <img class="lazy position-absolute cat-img-small" data-src="{{ asset($category->pic) }}">
                                                                        @endif
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
                                                        <li class="col-xl-3 col-lg-4 col-md-6 col-6 no-padding">
                                                            @if($item->entity <=0 || $item->status==2)
                                                                <div class="label-check">موجود نیست</div>
                                                            @endif
                                                            {{-- <ul class="position-absolute pr-3 pt-5 color-ul">
                                                                 @foreach($item->color as $color)
                                                                     <li class="d-flex mb-1">
                                                                         <span class="rounded-circle" style="background-color: {{ $color->color }};"></span>
                                                                     </li>
                                                                 @endforeach
                                                             </ul>--}}
                                                            <div class="product-box px-lg-2 px-1">
                                                                {{--<div class="product-seller-details product-seller-details-item-grid">
                                                                    <span class="product-main-seller">
                                                                        <span class="product-seller-details-label">فروشنده:
                                                                        </span>قالی خانه</span>
                                                                    <span class="product-seller-details-badge-container"></span>
                                                                </div>--}}

                                                                <a class="product-box-img" target="_blank"
                                                                   href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                                   title="{{ $item->title }}">
                                                                    <img class="lazy" data-src="{{ \App\Helper\Helper::getImage($item->picfirst) }}"
                                                                         title="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}"
                                                                         alt="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}">
                                                                    @if($category->type==2)
                                                                        <img class="lazy position-absolute cat-img-small" data-src="{{ asset($category->pic) }}">
                                                                    @endif
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
                                                @endif
                                            @else
                                                @if($item->awesome != null)
                                                    @php
                                                        $end=Carbon\Carbon::create($item->awesome->date_end_explode[0],$item->awesome->date_end_explode[1],$item->awesome->date_end_explode[2],$item->awesome->hour_end,0,0);
                                                    @endphp
                                                    @if(($end > Carbon\Carbon::now()->format('Y-m-d H:00:00')) && $item->awesome->entity > 0)
                                                        <li class="col-xl-3 col-lg-4 col-md-6 col-6 no-padding">
                                                            <div class="label-check">پیشنهاد شگفت انگیز</div>
                                                            {{--<div class="label-check">{{ $end }}</div>--}}
                                                            <div class="product-box px-lg-2 px-1">
                                                                <a class="product-box-img" target="_blank"
                                                                   href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                                   title="{{ $item->title }}">
                                                                    <img class="lazy" data-src="{{ \App\Helper\Helper::getImage($item->picfirst) }}"
                                                                         title="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}"
                                                                         alt="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}">
                                                                    @if($category->type==2)
                                                                        <img class="lazy position-absolute cat-img-small" data-src="{{ asset($category->pic) }}">
                                                                    @endif
                                                                </a>
                                                                <div class="product-box-content">
                                                                    <div class="product-box-content-row">
                                                                        <div class="product-box-title">
                                                                            <a href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                                               title="{{ $item->title }}" target="_blank">
                                                                                <h2 class="size-h2-list">{{ $item->title }}</h2>
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
                                                        <li class="col-xl-3 col-lg-4 col-md-6 col-6 no-padding">
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
                                                                    @if($category->type==2)
                                                                        <img class="lazy position-absolute cat-img-small" data-src="{{ asset($category->pic) }}">
                                                                    @endif
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
                                                    <li class="col-xl-3 col-lg-4 col-md-6 col-6 no-padding">
                                                        @if($item->entity <=0 || $item->status==2)
                                                            <div class="label-check">موجود نیست</div>
                                                        @endif
                                                        {{-- <ul class="position-absolute pr-3 pt-5 color-ul">
                                                             @foreach($item->color as $color)
                                                                 <li class="d-flex mb-1">
                                                                     <span class="rounded-circle" style="background-color: {{ $color->color }};"></span>
                                                                 </li>
                                                             @endforeach
                                                         </ul>--}}
                                                        <div class="product-box px-lg-2 px-1">
                                                            {{--<div class="product-seller-details product-seller-details-item-grid">
                                                                <span class="product-main-seller">
                                                                    <span class="product-seller-details-label">فروشنده:
                                                                    </span>قالی خانه</span>
                                                                <span class="product-seller-details-badge-container"></span>
                                                            </div>--}}

                                                            <a class="product-box-img" target="_blank"
                                                               href="{{ route('product.show',$item->id.'-'.Illuminate\Support\Str::slug($item->title_en)) }}"
                                                               title="{{ $item->title }}">
                                                                <img class="lazy" data-src="{{ \App\Helper\Helper::getImage($item->picfirst) }}"
                                                                     title="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}"
                                                                     alt="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}">
                                                                @if($category->type==2)
                                                                    <img class="lazy position-absolute cat-img-small" data-src="{{ asset($category->pic) }}">
                                                                @endif
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
                                            @endif
                                        @endif
                                    @endforeach
                                </ul>
                                @endif
                            </div>

                        </div>
                        <div class="pager default text-center col-12">
                            {{ $product->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
            @if($category->text != '')
                <div class="row px-3">
                    <div class="col-12 mt-3 bg-white">
                        <div class="tab-content py-3">
                            <div class="parent-expert default">
                                <div class="content-expert size-show">
                                    {!! \App\Helper\Helper::last_text_article(\App\Helper\Helper::Nofollow($category->text)) !!}
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
            @if($category->faqs->count())
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 px-1">
                        <p class="pt-3 mb-2">
                            سوالات متداول :
                        </p>
                        <div id="accordion">
                            @foreach($category->faqs as $valf)
                                <div class="card mb-1" itemscope itemprop="mainEntity"
                                     itemtype="https://schema.org/Question">
                                    <div class="card-header collapsed p-0" id="headingOne{{$loop->iteration}}"
                                         data-toggle="collapse" data-target="#collapseOne{{ $loop->iteration }}"
                                         aria-expanded="true"
                                         aria-controls="collapseOne{{ $loop->iteration }}">
                                        <h5 class="mb-0" itemprop="name">
                                            <button class="btn btn-link font-14" >
                                                {{ $valf->question }}
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne{{ $loop->iteration }}" class="collapse"
                                         aria-labelledby="headingOne{{ $loop->iteration }}"
                                         data-parent="#accordion" itemscope itemprop="acceptedAnswer"
                                         itemtype="https://schema.org/Answer">
                                        <div class="card-body" itemprop="text">
                                            {!! $valf->answer !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>
    <!-- main -->
@endsection
