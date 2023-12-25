<div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-4 col-5 align-items-center pl-0 text-center">
            <a href="{{ url('/') }}" class="text-center" title="{{ config('app.name', 'Laravel') }}">
                <img title="{{ config('app.name', 'Laravel') }}"
                           class="img-fluid lazy logo-head" data-src="{{ asset('img/logo.png') }}"
                           alt="{{ config('app.name', 'Laravel') }}">

            </a>
        </div>
        <div class="col-lg-6 col-md-5 col-sm-8 col-7 pr-0">
            <div class="search-area default">
                <form action="{{ url('/search') }}" class="search">
                    {{--<input type="text" name="q" required placeholder="نام کالای مورد نظر خود را جستجو کنید…">
                    <button type="submit" class="text-white font-18">
                        <i class="fa fa-search"></i>
                    </button>--}}
                    <div class="ui category search text-right">
                        <div class="ui icon input w-100">
                            <input class="prompt" type="text"
                                   name="q" required
                                   placeholder="نام کالای مورد نظر خود را جستجو کنید…">
                            <button type="submit" class="text-white font-18">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <div class="results text-right"></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="user-login dropdown">
                @guest
                    <a href="#" class="btn btn-neutral dropdown-toggle" data-toggle="dropdown"
                       id="navbarDropdownMenuLink1">
                        ورود / ثبت نام
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                        <div class="dropdown-item">
                            <a href="{{ route('login') }}" class="register">ورود به فروشگاه</a>
                        </div>
                        <div class="dropdown-item font-weight-bold">
                            <span>کاربر جدید هستید؟</span> <a class="register" href="{{ route('register') }}">ثبت‌ نام</a>
                        </div>
                    </ul>
                @else
                    <a href="#" class="btn btn-neutral dropdown-toggle" data-toggle="dropdown"
                       id="navbarDropdownMenuLink1">
                        {{ Auth::user()->name == '' ? Auth::user()->mobile :  Auth::user()->name.' '.Auth::user()->family }}

                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                        <div class="dropdown-item">
                            <a href="{{ url('profile') }}">
                                <span>
                                    مشاهده حساب کاربری
                                </span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="{{ url('favorite') }}">
                                <span>
                                   علاقه مندی ها
                                </span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="{{ url('order') }}">
                                <span>
                                    سفارشات
                                </span>
                            </a>
                        </div>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            <span>
                                خروج
                            </span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"  class="d-none">
                            @csrf
                        </form>
                    </ul>
                @endguest

            </div>

            <div class="cart dropdown">
                <a href="{{ url('cart') }}" class="btn bg-white text-dark font-18" {{--data-toggle="dropdown" id="navbarDropdownMenuLink1"--}}>
                    @if(session('basket_entity') > 0)
                        <span class="badge badge-danger bg-danger text-white">
                            {{ session('basket_entity') }}
                        </span>
                    @endif
                    <i class="now-ui-icons shopping_cart-simple"></i>
                </a>
               {{-- <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                    <div class="basket-header">
                        <div class="basket-total">
                            <span>مبلغ کل خرید:</span>
                            <span> ۲۳,۵۰۰</span>
                            <span> تومان</span>
                        </div>
                        <a href="#" class="basket-link">
                            <span>مشاهده سبد خرید</span>
                            <div class="basket-arrow"></div>
                        </a>
                    </div>
                    <ul class="basket-list">
                        <li>
                            <a href="#" class="basket-item">
                                <button class="basket-item-remove"></button>
                                <div class="basket-item-content">
                                    <div class="basket-item-image">
                                        <img alt="" src="{{ asset('img/cart/2324935.jpg') }}">
                                    </div>
                                    <div class="basket-item-details">
                                        <div class="basket-item-title">هندزفری بلوتوث مدل S530
                                        </div>
                                        <div class="basket-item-params">
                                            <div class="basket-item-props">
                                                <span> ۱ عدد</span>
                                                <span>رنگ مشکی</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <a href="#" class="basket-submit">ورود و ثبت سفارش</a>
                </ul>--}}
            </div>
        </div>
    </div>
</div>
