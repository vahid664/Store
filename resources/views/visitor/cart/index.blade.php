@extends('layouts.app')

@section('content')
    <!-- main -->
    <main class="cart-page default">
        <div class="container">
            <div class="row">
                <div class="cart-page-content col-xl-9 col-lg-8 col-md-12 order-1">
                    <div class="cart-page-title">
                        <h1>سبد خرید</h1>
                    </div>
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
                    <div class="table-responsive checkout-content default">
                        <table class="table">
                            <tbody>
                            @foreach(session('basket') as $key => $item)
                                <tr class="checkout-item">
                                    <td class="img-size-tr-basket">
                                        <img src="{{ $item['pic'] != null ? asset($item['pic']) : asset('img/default.png') }}">
                                    </td>
                                    <td>
                                        <h3 class="checkout-title">
                                            {{ $item['title'] }} - {{ $item['size'] }}
                                        </h3>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm direction-ltr border rounded" role="group" aria-label="Basic example">
                                            <a href="{{ url('cart_delete/'.$key) }}" class="text-dark bg-white btn border-0 my-0">-</a>
                                            <button type="button" class="text-dark bg-white btn my-0">{{ $item['quantity'] }}</button>
                                            <a href="{{ route('cart.show',$key) }}" class="text-dark bg-white btn border-0 my-0">+</a>
                                        </div>
                                    </td>
                                    <td>
                                        @if($item['price_type'] == 1)
                                            {{ \App\Helper\Helper::number_latin_to_persian(number_format($item['price'] * $item['quantity'])) }}
                                        @elseif($item['price_type'] == 2)
                                            {{ number_format(($item['price'] - ($item['price']*($item['price_percent']/100))) * $item['quantity']) }}
                                        @endif
                                        تومان
                                    </td>
                                    <td>
                                        <a href="{{ url('cart/delete/'.$key) }}">
                                            <span class="fa fa-2x fa-trash text-danger"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <aside class="cart-page-aside col-xl-3 col-lg-4 col-md-6 center-section order-2">
                    <div class="checkout-aside">
                        <div class="checkout-summary">
                            <div class="checkout-summary-main">
                                <ul class="checkout-summary-summary">
                                    <li>
                                        <span>مبلغ کل (
                                            {{ session('basket_entity') }}
                                            کالا)</span>
                                        <span>
                                             {{ number_format(session('basket_price')) }}
                                            تومان</span>
                                    </li>
                                    <li>
                                        <span>هزینه ارسال</span>
                                        <span>وابسته به آدرس<span class="wiki wiki-holder"><span
                                                    class="wiki-sign"></span>
                                                    <div class="wiki-container js-dk-wiki is-right">
                                                        <div class="wiki-arrow"></div>
                                                        <p class="wiki-text">
                                                            هزینه ارسال مرسولات می‌تواند وابسته به شهر و آدرس گیرنده
                                                            متفاوت باشد. در
                                                            صورتی که هر
                                                            یک از مرسولات حداقل ارزشی برابر با ۱۰۰هزار تومان داشته باشد،
                                                            آن مرسوله
                                                            بصورت رایگان
                                                            ارسال می‌شود.<br>
                                                            "حداقل ارزش هر مرسوله برای ارسال رایگان، می تواند متغیر
                                                            باشد."
                                                        </p>
                                                    </div>
                                                </span></span>
                                    </li>
                                </ul>
                                <div class="checkout-summary-devider">
                                    <div></div>
                                </div>
                                <div class="checkout-summary-content">
                                    <div class="checkout-summary-price-title">مبلغ قابل پرداخت:</div>
                                    <div class="checkout-summary-price-value">
                                        <span class="checkout-summary-price-value-amount">
                                            {{ number_format(session('basket_price')) }}
                                        </span>تومان
                                    </div>
                                    <a href="#" class="selenium-next-step-shipping">
                                        <div class="parent-btn">
                                            <a href="{{ url('buy/info') }}" class="dk-btn dk-btn-info">
                                                ادامه ثبت سفارش
                                                <i class="now-ui-icons shopping_basket"></i>
                                            </a>
                                        </div>
                                    </a>
                                    <div>
                                            <span>
                                                کالاهای موجود در سبد شما ثبت و رزرو نشده‌اند، برای ثبت سفارش مراحل بعدی
                                                را تکمیل
                                                کنید.
                                            </span>
                                        <span class="wiki wiki-holder"><span class="wiki-sign"></span>
                                                <div class="wiki-container is-right">
                                                    <div class="wiki-arrow"></div>
                                                    <p class="wiki-text">
                                                        محصولات موجود در سبد خرید شما تنها در صورت ثبت و پرداخت سفارش
                                                        برای شما رزرو
                                                        می‌شوند. در
                                                        صورت عدم ثبت سفارش، تاپ کالا هیچگونه مسئولیتی در قبال تغییر
                                                        قیمت یا موجودی
                                                        این کالاها
                                                        ندارد.
                                                    </p>
                                                </div>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-feature-aside">
                            <ul>
                                <li class="checkout-feature-aside-item checkout-feature-aside-item-guarantee">
                                    هفت روز
                                    ضمانت تعویض
                                </li>
                              {{--  <li class="checkout-feature-aside-item checkout-feature-aside-item-cash">
                                    پرداخت در محل با
                                    کارت بانکی
                                </li>--}}
                                <li class="checkout-feature-aside-item checkout-feature-aside-item-express">
                                    تحویل اکسپرس
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>
    <!-- main -->
@endsection
@section('js')
    <script>
        function add_cart(a) {
            $.ajax({
                url:'{{ url('cart_add') }}',
                type: 'post',
                data: {
                    id: a
                },
                success: function (result) {
                   console.log(result);
                },
                error: function () {
                    swal("Error!", 'مشکلی پیش آمده است لطفا دقایقی دیگر دوباره امتحان کنید', "Problem");
                }
            });
        }
        function del_cart(a) {
            $.ajax({
                url:'{{ url('cart_delete') }}',
                type: 'post',
                data: {
                    id: a
                },
                success: function (result) {
                    console.log(result);
                },
                error: function () {
                    swal("Error!", 'مشکلی پیش آمده است لطفا دقایقی دیگر دوباره امتحان کنید', "Problem");
                }
            });
        }
    </script>
@endsection
