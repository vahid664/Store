@extends('layouts.app')
@section('img-seo')
        <meta property="og:url" content="{{ urldecode(url()->current()) }}"/>
    @if($query->category_first != null)
        <meta property="article:section" content="{{ $query->category_first->category->title }}" />
    @endif
    @if(isset($query->picfirst->id))
        <meta property="og:image" content="{{ asset($query->picfirst->link) }}"/>
        <link rel="image_src" href="{{ asset($query->picfirst->link) }}">
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:image" content="{{ asset($query->picfirst->link) }}"/>
        <meta property="og:image:alt" content="{{ $query->picfirst->title }}"/>
    @endif
    <meta property="article:published_time" content="{{ $query->created_at != '' ? $query->created_at->format('Y-m-d') : '' }}" />
    <meta property="article:modified_time" content="{{ $query->updated_at != '' ? $query->updated_at->format('Y-m-d') : '' }}" />
@endsection
@section('json-ld')
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "NewsArticle",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ url($query->category_first != null ? $query->category_first->category->title : '' ) }}"
      },
      "headline": "{{ str_replace('\\',' ',$query->title) }}",
      @if(isset($query->picfirst->id))
            "image": [
               "{{ asset($query->picfirst->link) }}"
       ],
       @endif
        "datePublished": "{{ $query->created_at }}",
      "dateModified": "{{ $query->updated_at }}",
      "author": {
        "@type": "Person",
        "name": "{{ $query->user != '' ? $query->user->name.' '. $query->user->family : '' }}"
      },
       "publisher": {
        "@type": "Organization",
        "name": "{{ config('app.name', 'Laravel') }}",
        "logo": {
          "@type": "ImageObject",
          "url": "{{ asset('img/logo.png') }}"
        }
      },
      "description": "{{ str_replace('\\',' ',$query->description) }}"
    }
    </script>
@endsection
@if($query->faqs->count())
@section('faq')itemscope itemtype="https://schema.org/FAQPage"@endsection
@endif
@if($query->faqs->count() == 0)
    @include('temp.head_comment',['comment' => $query->comments])
@endif
@section('content')
    <!-- main -->
    <main class="single-product default">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        {{ Breadcrumbs::render('product', $query) }}
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-12 px-1 px-lg-3">
                    <article class="product">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="product-gallery default">
                                    <img class="zoom-img" id="img-product-zoom"
                                         title="{{ \App\Helper\Helper::getImageAlt($query->picfirst) }}"
                                         alt="{{ \App\Helper\Helper::getImageAlt($query->picfirst) }}"
                                         src="{{ \App\Helper\Helper::getImage($query->picfirst) }}"
                                         data-zoom-image="{{ \App\Helper\Helper::getImage($query->picfirst) }}" />

                                    <div id="gallery_01f" class="float-left">
                                        <ul class="gallery-items">
                                            @foreach($query->pics as $value)
                                                @if($loop->first)
                                                    <li>
                                                        <a href="#" class="elevatezoom-gallery active" data-update=""
                                                           data-image="{{ asset($value->link) }}"
                                                           title="{{ $value->title }}"
                                                           data-zoom-image="{{ asset($value->link) }}" id="pic{{$value->id}}">
                                                            <img src="{{ asset($value->link) }}" alt="{{ $value->title }}"
                                                                 title="{{ $value->title }}" /></a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="#" class="elevatezoom-gallery" data-update=""
                                                           data-image="{{ asset($value->link) }}" title="{{ $value->title }}"
                                                           data-zoom-image="{{ asset($value->link) }}" id="pic{{$value->id}}">
                                                            <img src="{{ asset($value->link) }}" alt="{{ $value->title }}"
                                                                 title="{{ $value->title }}" /></a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">گزارش قیمت مناسب‌تر این کالا
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body " >
                                                    <div class="row">
                                                        <div class="col-12">

                                                            <form method="post" action="{{ url('/ProductOffer') }}">
                                                                @csrf
                                                                <input type="hidden" id="custId" name="product_id" value="{{ $query->id }}">
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">این کالا را با چه قیمتی دیده‌اید؟
                                                                    </label>
                                                                    <input type="number" class="form-control" id="recipient-nameone" value="" name="price_observed">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="message-text" class="col-form-label">آدرس اینترنتی فروشگاه
                                                                    </label>
                                                                    <input type="url" class="form-control" id="recipient-nameone" value="" name="url_address">
                                                                </div>
                                                                <div class="form-group">

                                                                        <input type="submit" class="btn btn-primary" value="ثبت">
                                                                </div>
                                                            </form>

                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--     test popup form--}}
                                </div>

                                @if (session('ProductOffer'))
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-success alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <strong>{{ session('ProductOffer') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">آیا قیمت بهتری سراغ دارید؟</button>
                                @endif
                                <ul class="gallery-options">
                                    <li>
                                        @if(Auth::check() && in_array($query->id,Auth::user()->favorite->pluck('product_id')->toArray()))
                                            <button data-url="{{ route('favorite.show',$query->id) }}" class="add-favorites favorites"><i class="fa fa-heart"></i></button>
                                            <span class="tooltip-option">حذف از علاقمندی</span>
                                        @else
                                            <button data-url="{{ route('favorite.show',$query->id) }}" class="add-favorites"><i class="fa fa-heart"></i></button>
                                            <span class="tooltip-option">افزودن به علاقمندی</span>
                                        @endif

                                    </li>
                                    <li>
                                        <button data-toggle="modal" data-target="#myModal"><i class="fa fa-share-alt"></i></button>
                                        <span class="tooltip-option">اشتراک گذاری</span>
                                    </li>
                                </ul>
                                @include('temp.modal_share')
                            </div>




                            <div class="col-lg-8 col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="product-title default">
                                            <h1>
                                                {{ $query->title }}
                                                <span>{{ $query->title_en }}</span></h1>
                                        </div>
                                        <div class="row py-2">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <div class="pl-2">
                                                    رنگبندی محصول
                                                </div>
                                                <div>
                                                    <div class="colors">
                                                        @foreach($query->color as $color)
                                                            <div class="color"
                                                                 data-toggle="tooltip" data-placement="top" title="{{ $color->title_factory }}"
                                                                 style="background-color: {{ $color->color }}" data-hex="{{ $color->color }}"></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="product-directory default">
                                            <ul>
                                                <li>
                                                    <span>برند</span> :
                                                    <a href="{{ route('brand.show',Illuminate\Support\Str::slug($query->brands->title_en,'-')) }}" class="btn-link-border">
                                                        {{ $query->brands->title }}
                                                    </a>
                                                </li>

                                                @if($query->category_first != '')
                                                    <li>
                                                        <span>دسته‌بندی</span> :
                                                        <a href="{{ url(Illuminate\Support\Str::slug($query->category_first->category->title_en)) }}" class="btn-link-border">
                                                            {{ $query->category_first->category->title }}
                                                        </a>
                                                        @foreach($query->category_rel->where('id','<>',$query->category_first->id)->take(5) as $value)
                                                            @if($loop->last)
                                                                <a href="{{ url(Illuminate\Support\Str::slug($value->category->title_en)) }}"
                                                                   class="btn-link-border">
                                                                    {{ $value->category->title }}
                                                                </a>
                                                            @else
                                                                ،
                                                                <a href="{{ url(Illuminate\Support\Str::slug($value->category->title_en)) }}"
                                                                   class="btn-link-border">
                                                                    {{ $value->category->title }}
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    </li>
                                                @endif
                                                @if($query->warranty==1 && $query->origin==1)
                                                    <li>
                                                        <p class="product-guarantee-text">
                                                            <i class="fa fa-check-circle text-primary"></i>
                                                            گارانتی اصالت و سلامت فیزیکی کالا</p>
                                                    </li>
                                                @else
                                                    <li>
                                                        <p class="product-guarantee-text">
                                                            <i class="fa fa-check-circle"></i>
                                                            گارانتی سلامت فیزیکی کالا</p>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <form method="post" id="form-cart" action="{{ route('cart.store') }}">
                                            @csrf
                                            <input name="id" type="hidden" value="{{ $query->id }}">
                                            @if($query->size->count())
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead class="thead-light">
                                                        <tr>
                                                            <th class="py-0" scope="col">سایزبندی</th>
                                                            <th class="py-0" scope="col">قیمت اصلی</th>
                                                            <th class="py-0" scope="col">قیمت با تخفیف</th>
                                                            <th class="py-0" scope="col">استعلام</th>
                                                            <th class="py-0" scope="col">رنگبندی</th>
                                                            <th class="py-0" scope="col">تعداد</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($query->size as $item)

                                                            @if($item->entity > 0 && $item->price > 0)
                                                                <tr id="tr{{ $item->id }}">
                                                                    <th class="py-1" scope="row">{{ $item->title }}</th>
                                                                    <td class="py-1">{{ number_format($item->price) }}</td>
                                                                    <td class="py-1">
                                                                        @if($item->price_discount > 0)
                                                                            <div class="price-discount"><span>{{$item->price_discount}}</span><span>%</span></div>
                                                                        @endif
                                                                        {{ number_format($item->price - ($item->price_discount*$item->price/100)) }}
                                                                    </td>
                                                                    <td>
                                                                        @if($item->position == 0 )
                                                                            آماده ارسال
                                                                        @elseif($item->position == 1)
                                                                            سفارش جفت
                                                                        @elseif($item->position == 2)
                                                                            بین 7 الی 15 روز
                                                                        @else
                                                                            استعلام گرفته شود
                                                                        @endif
                                                                    </td>
                                                                    <td class="py-1 minw-product-td-table">
                                                                        <select class="form-control" name="color[]" id="color" required @if($item->position == 3) disabled @endif>
                                                                            <option value="--">--</option>
                                                                            @if($item->colors != '' && count(json_decode($item->colors)))
                                                                                @foreach(json_decode($item->colors) as $col)
                                                                                    @php $color=\App\ProductColor::find($col); @endphp
                                                                                    <option value="{{$color->title}}|{{$item->id}}">{{$color->title}}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </td>
                                                                    <td class="py-1 minw-product-td-table">

                                                                        <select class="form-control" required
                                                                                id="entity" name="entity[]" onchange="price_product()" @if($item->position == 3) disabled @endif>
                                                                            <option data-price="" value="--">--</option>
                                                                            @if($item->position == 1)
                                                                                @for($i=2;$i<=($item->entity <= 10 ? $item->entity : 10) ;$i = $i+2)
                                                                                    <option data-price="{{ ($item->price - ($item->price_discount*$item->price/100)) * $i }}" value="{{$i}}|{{$item->id}}">{{$i}}</option>
                                                                                @endfor
                                                                            @else
                                                                                @for($i=1;$i<=($item->entity <= 10 ? $item->entity : 10) ;$i++)
                                                                                    <option data-price="{{ ($item->price - ($item->price_discount*$item->price/100)) * $i }}" value="{{$i}}|{{$item->id}}">{{$i}}</option>
                                                                                @endfor
                                                                            @endif
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                            @endif
                                            <div class="row justify-content-end align-items-center">
                                                @if($query->status == 1 && $query->entity > 0)
                                                <div class="col-12 col-md-3 align-items-center">
                                                    <div class="price-product ml-3">
                                                        <div class="font-16 font-weight-bold">قیمت کل</div>
                                                        <div class="price-value text-right">
                                                            <span>{{ \App\Helper\Helper::number_latin_to_persian(number_format($query->price)) }} </span>
                                                            <span class="price-currency">تومان</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="col-12 col-md-4">
                                                    @if($query->price_type != 3 && $query->status == 1 && $query->entity > 0 &&  $query->size->count())
                                                        <div class="product-add">
                                                            <div class="parent-btn">
                                                                <button type="submit" class="dk-btn dk-btn-info w-100">
                                                                    افزودن به سبد خرید
                                                                    <i class="now-ui-icons shopping_cart-simple"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @else
                                                        @if($query->price_type != 3)
                                                            <div class="product-add">
                                                                <div class="parent-btn">
                                                                    <a href="#" class="dk-btn dk-btn-grey">
                                                                        موجود نیست
                                                                        <i class="fa fa-close"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="col-12">
                                        @if($query->tag_rel)
                                            <h2>
                                                @foreach($query->tag_rel as $val_tag)
                                                    <a href="{{ url('tag/'.Illuminate\Support\Str::slug($val_tag->tag->title_en)) }}" title="{{ $val_tag->tag->title }}">
                                                        <span class="p-2 size-h2-list btn badge badge-danger">{{ $val_tag->tag->title }}</span>
                                                    </a>
                                                @endforeach
                                            </h2>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="col-12 default no-padding">
                        <div class="product-tabs default">
                            <div class="box-tabs default">
                                <ul class="nav" role="tablist">
                                    <li class="box-tabs-tab">
                                        <a class="active" data-toggle="tab" href="#desc" role="tab" aria-expanded="true">
                                            <i class="now-ui-icons objects_umbrella-13"></i> درباره محصول
                                        </a>
                                    </li>
                                    @if($query->faqs->count())
                                    <li class="box-tabs-tab">
                                        <a data-toggle="tab" href="#faq" role="tab" aria-expanded="false">
                                            <i class="fa fa-question"></i>سوالات متداول
                                        </a>
                                    </li>
                                    @endif
                                    <li class="box-tabs-tab">
                                        <a data-toggle="tab" href="#params" role="tab" aria-expanded="false">
                                            <i class="now-ui-icons shopping_cart-simple"></i> اطلاعات تکمیلی و ویدئو
                                        </a>
                                    </li>
                                    <li class="box-tabs-tab">
                                        <a data-toggle="tab" href="#comments" role="tab" aria-expanded="false">
                                            <i class="fa fa-comment"></i> نظرات
                                            <span class="text-primary">
                                                {{ $query->comments->count() }}
                                            </span>
                                        </a>
                                    </li>
                                    {{--<li class="box-tabs-tab">
                                        <a data-toggle="tab" href="#questions" role="tab" aria-expanded="false">
                                            <i class="now-ui-icons ui-2_settings-90"></i> پرسش و پاسخ
                                        </a>
                                    </li>--}}
                                </ul>
                                <div class="card-body default">
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="desc" role="tabpanel" aria-expanded="true">
                                            <article>
                                                <h2 class="param-title">
                                                    نقد و بررسی تخصصی
                                                    <span>{{ $query->title }}</span>
                                                </h2>
                                                <div class="parent-expert default">
                                                    <div class="content-expert">
                                                        <p>
                                                            {!! \App\Helper\Helper::last_text_article(\App\Helper\Helper::Nofollow($query->long_text)) !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        @if($query->faqs->count())
                                        <div class="tab-pane" id="faq" role="tabpanel" aria-expanded="false">
                                            <section>
                                                <div class="row justify-content-center">
                                                    <div class="col-12 px-1">
                                                        <div id="accordion">
                                                            @foreach($query->faqs as $valf)
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
                                            </section>
                                        </div>
                                        @endif
                                        <div class="tab-pane params" id="params" role="tabpanel" aria-expanded="false">
                                            <article>
                                                <h2 class="param-title">
                                                    مشخصات فنی
                                                    <span>{{ $query->title }}</span>
                                                </h2>
                                                <section>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            @if($query->detail->count())
                                                                @foreach($query->detail as $dvalue)
                                                                    @if($dvalue->title != 'ویدئو')
                                                                        <h3 class="params-title">{{ $dvalue->title }}</h3>
                                                                        @if($dvalue->structed->count())
                                                                            <ul class="params-list">
                                                                                @foreach($dvalue->structed as $svalue)
                                                                                    <li>
                                                                                        <div class="params-list-key">
                                                                                            <span class="block">{{ $svalue->title }}</span>
                                                                                        </div>
                                                                                        <div class="params-list-value">
                                                                                            <span class="block">
                                                                                                {{ $svalue->text }}
                                                                                            </span>
                                                                                        </div>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6">
                                                            @if($query->detail->count())
                                                                @foreach($query->detail as $dvalue)
                                                                    @if($dvalue->title == 'ویدئو')
                                                                        <h3 class="params-title">{{ $dvalue->title }}</h3>
                                                                        @if($dvalue->structed->count())
                                                                            @foreach($dvalue->structed as $svalue)
                                                                                <div class="col-md-12 py-1">
                                                                                    {!! $svalue->text !!}
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>


                                                </section>

                                            </article>
                                        </div>
                                        <div class="tab-pane" id="comments" role="tabpanel" aria-expanded="false">
                                            <article>
                                                @guest
                                                    <p>
                                                        برای ثبت نظر وارد
                                                        <a class="text-danger" href="{{ url('login') }}">
                                                            <u>
                                                                 حساب کاربری
                                                            </u>
                                                        </a>
                                                        خود شوید
                                                    </p>
                                                @else
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
                                                    <form method="post" action="{{ route('Comment.store') }}">
                                                        @csrf
                                                        <input type="hidden" value="{{ $query->id }}" name="product_id">
                                                        <input type="hidden" value="0" name="parent_id" id="parent_id">
                                                        <div class="form-group col-md-6 col-lg-6 col-12">
                                                            <label for="title">عنوان: </label>
                                                            <input name="title" id="title" required autocomplete="off"
                                                                   class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}">
                                                            @if ($errors->has('title'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('title') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-md-12 col-lg-12 col-12">
                                                            <label for="text">توضیحات: </label>
                                                            <textarea class="form-control" name="text" id="text"
                                                                      rows="3" placeholder="نظر خود را وارد نمایید"
                                                                      required></textarea>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 form-group text-left">
                                                                <input type="submit" class=" btn btn-outline-primary ml-3" value="ثبت نظر">
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endguest

                                                <h2 class="param-title mb-0">
                                                    نظرات کاربران
                                                    <span>
                                                        {{ $query->comments->count() }}
                                                        نظر
                                                    </span>
                                                </h2>
                                                <div class="comments-area default">
                                                    <ol class="comment-list list-group pr-0">
                                                        @if($query->comments->count())
                                                            @foreach($query->comments->where('parent',0) as $value)
                                                                <li class="list-group-item pb-0">
                                                                    <div class="comment-body mt-0 pt-0">
                                                                        <div class="comment-author">
                                                                            <cite class="fn">{{ $value->user->full_name }} : </cite>
                                                                            <span class="says">{{ $value->title }}</span> </div>
                                                                        <div class="commentmetadata text-primary">{{ new Verta($value->updated_at) }}</div>
                                                                        <p>{!! \App\Helper\Helper::last_text_article(\App\Helper\Helper::Nofollow($value->text)) !!}</p>
                                                                        @guest
                                                                            <div class="reply">
                                                                                برای ثبت پاسخ باید وارد
                                                                                <a href="{{ url('login') }}">
                                                                                    <u>
                                                                                        حساب کاربری
                                                                                    </u>
                                                                                </a>
                                                                                خود شود
                                                                            </div>
                                                                        @else
                                                                            <div class="reply">
                                                                                <a href="#" data-toggle="modal" data-target="#myModal_comment"
                                                                                   onclick="commentID('{{$value->id}}');" class="comment-reply-link">
                                                                                    پاسخ
                                                                                </a>
                                                                            </div>
                                                                        @endguest
                                                                    </div>
                                                                    @if($value->child->count())
                                                                        @include('visitor.product.commet_temp',['child' => $value->child])
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ol>
                                                </div>
                                            </article>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" id="myModal_comment">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header ">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body text-right pt-1">
                            <form id="answer" method="post" action="{{ route('Comment.store') }}">
                                @csrf
                                <input type="hidden" value="{{ $query->id }}" name="product_id">
                                <input type="hidden" value="0" name="parent_id" id="parent_id">
                                <div class="form-group col-md-12 col-lg-12 col-12">
                                    <label for="text">متن: </label>
                                    <textarea class="form-control" name="text" id="text"
                                              rows="3" placeholder="پاسخ خود را وارد نمایید"
                                              required></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-12 form-group text-left">
                                        <input type="submit" class=" btn btn-outline-primary ml-3" value="ارسال">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @if(count($query_similar))
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="widget widget-product card">
                            <header class="card-header">
                                <h3 class="card-title">
                                    <span>محصولات مرتبط</span>
                                </h3>
                            </header>
                            <div class="similar-product owl-carousel owl-theme">
                                @foreach($query_similar as $pronew)
                                    @if($pronew->price_type==1)
                                        <div class="item">
                                            <a title="{{ $pronew->title }}"
                                               href="{{ route('product.show',$pronew->id.'-'.Illuminate\Support\Str::slug($pronew->title_en)) }}">
                                                <img src="{{ \App\Helper\Helper::getImage($pronew->picfirst) }}"
                                                     class="img-fluid" alt="{{ \App\Helper\Helper::getImageAlt($pronew->picfirst) }}"
                                                     title="{{ \App\Helper\Helper::getImageAlt($pronew->picfirst) }}">
                                            </a>
                                            <h2 class="post-title font-14">
                                                <a title="{{ $pronew->title }}"
                                                   href="{{ route('product.show',$pronew->id.'-'.Illuminate\Support\Str::slug($pronew->title_en)) }}">
                                                    {{ $pronew->title }}
                                                </a>
                                            </h2>
                                            <div class="price">
                                            <span>
                                                {{ \App\Helper\Helper::number_latin_to_persian(number_format($pronew->price)) }}
                                                <span>
                                                    تومان
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                    @elseif($pronew->price_type==2)
                                        <div class="item">
                                            <a title="{{ $pronew->title }}"
                                               href="{{ route('product.show',$pronew->id.'-'.Illuminate\Support\Str::slug($pronew->title_en)) }}">
                                                <img src="{{ \App\Helper\Helper::getImage($pronew->picfirst) }}"
                                                     class="img-fluid" alt="{{ \App\Helper\Helper::getImageAlt($pronew->picfirst) }}"
                                                     title="{{ \App\Helper\Helper::getImageAlt($pronew->picfirst) }}">
                                            </a>
                                            <h2 class="post-title font-14">
                                                <a title="{{ $pronew->title }}"
                                                   href="{{ route('product.show',$pronew->id.'-'.Illuminate\Support\Str::slug($pronew->title_en)) }}">
                                                    {{ $pronew->title }}
                                                </a>
                                            </h2>
                                            <div class="price">
                                                <del>
                                                <span>
                                                    {{ \App\Helper\Helper::number_latin_to_persian(number_format($pronew->price)) }}
                                                    <span>
                                                        تومان
                                                    </span>
                                                </span>
                                                </del>
                                                <ins>
                                                <span>
                                                    {{ number_format($pronew->price - ($pronew->price*($pronew->price_percent/100))) }}
                                                    <span>
                                                        تومان
                                                    </span>
                                                </span>
                                                </ins>
                                            </div>
                                        </div>
                                    @elseif($pronew->price_type==3)
                                        <div class="item">
                                            <a title="{{ $pronew->title }}"
                                               href="{{ route('product.show',$pronew->id.'-'.Illuminate\Support\Str::slug($pronew->title_en)) }}">
                                                <img src="{{ \App\Helper\Helper::getImage($pronew->picfirst) }}"
                                                     class="img-fluid" alt="{{ \App\Helper\Helper::getImageAlt($pronew->picfirst) }}"
                                                     title="{{ \App\Helper\Helper::getImageAlt($pronew->picfirst) }}">
                                            </a>
                                            <h2 class="post-title font-14">
                                                <a title="{{ $pronew->title }}"
                                                   href="{{ route('product.show',$pronew->id.'-'.Illuminate\Support\Str::slug($pronew->title_en)) }}">
                                                    {{ $pronew->title }}
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
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @include('temp.sticky_dropdown_button')
    </main>
    <!-- main -->
@endsection
@section('js')
    <script>
        /*function price_product(event) {
            console.log(event.options[event.selectedIndex].dataset.price);
        }*/
       /* function color_product(val) {
            //$('#color option:selected').val();
            //console.log(val);
            var x=[];
            $('#tr'+val+' select#entity').find('option').each(function() {
                //alert($(this).val());
                x.push($(this).val());
            });
            for(var i=0 ; i < x.length ; i++)
            {
                console.log(x[i]);
                $('#tr'+val+' select#entity').append('<option >'+x[i]+'</option>');
            }

            //console.log(x);
        }*/
        function price_product() {
            var x=0;
            $('select#entity').find('option:selected').each(function() {
                if($(this).attr('data-price') != '')
                {
                    x+=parseInt($(this).attr('data-price'));
                }
            });
            //console.log(x);
            //x=MyNumberAsString.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            $('.price-value span:first').text(x.toLocaleString());
        }

    </script>
@endsection
