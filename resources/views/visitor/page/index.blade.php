@extends('layouts.app')

@section('img-seo')
    <meta property="og:url" content="{{ urldecode(url()->current()) }}"/>
@endsection
@section('content')
    <!-- main -->
    <main class="search-page  default">
        <div class="container">
            <div class="row">
                <div class="col-12">
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
                                    <a property="item" typeof="WebPage" title="{{ $query->title }}"
                                       href="{{ url('PageKia/'.Illuminate\Support\Str::slug($query->title_en)) }}">
                                        <span property="name">{{ $query->title }}</span>
                                    </a>
                                    <meta property="position" content="2">
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="card mt-3 mb-0">
                        <div class="card-body">
                            {!! \App\Helper\Helper::last_text_article(\App\Helper\Helper::Nofollow($query->text)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- main -->
@endsection
