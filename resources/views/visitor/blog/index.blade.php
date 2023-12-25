@extends('layouts.app')
@section('img-seo')
    <meta property="og:url" content="{{ urldecode(url()->current()) }}"/>
@endsection
@section('meta-next-prev')
    @if($query->nextPageUrl() != null)
        <link rel="next" href="{{ urldecode($query->nextPageUrl()) }}">
    @endif
    @if($query->previousPageUrl() != null)
        <link rel="prev" href="{{ urldecode($query->previousPageUrl()) }}">
    @endif
@endsection
@section('content')
    <!-- main -->
    <main class="search-page default">
        <div class="container">
            <div class="row">
                <div class="breadcrumb-section default bg-white px-lg-4 mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb-list " vocab="https://schema.org/" typeof="BreadcrumbList">
                            <li class="breadcrumb-item" property="itemListElement" typeof="ListItem">
                                <a property="item" typeof="WebPage" href="{{ url('/') }}" title="قالی خانه">
                                    <span property="name">قالی خانه</span>

                                </a>
                                <meta property="position" content="1">
                            </li>
                            <li class="breadcrumb-item" property="itemListElement" typeof="ListItem">
                                <a property="item" typeof="WebPage" title="وبلاگ"
                                   href="{{ route('Blog.index') }}">
                                    <span property="name">وبلاگ</span>
                                </a>
                                <meta property="position" content="2">
                            </li>
                        </ol>
                    </nav>
                </div>
                @foreach($query as $item)
                    <a href="{{ route('Blog.show',$item->id.'-'.str_replace(' ','-',$item->title_en)) }}"
                       class="col-md-4 col-lg-3 mb-2" title="{{ $item->title }}">
                        <div class="card align-items-center">
                            <div class="d-flex align-items-center justify-content-center img-size-swiper bg-gradient">

                            <img class="card-img-top lazy"
                                 title="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}"
                                 data-src="{{ \App\Helper\Helper::getImage($item->picfirst) }}"
                                 alt="{{ \App\Helper\Helper::getImageAlt($item->picfirst) }}">

                            </div>

                            <div class="card-body py-2 px-1 min-height">
                                <p class="card-text text-right font-14 d-flex align-items-center cat-card-min-height">
                                    {{$item->title}}
                                </p>
                            </div>
                            <div class="card-footer px-1 bg-white font-14 w-100 d-flex align-items-center justify-content-between">
                                @if($item->user != null)
                                <span>
                                    <span class="fa fa-user-circle-o color-site-text-blue pr-1 pl-1"></span>
                                    <span class="font-12">
                                        نویسنده :
                                        {{ $item->user->name }} {{ $item->user->family }}
                                    </span>
                                </span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    {{ $query->links() }}
                </div>
            </div>

        </div>
    </main>
    <!-- main -->
@endsection
