<!-- responsive-header -->
<nav class="navbar direction-ltr fixed-top header-responsive">
    <div class="container">
        <div class="navbar-translate">
            <a title="{{ config('app.name', 'Laravel') }}" class="navbar-brand" href="{{ url('/') }}">
                <img data-src="{{ asset('img/logo.png') }}" class="lazy img-fluid nav-mobile-img"
                     alt="{{ config('app.name', 'Laravel') }}" title="{{ config('app.name', 'Laravel') }}">
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target="#navigation" aria-controls="navigation-index" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
            <div class="search-nav default">
                <form action="{{ url('/search') }}" class="search">
                    <input data-toggle="modal" data-target="#exampleModalLong"
                           type="text" name="q" required placeholder="جستجو ...">
                    <button type="submit" class="text-white bg-red">
                        <i class="fa fa-search"></i>
                    </button>
                    {{--<div class="ui category search text-right h-100">
                        <div class="ui icon input w-100 h-100">
                            <input class="prompt mobile-search-box" type="text"
                                   name="q" required
                                   placeholder="نام کالای مورد نظر خود را جستجو کنید…">
                            <button type="submit" class="text-white font-18">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <div class="results text-right"></div>
                    </div>--}}
                </form>
                <ul>
                    <li><a href="{{ url('profile') }}"><i class="now-ui-icons users_single-02"></i></a></li>
                    <li><a href="{{ url('cart') }}"><i class="now-ui-icons shopping_basket"></i></a></li>
                </ul>
            </div>
        </div>

        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <div class="logo-nav-res default text-center">
                <a href="{{ url('/') }}" title="{{ config('app.name', 'Laravel') }}">
                    <img data-src="{{ asset('img/logo.png') }}" class="lazy img-fluid nav-mobile-img"
                         alt="{{ config('app.name', 'Laravel') }}" title="{{ config('app.name', 'Laravel') }}">
                </a>
            </div>
            <ul class="navbar-nav default">
                @foreach(\App\Category::where('parent',1)->active()->menu()->with('childern')->orderBy('sort')->get() as $value)
                    @if($value->childern()->count())
                        <li class="sub-menu">
                            <a href="{{ url(Illuminate\Support\Str::slug($value->title_en)) }}" title="{{ $value->title }}">{{ $value->title }}</a>
                                @include('temp.mobile_menu_cat',['child' => $value->childern,'parent' => $value])
                        </li>
                    @else
                        <li>
                            <a title="{{ $value->title }}" href="{{ url(Illuminate\Support\Str::slug($value->title_en)) }}">{{ $value->title }}</a>
                        </li>
                    @endif
                @endforeach

            </ul>
        </div>
    </div>
</nav>
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-search-height">
            <div class="modal-header d-flex align-content-end">
                <button type="button" class="close m-0 modal-header-botton" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body h-100">
                <div class="search-nav default">
                    <form action="{{ url('/search') }}" class="search">
                        <div class="ui category search text-right h-100">
                            <div class="ui icon input w-100 h-100">
                                <input class="prompt mobile-search-box" type="text"
                                       name="q" required
                                       placeholder="نام کالای مورد نظر خود را جستجو کنید…">
                                <button type="submit" class="text-white font-18 bg-red">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                            <div class="results text-right"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- responsive-header -->
