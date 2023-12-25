<section id="amazing-slider" class="carousel slide carousel-fade card" data-ride="carousel">
    <div class="row m-0">
        <ol class="carousel-indicators pr-0 d-flex flex-column col-lg-3">
            @foreach($product_awesome as $value)
                @if($value->product != null)
                    @php
                        $end=Carbon\Carbon::create($value->date_end_explode[0],$value->date_end_explode[1],$value->date_end_explode[2],$value->hour_end,0,0);
                    @endphp
                    @if($end > Carbon\Carbon::now()->format('Y-m-d H:00:00'))
                        @if($loop->first)
                            <li class="active" data-target="#amazing-slider" data-slide-to="{{ $loop->index }}">
                                <span>{{ $value->title }}</span>
                            </li>
                        @else
                            <li data-target="#amazing-slider" data-slide-to="{{ $loop->index }}" class="">
                                <span>{{ $value->title }}</span>
                            </li>
                        @endif
                    @endif
                @endif
            @endforeach
            <li class="view-all">
                <a href="{{ url('incredible-offers') }}" class="btn btn-primary btn-block hvr-sweep-to-left">
                    <i class="fa fa-arrow-left"></i>مشاهده همه شگفت انگیزها
                </a>
            </li>
        </ol>
        <div class="carousel-inner p-0 col-12 col-lg-9">
            <img class="amazing-title lazy" data-src="{{ asset('img/amazing-title-01.png') }}"
                 alt="پیشنهادات شگفت انگیز">
            @foreach($product_awesome as $item)
                @if($item->product != null)
                    @php
                        $end=Carbon\Carbon::create($item->date_end_explode[0],$item->date_end_explode[1],$item->date_end_explode[2],$item->hour_end,0,0);
                    @endphp
                    @if($end > Carbon\Carbon::now()->format('Y-m-d H:00:00'))
                    @php
                        $end=explode(' ',$end);
                        $end_date=explode('-',$end[0]);
                        $end_hour=\Illuminate\Support\Arr::first(explode(':',$end[1]));
                    @endphp
                    @if($loop->first)
                        <div class="carousel-item active {{ $item->entity <= 0 ? 'finished' : '' }}">
                            <div class="row m-0">
                                <div class="right-col col-5 d-flex align-items-center">
                                    <a class="w-100 text-center" href="{{ route('product.show',$item->product->id.'-'.Illuminate\Support\Str::slug($item->product->title_en)) }}">
                                        <img data-src="{{ asset($item->product->picfirst->link) }}"
                                             class="img-fluid lazy"
                                             title="{{ $item->product->picfirst->title }}"
                                             alt="{{ $item->product->picfirst->title }}">
                                    </a>
                                </div>
                                <div class="left-col col-7">
                                    <div class="price">
                                        <del><span>{{ \App\Helper\Helper::number_latin_to_persian(number_format($item->price)) }}<span>تومان</span></span></del>
                                        <ins><span>{{ number_format($item->price - ($item->price*($item->price_percent/100))) }}<span>تومان</span></span></ins>
                                        <span class="discount-percent">{{ $item->price_percent }} % تخفیف</span>
                                    </div>
                                    <h2 class="product-title">
                                        <a href="{{ route('product.show',$item->product->id.'-'.Illuminate\Support\Str::slug($item->product->title_en)) }}"> {{ $item->product->title }} </a>
                                    </h2>
                                    <ul class="list-group">
                                       {{-- @if($item->product->color->count())
                                            <li class="list-group-item">رنگ :
                                                @foreach($item->product->color as $value)
                                                    - {{ $value->title }}
                                                @endforeach
                                            </li>
                                        @endif--}}
                                        <li class="list-group-item">
                                            برند :
                                            {{ $item->product->brands->title }}
                                        </li>
                                    </ul>
                                    @if($item->entity<=0)
                                        <a href="{{ route('product.show',$item->product->id.'-'.Illuminate\Support\Str::slug($item->product->title_en)) }}" class="finished btn mt-3"> تمام شد </a>
                                    @else
                                        <hr>
                                        <div class="countdown-timer" countdown data-date="{{ $end_date[1] }}
                                        {{$end_date[2] }} {{ $end_date[0] }} {{ $end_hour }}:00:00">
                                            <span data-days>0</span>:
                                            <span data-hours>0</span>:
                                            <span data-minutes>0</span>:
                                            <span data-seconds>0</span>
                                        </div>
                                        <div class="timer-title">زمان باقی مانده تا پایان سفارش</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="carousel-item {{ $item->entity <= 0 ? 'finished' : '' }}">
                            <div class="row m-0">
                                <div class="right-col col-5 d-flex align-items-center">
                                    <a class="w-100 text-center" href="{{ route('product.show',$item->product->id.'-'.Illuminate\Support\Str::slug($item->product->title_en)) }}">
                                        <img data-src="{{ asset($item->product->picfirst->link) }}"
                                             class="img-fluid lazy"
                                             title="{{ $item->product->picfirst->title }}"
                                             alt="{{ $item->product->picfirst->title }}">
                                    </a>
                                </div>
                                <div class="left-col col-7">
                                    <div class="price">
                                        <del><span>{{ \App\Helper\Helper::number_latin_to_persian(number_format($item->price)) }}<span>تومان</span></span></del>
                                        <ins><span>{{ number_format($item->price - ($item->price*($item->price_percent/100))) }}<span>تومان</span></span></ins>
                                        <span class="discount-percent">{{ $item->price_percent }} % تخفیف</span>
                                    </div>
                                    <h2 class="product-title">
                                        <a href="{{ route('product.show',$item->product->id.'-'.Illuminate\Support\Str::slug($item->product->title_en)) }}"> {{ $item->product->title }} </a>
                                    </h2>
                                    <ul class="list-group">
                                        {{--@if($item->product->color->count())
                                            <li class="list-group-item">رنگ :
                                                @foreach($item->product->color as $value)
                                                    - {{ $value->title }}
                                                @endforeach
                                            </li>
                                        @endif--}}
                                        <li class="list-group-item">
                                            برند :
                                            {{ $item->product->brands->title }}
                                        </li>
                                    </ul>
                                    @if($item->entity<=0)
                                        <a href="{{ route('product.show',$item->product->id.'-'.Illuminate\Support\Str::slug($item->product->title_en)) }}" class="finished btn mt-3"> تمام شد </a>
                                    @else
                                        <hr>
                                        <div class="countdown-timer" countdown data-date="{{ $end_date[1] }}
                                        {{$end_date[2] }} {{ $end_date[0] }} {{ $end_hour }}:00:00">
                                            <span data-days>0</span>:
                                            <span data-hours>0</span>:
                                            <span data-minutes>0</span>:
                                            <span data-seconds>0</span>
                                        </div>
                                        <div class="timer-title">زمان باقی مانده تا پایان سفارش</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    @endif
                @endif
            @endforeach
        </div>
    </div>
</section>
<div class="row" id="amazing-slider-responsive">
    <div class="col-12">
        <div class="widget widget-product card pt-0">
            <header class="card-header">
                <img class="lazy" data-src="{{ asset('img/amazing-title-01.png') }}" width="150px" alt="">
                <a href="{{ url('incredible-offers') }}" class="view-all">مشاهده همه</a>
            </header>
            <div class="product-carousel owl-carousel owl-theme">
                @foreach($product_awesome as $item)
                    @if($item->product != null)
                        @php
                            $end=Carbon\Carbon::create($item->date_end_explode[0],$item->date_end_explode[1],$item->date_end_explode[2],$item->hour_end,0,0);
                        @endphp
                        @if($end > Carbon\Carbon::now()->format('Y-m-d H:00:00'))
                            <div class="item">
                                <a href="{{ route('product.show',$item->product->id.'-'.Illuminate\Support\Str::slug($item->product->title_en)) }}">
                                    <img data-src="{{ asset($item->product->picfirst->link) }}"
                                         class="img-fluid lazy"
                                         title="{{ $item->product->picfirst->title }}"
                                         alt="{{ $item->product->picfirst->title }}">
                                </a>
                                <h2 class="post-title">
                                    <a href="{{ route('product.show',$item->product->id.'-'.Illuminate\Support\Str::slug($item->product->title_en)) }}">
                                        {{ $item->product->title }}
                                    </a>
                                </h2>
                                <div class="price">
                                    <del><span>{{ \App\Helper\Helper::number_latin_to_persian(number_format($item->price)) }}<span>تومان</span></span></del>
                                    <ins><span>{{ number_format($item->price - ($item->price*($item->price_percent/100))) }}<span>تومان</span></span></ins>
                                </div>
                                @php
                                    $end=explode(' ',$end);
                                    $end_date=explode('-',$end[0]);
                                    $end_hour=\Illuminate\Support\Arr::first(explode(':',$end[1]));
                                @endphp
                                @if($item->entity==0)
                                    <a href="{{ route('product.show',$item->product->id.'-'.Illuminate\Support\Str::slug($item->product->title_en)) }}" class="finished btn"> تمام شد </a>
                                @else
                                <hr>
                                <div class="countdown-timer" countdown data-date="{{ $end_date[1] }}
                                {{$end_date[2] }} {{ $end_date[0] }} {{ $end_hour }}:00:00">
                                    <span data-days>0</span>:
                                    <span data-hours>0</span>:
                                    <span data-minutes>0</span>:
                                    <span data-seconds>0</span>
                                </div>
                                @endif
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
