@extends('layouts.app')

@section('content')



{{--    @php   --}}
{{--        if (session("SendPrice")){--}}
{{--            session()->pull('PricePerson');--}}
{{--        }--}}
{{--         @endphp--}}


    <!-- main -->
    <main class="cart-page default">
        <div class="container">
            <div class="row">
                <div class="card col-xl-9 col-lg-8 col-md-12 mt-5">
                    <div class="card-title pt-3 pb-0">
                        <h5>نوع ارسال سفارش</h5>
                    </div>
                    {{--<div class="card-body px-1">
                        @if(Auth::user()->address_first != null)
                            <p>
                                <span class="fa fa-location-arrow"></span>
                                {{ Auth::user()->address_first->province }}
                                -
                                {{ Auth::user()->address_first->city }}،
                                {{ Auth::user()->address_first->address }}
                            </p>
                        @endif
                    </div>--}}
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
                        <form method="post" action="{{ route('SendType.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="title" class="col-md-12">
                                        <i class="fa fa-star text-danger"></i>
                                        نوع ارسال مرسوله خود را انتخاب کنید
                                    </label>

                                    <div class="col-md-8">
                                        @if(Auth::user()->address_first->city == 'تهران' || Auth::user()->address_first->city == 'ساوه')
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="type" value="1" onclick="TypeSend(1);" required>
                                                    <span>
                                                        پیک
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="type" value="3" onclick="TypeSend(3);" required>
                                                <span>
                                                    باربری (تحویل بین یک تا سه روز کاری)
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="type" value="4" onclick="TypeSend(4);" required>
                                                <span>
                                                تی باکس
                                            </span>
                                            </label>
                                        </div>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div id="payment" class="col-md-12 form-group d-none">

                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="type_payment" value="1" onclick="TypePrice(1);">
                                            <span>
                                                       پرداخت به صورت آنلاین
                                            </span>
                                        </label>
                                    </div>
                                    <br>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="type_payment" value="2" onclick="TypePrice(2);" >
                                            <span>
                                                        پرداخت در محل برای خریدهای بالای 2 ملیون تومان (10 درصد از کل پرداختی باید به صورت آنلاین پرداخت شود)
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                @if(Auth::user()->address_first->city == 'تهران' || Auth::user()->address_first->city == 'ساوه')
                                    <div id="post" class="col-md-12 form-group d-none">
                                        <ul class="nav nav-pills mb-4 mt-2" id="myTab" role="tablist">
                                            @php \Hekmatinasser\Verta\Verta::setStringFormat('%d %B') @endphp
                                            @foreach($date as $value)
                                                @if($loop->first)
                                                    <li class="nav-item col-4 col-lg-2 d-flex justify-content-center align-items-center">
                                                        <a class="nav-link active p-0" id="{{ $value->id }}-tab" data-toggle="tab"
                                                           href="#tab{{ $value->id }}" role="tab" aria-controls="{{ $value->id }}"
                                                           aria-selected="true">
                                                            {{ new Verta($value->date) }}
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class="nav-item col-4 col-lg-2 d-flex justify-content-center align-items-center">
                                                        <a class="nav-link p-0" id="{{ $value->id }}-tab" data-toggle="tab"
                                                           href="#tab{{ $value->id }}" role="tab" aria-controls="{{ $value->id }}"
                                                           aria-selected="false">
                                                            {{ new Verta($value->date) }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="tab-content px-lg-4" id="myTabContent">
                                            @foreach($date as $value)
                                                @if($loop->first)
                                                    <div class="tab-pane fade show active" id="tab{{ $value->id }}"
                                                         role="tabpanel" aria-labelledby="{{ $value->id }}-tab">
                                                        @foreach(\App\Peyk::where('date',$value->date)->where('count','>',0)->orderBy('sort')->get() as $item)
                                                            @if($item->date == \Carbon\Carbon::now()->format('Y/m/d'))
                                                                @if($item->time_start > \Carbon\Carbon::now()->format('H'))
                                                                    <div class="form-check py-1">
                                                                        <label class="form-check-label border-bottom">
                                                                            <input type="radio" class="form-check-input" name="time"
                                                                                   value="{{ $item->id }}">
                                                                            <span class="mr-4">
                                                                            {{ $item->time_start }} تا {{ $item->time_end }}
                                                                            </span>
                                                                            <span class="mr-4">
                                                                            {{ number_format($item->price) }}
                                                                                تومان
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <div class="form-check py-1">
                                                                    <label class="form-check-label border-bottom">
                                                                        <input type="radio" class="form-check-input" name="time"
                                                                               value="{{ $item->id }}">
                                                                        <span class="mr-4">
                                                                            {{ $item->time_start }} تا {{ $item->time_end }}
                                                                        </span>
                                                                        <span class="mr-4">
                                                                            {{ number_format($item->price) }}
                                                                                تومان
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="tab-pane fade" id="tab{{ $value->id }}" role="tabpanel"
                                                         aria-labelledby="{{ $value->id }}-tab">
                                                        @foreach(\App\Peyk::where('date',$value->date)->where('count','>',0)->orderByDesc('id')->orderBy('sort')->get() as $item)
                                                            <div class="form-check py-1">
                                                                <label class="form-check-label border-bottom">
                                                                    <input type="radio" class="form-check-input" name="time"
                                                                           value="{{ $item->id }}">
                                                                    <span class="mr-4">
                                                                        {{ $item->time_start }} تا {{ $item->time_end }}
                                                                    </span>
                                                                    <span class="mr-4">
                                                                        {{ number_format($item->price) }}
                                                                            تومان
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                @endif
                               {{-- <div class="col-lg-6 col-8">
                                    <input type="text" name="code" class="form-control" required
                                           placeholder="افزودن کد تخفیف">
                                </div>--}}
                                <div class="col-lg-12 col-12 mt-2">
                                    <input type="submit" class="btn btn-primary my-0" value="ثبت">
                                </div>
                            </div>
                        </form>
                    </div>
                    <p>
                        *
                        هزینه ارسال باربری با توجه به سایز ، وزن ، وشهر مقصد بین 20،000 الی 70،000 تومان  می باشد.
                    </p>

                    @if(Auth::user()->address_first->city == 'تهران' || Auth::user()->address_first->city == 'ساوه')
                        <p>
                            *
                            هزینه ارسال پیک برای سفارشات بالای 2،000،000 تومان رایگان میباشد.
                        </p>
                    @endif
                    @if(count($gift))
                        <p>
                            *
                            هدیه به انتخاب شما
                        </p>
                        @if(session('gift'))
                            <p>
                                هدیه انتخابی شما
                                <span class="text-danger">"{{ session('gift')->product->title }}"</span>
                                ثبت شد.
                            </p>
                        @endif
                        <div class="gift owl-carousel owl-theme my-3">
                            @foreach($gift as $value)
                                @if(session('gift'))
                                    @if($value->product != null && ($value->count > $value->count_use) && session('gift')->id != $value->id)
                                        <div class="item card my-2">
                                            <a title="{{ $value->title != '' ? $value->title : $value->product->title }}"
                                               href="{{ route('GiftUser.show',$value->id) }}">
                                                <div class="d-flex align-items-center justify-content-center img-size-swiper bg-gradient">
                                                    <img src="{{ \App\Helper\Helper::getImage($value->product->picfirst) }}"
                                                         class="img-fluid" alt="{{ \App\Helper\Helper::getImageAlt($value->product->picfirst) }}"
                                                         title="{{ \App\Helper\Helper::getImageAlt($value->product->picfirst) }}">
                                                </div>
                                            </a>
                                            <h4 class="post-title font-14 px-1">
                                                <a title="{{ $value->title != '' ? $value->title : $value->product->title }}"
                                                   href="{{ route('GiftUser.show',$value->id) }}">
                                                    {{ $value->title != '' ? $value->title : $value->product->title }}
                                                </a>
                                            </h4>
                                        </div>
                                    @endif
                                @else
                                    @if($value->product != null && ($value->count > $value->count_use))
                                        <div class="item card my-2">
                                            <a title="{{ $value->title != '' ? $value->title : $value->product->title }}"
                                               href="{{ route('GiftUser.show',$value->id) }}">
                                                <div class="d-flex align-items-center justify-content-center img-size-swiper bg-gradient">
                                                    <img src="{{ \App\Helper\Helper::getImage($value->product->picfirst) }}"
                                                         class="img-fluid" alt="{{ \App\Helper\Helper::getImageAlt($value->product->picfirst) }}"
                                                         title="{{ \App\Helper\Helper::getImageAlt($value->product->picfirst) }}">
                                                </div>
                                            </a>
                                            <h4 class="post-title font-14 px-1">
                                                <a title="{{ $value->title != '' ? $value->title : $value->product->title }}"
                                                   href="{{ route('GiftUser.show',$value->id) }}">
                                                    {{ $value->title != '' ? $value->title : $value->product->title }}
                                                </a>
                                            </h4>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <p>
                        *
                        هزینه ارسال تیپاکس با توجه به سایز ، وزن ، وشهر مقصد بین 30،000 الی 200،000 تومان  می باشد.
                    </p>
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
                                    @if(session('PricePerson'))
                                        <li>
                                        <span>مبلغ  پرداخت آنلاین</span>
                                            <span>
                                             {{ number_format(session('basket_price')*0.1) }}
                                            تومان</span>
                                        </li>
                                    @endif

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
                                        @if(session('PricePerson') && session('off'))
                                            @if(session('off')->type_off == 1)
                                                <del>
                                                     <span class="price-product price-discount-color">
                                                        {{ number_format(session('basket_price')+\App\Helper\Helper::PriceSend()) }}
                                                    </span>
                                                </del>
                                                <br>
                                                <span class="checkout-summary-price-value-amount">
                                                    {{ number_format((\App\Helper\Helper::PriceSend() +(session('basket_price')- session('off')->price))*0.1) }}
                                                 </span>تومان
                                            @else
                                                <del>
                                                     <span class="price-product price-discount-color">
                                                        {{ number_format(session('basket_price')+\App\Helper\Helper::PriceSend()) }}
                                                    </span>
                                                </del>
                                                <br>
                                                <span class="checkout-summary-price-value-amount">
                                                    {{ number_format((\App\Helper\Helper::PriceSend() +(session('basket_price')- (session('basket_price')*(session('off')->price_percent/100))))*0.1) }}
                                                 </span>تومان
                                            @endif
{{--                                            {{ number_format( session('basket_price')*0.1) }}--}}
                                        @elseif(session('off'))
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
{{--                                        @elseif(session('PrisPerson') )--}}
{{--                                            {{ number_format( session('PrisPerson')+\App\Helper\Helper::PriceSend()) }}--}}
                                        @elseif(session('PricePerson'))
                                            {{ number_format((session('basket_price')+\App\Helper\Helper::PriceSend())*0.1) }}
                                        @else
                                            {{ number_format(session('basket_price')+\App\Helper\Helper::PriceSend()) }}
                                        @endif
                                    </div>


{{--                                    <div id="Price" class="d-none" >--}}
{{--                                        <div class="checkout-summary-price-title">میزان پرداختی آنلاین:</div>--}}
{{--                                        <div class="checkout-summary-price-value">--}}
{{--                                                {{ number_format( session('basket_price')*0.1+\App\Helper\Helper::PriceSend()) }}--}}

{{--                                        </div>--}}


{{--                                    </div>--}}


                                    @if(session('SendPrice') || session('SendPrice') ===0)
                                        <form method="post" action="{{ url('buy/paymant') }}">
                                            @csrf
                                            <div class="col-12 align-items-center text-center px-0">
                                                <button type="submit"
                                                        class="selenium-next-step-shipping dk-btn dk-btn-info">
                                                    پرداخت
                                                    <i class="now-ui-icons shopping_basket"></i>
                                                </button>
                                                 <div class="col-12 pt-3 px-0">
                                                     <label class="label">
                                                         <i class="fa fa-pencil"></i>
                                                         توضیحات سفارش
                                                     </label>
                                                     <textarea name="comment" id="comment" minlength="2" maxlength="400"
                                                               class="form-control font-12 border border-danger rounded"
                                                               placeholder="اگر پیشنهادی در مورد نحوه ی ارسال یا سفارش خود دارید در این قسمت بنویسید"
                                                     ></textarea>
                                                 </div>
                                            </div>
                                        </form>
                                    @else
                                       <div class="alert alert-info font-14 text-justify">
                                           نوع ارسال سفارش را انتخاب کنید
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
@section('js')
    <script>
        function TypeSend(a) {
            if(a==1)
            {
                $('#post').removeClass('d-none');
            }
            else{
                $('#post').addClass('d-none');
            }

            if(a==4)
            {
                $('#payment').removeClass('d-none');

            }
            else {
                $('#payment').addClass('d-none');

            }
        }
        function TypePrice(b){
            if(b==2)
            {
                $('#Price').removeClass('d-none');
            }
            else{
                $('#Price').addClass('d-none');
            }
        }
    </script>
@endsection
