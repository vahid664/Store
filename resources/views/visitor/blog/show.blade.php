@extends('layouts.app')

@section('img-seo')
    <meta property="og:url" content="{{ urldecode(url()->current()) }}"/>
    <meta property="article:section" content="{{ $query->category->title }}" />
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
@section('meta-next-prev')
    @if(isset($query->af) && $query->af->count())
        <link rel="next" href="{{ urldecode(route('Blog.show',$query->af->id.'-'.
                    Str::slug($query->af->title_en))) }}">
    @endif
    @if(isset($query->bef) && $query->bef->count())
        <link rel="prev" href="{{ urldecode(route('Blog.show',$query->bef->id.'-'.
                    Str::slug($query->bef->title_en) )) }}">
    @endif
@endsection
@section('json-ld')
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "NewsArticle",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ route('Blog.index') }}"
      },
      "headline": "{{ str_replace('\\',' ',$query->title) }}",
      @if(isset($query->picfirst->id))
            "image": [
               "{{ asset($query->picfirst->link) }}"
       ],
       @else
            "image": [
               "{{ asset('img/logo.jpg') }}"
       ],
       @endif
        "datePublished": "{{ $query->created_at }}",
      "dateModified": "{{ $query->updated_at }}",
      "author": {
        "@type": "Person",
        "name": "{{ $query->User->name }} {{ $query->User->family }}"
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

@section('content')
    <!-- main -->
    <main class="search-page default">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-12">
                    <div class="card mt-3 mb-0 py-2 px-4">
                        <div class="card-body">
                            <div class="col-12 px-0">
                                <div class="breadcrumb-section mb-3">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb-list font-12" vocab="https://schema.org/" typeof="BreadcrumbList">
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
                                            <li class="breadcrumb-item" property="itemListElement" typeof="ListItem">
                                                <a property="item" typeof="WebPage" title="{{ $query->title }}"
                                                   href="{{ route('Blog.show',$query->id.'-'.\Illuminate\Support\Str::slug($query->title_en)) }}">
                                                    <span property="name">{{  $query->title }}</span>
                                                </a>
                                                <meta property="position" content="3">
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                            <hr>

                            <h1 class="size-h1">
                                {{ $query->title }}
                            </h1>
                            <div class="col-12 d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="fa fa-user"></span>
                                    {{ $query->user->full_name }}
                                </div>
                                <div>
                                    <span class="fa fa-calendar"></span>
                                    {{ New \Hekmatinasser\Verta\Verta($query->created_at) }}
                                </div>
                                <div>
                                    <span>زمان مورد نیاز برای مطالعه : </span>
                                    {{$query->period }}
                                    دقیقه
                                </div>
                            </div>
                            @if($query->picfirst != null)
                            <div class="col-12 text-center px-0">
                                <img class="lazy" data-src="{{ asset($query->picfirst->link) }}"
                                     title="{{ $query->picfirst->title }}" alt="{{ $query->picfirst->title }}">
                            </div>
                            @else
                                <p>&nbsp;</p>
                            @endif
                            <div class="blog-text">
                                {!! \App\Helper\Helper::last_text_article(\App\Helper\Helper::Nofollow($query->long_text)) !!}
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="card mt-3 mb-0 py-3 px-2 sticky-top">
                        <div class="card-title text-center">
                            مطالب مرتبط
                            <hr>
                        </div>
                        <div class="card-body py-0">
                            <ul class="list-group">
                                @foreach($similar as $value)
                                    @if($value->article != null)
                                        @if ($loop->first)
                                            <a href="{{ route('Blog.show',$value->article->id.'-'.str_replace(' ','-',$value->article->title_en)) }}"
                                               title="{{ $value->article->title }}" class="list-group-item border-bottom">
                                                {{ $value->article->title }}
                                                <p class="mb-0 text-left text-black-50 mt-3">
                                                    <span class="fa fa-calendar"></span>
                                                    {{ New \Hekmatinasser\Verta\Verta($query->created_at) }}
                                                </p>
                                            </a>
                                        @else
                                            <a href="{{ route('Blog.show',$value->article->id.'-'.str_replace(' ','-',$value->article->title_en)) }}"
                                               title="{{ $value->article->title }}" class="list-group-item border-bottom border-top">
                                                {{ $value->article->title }}
                                                <p class="mb-0 text-left text-black-50 mt-3">
                                                    <span class="fa fa-calendar"></span>
                                                    {{ New \Hekmatinasser\Verta\Verta($query->created_at) }}
                                                </p>
                                            </a>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- main -->
@endsection
