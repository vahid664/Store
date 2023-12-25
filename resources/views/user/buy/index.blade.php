@extends('layouts.app')

@section('content')
    <!-- main -->
    <main class="cart-page default">
        <div class="container">
            <div class="row">
                <div class="card col-xl-9 col-lg-8 col-md-12 mt-5">
                    <div class="card-title py-3">
                        <h5>آدرس تحویل سفارش</h5>
                    </div>
                    <div class="card-body px-1">
                        @if(Auth::user()->address_first != null)
                            <p>
                                <span class="fa fa-location-arrow"></span>
                                {{ Auth::user()->address_first->province }}
                                -
                                {{ Auth::user()->address_first->city }}،
                                {{ Auth::user()->address_first->address }}
                            </p>
                        @else
                           {{-- <p>
                                آدرسی ثبت نشده است
                                <a class="register text-danger font-weight-bold"
                                   href="{{ url('address/create') }}">ثبت آدرس</a>
                            </p>--}}
                            <div class="col-12 text-center my-5">
                                <div class="icon-empty">
                                    <i class="fa fa-5x fa-plus-circle"></i>
                                </div>
                                <a class="register text-danger font-weight-bold"
                                   href="{{ url('address/create') }}">ثبت آدرس</a>
                            </div>
                        @endif
                        @if(Auth::user()->address_first != null)
                            <p>
                                <span class="fa fa-user"></span>
                                {{ Auth::user()->address_first->name_family }}
                            </p>
                        @endif

                        <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
                            <h6>
                                انتخاب آدرس ارسال مرسوله
                            </h6>
                            <div>
                                <a class="register font-weight-bold btn btn-sm btn-success"
                                   href="{{ url('address/create') }}">ثبت آدرس</a>
                            </div>
                        </div>

                        <div class="overflow-x">
                            <table class="table table-borderless">
                                <tbody>
                                @foreach(Auth::user()->address as $value)
                                    <tr class="{{ $value->status == 1 ? 'bg-default text-white' : '' }}">
                                        {{-- <td class="align-middle">
                                             @if($value->status == 1)
                                                 <span class="text-success fa fa-check-square">
                                                 </span>
                                             @else
                                             @endif
                                         </td>--}}
                                        <td class="align-middle min-td">
                                            {{ $value->province }} - {{ $value->city }}،
                                            {{ $value->address }}
                                        </td>
                                        <td class="align-middle">{{ $value->post_code }}</td>
                                        <td class="align-middle">{{ $value->mobile }}</td>
                                        <td class="align-middle">{{ $value->name_family }}</td>
                                        <td class="align-middle bg-white">
                                            @if($value->status == 0)
                                                <a href="{{ url('address/show/'.$value->id) }}" class="register"
                                                   title="تبدیل به آدرس پیش فرض">
                                                    <span class="fa fa-2x text-success fa-check-square"></span>
                                                </a>
                                            @endif
                                            <a href="{{ url('address/delete/'.$value->id) }}" class="register">
                                                <span class="fa fa-2x fa-trash text-danger"></span>
                                            </a>
                                            {{--  <a href="#" class="register">
                                                  <span class="fa fa-2x text-success fa-pencil-square-o"></span>
                                              </a>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="card-title mb-0">
                        <h5 class="mb-0">کد تخفیف</h5>
                    </div>
                    <div class="card-body px-1 my-0 min-height pt-1">
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
                        <form method="post" action="{{ route('Discount.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-8">
                                    <input type="text" name="code" id="code" class="form-control" required
                                           onkeyup="toEnglishNumber(this.value,'code');"
                                           placeholder="افزودن کد تخفیف">
                                </div>
                                <div class="col-lg-6 col-4">
                                    <input type="submit" class="btn btn-primary my-0" value="ثبت">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <aside class="cart-page-aside col-xl-3 col-lg-4 col-md-6 center-section order-2">
                    <div class="checkout-aside mt-lg-5 mt-1">
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
                                    @if(session('off'))
                                        <li>
                                            <span>
                                                تخفیف
                                            </span>
                                            <span>
                                                @if(session('off')->type_off == 1)
                                                    {{ number_format(session('off')->price) }}
                                                    تومان
                                                @else
                                                    {{ session('off')->price_percent }}
                                                    درصد
                                                @endif
                                            </span>
                                        </li>
                                    @endif
                                    <li>
                                        <span>هزینه ارسال</span>
                                        <span>
                                        @if(session('SendPrice'))
                                                {{ number_format(\App\Helper\Helper::PriceSend()) }}
                                                تومان
                                            @else
                                                وابسته به آدرس
                                                <span class="wiki wiki-holder">
                                                <span class="wiki-sign"></span>
                                            </span>
                                            @endif
                                            {{-- @if(Auth::user()->address_first != null)
                                                @if(Auth::user()->address_first->province == 'تهران' || Auth::user()->address_first->province == 'البرز')
                                                    {{ number_format(13000) }}
                                                    تومان
                                                @else
                                                    {{ number_format(16000) }}
                                                    تومان
                                                @endif
                                             @else
                                                وابسته به آدرس
                                                <span class="wiki wiki-holder">
                                                    <span class="wiki-sign"></span>
                                                </span>
                                             @endif--}}
                                        </span>
                                    </li>
                                </ul>
                                <div class="checkout-summary-devider">
                                    <div></div>
                                </div>
                                <div class="checkout-summary-content">
                                    <div class="checkout-summary-price-title">مبلغ قابل پرداخت:</div>
                                    <div class="checkout-summary-price-value">
                                        @if(session('off'))
                                            @if(session('off')->type_off == 1)
                                                <del>
                                                     <span class="price-product price-discount-color">
                                                        {{ number_format(session('basket_price')+\App\Helper\Helper::PriceSend()) }}
                                                    </span>
                                                </del>
                                                <br>
                                                <span class="checkout-summary-price-value-amount">
                                                    {{ number_format(\App\Helper\Helper::PriceSend() +(session('basket_price')- session('off')->price)) }}
                                                 </span>تومان
                                            @else
                                                <del>
                                                     <span class="price-product price-discount-color">
                                                        {{ number_format(session('basket_price')+\App\Helper\Helper::PriceSend()) }}
                                                    </span>
                                                </del>
                                                <br>
                                                <span class="checkout-summary-price-value-amount">
                                                    {{ number_format(\App\Helper\Helper::PriceSend() +(session('basket_price')- (session('basket_price')*(session('off')->price_percent/100)))) }}
                                                 </span>تومان
                                            @endif
                                        @else
                                            {{ number_format(session('basket_price')+\App\Helper\Helper::PriceSend()) }}
                                        @endif
                                    </div>
                                    @if(Auth::user()->address_first != null)
                                        <a href="{{ url('buy/typeSend') }}" class="selenium-next-step-shipping">
                                            <div class="parent-btn">
                                                <button class="dk-btn dk-btn-info">
                                                    ادامه فرآیند خرید
                                                    <i class="now-ui-icons shopping_basket"></i>
                                                </button>
                                            </div>
                                        </a>
                                    @else
                                       <div class="alert alert-info font-14 text-justify">
                                           آدرسی باید انتخاب شود برای ادامه عملیات خرید و پرداخت
                                       </div>
                                    @endif
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
