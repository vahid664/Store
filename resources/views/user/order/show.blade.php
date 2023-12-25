@extends('layouts.app')

@section('content')
    <main class="profile-user-page default">
        <div class="container">
            <div class="row">
                <div class="profile-page bg-white col-xl-9 col-lg-8 col-md-12 order-2 mt-2">
                    <div class="col-12 d-flex align-items-center justify-content-between pt-3">
                        <h6>
                            اطلاعات سفارش
                        </h6>
                       <a href="{{ url('order') }}" class="text-info mb-2">
                           برگشت
                           <span class="fa fa-angle-left"></span>
                       </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">کد کالا</th>
                                <th scope="col">عنوان محصول</th>
                                <th scope="col">قیمت واحد</th>
                                <th scope="col">تخفیف</th>
                                <th scope="col">سایز</th>
                                <th scope="col">رنگ بندی</th>
                                <th scope="col">تعداد</th>
                                <th scope="col">مجموع (تومان)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($query->product != null)
                                @foreach($query->product as $value)
                                    <tr>
                                        <th class="align-middle" scope="row">000{{ $value->product_id }}</th>
                                        <td class="align-middle">
                                            {{ $value->product_details->title }}
                                        </td>
                                        <td class="align-middle">
                                            {{ number_format($value->price) }}
                                        </td>
                                        <td class="align-middle">
                                            @if($value->price_type == 2)
                                                {{ $value->price_percent }} %
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            {{ $value->size }}
                                        </td>
                                        <td>
                                            {!! $value->color !!}

                                        </td>
                                        <td class="align-middle">
                                            {{ $value->count }}
                                        </td>

                                        <td class="align-middle">
                                            @if($value->price_type == 2)
                                                {{ number_format(($value->price - ($value->price * ($value->price_percent/100))) * $value->count) }}
                                            @else
                                                {{ number_format($value->price * $value->count) }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                @if($query->off != null)
                                    <tr>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                        <td>
                                            کد تخفیف اعمالی ({{ $query->off->code }})
                                        </td>

                                        <td>
                                            @if($query->off->type_off == 1)
                                                {{ number_format($query->off->price) }}
                                                تومان
                                            @else
                                                {{ $query->off->price_percent }}
                                                درصد
                                            @endif
                                        </td>
                                        <td>
                                            1
                                        </td>
                                        <td >
                                            {{ number_format( (($query->price*100)/(100-$query->off->price_percent)-$query->price) ) }}
                                        </td>

                                    </tr>
                                @endif

                                <tr>
                                    <td class="border-0"></td>
                                    <td class="border-0"></td>
                                    <td class="border-0"></td>
                                    <td class="border-0"></td>
                                    <td class="border-0"></td>
                                    <td>مجموع (با هزینه ارسال

                                        {{ number_format($query->price_send) }} تومان
                                        )</td>
                                    <td>{{ $query->product->sum('count') }}</td>
                                    <td>{{ number_format($query->price) }}</td>

                                </tr>
                                @if(($query->price_online) != ($query->price) && $query->price_online != null)
                                    <tr>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                        <td>میزان پرداختی آنلاین</td>
                                        <td>{{ $query->product->sum('count') }}</td>
                                        <td>{{ number_format($query->price_online) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                        <td>میزان پرداختی در محل</td>
                                        <td>{{ $query->product->sum('count') }}</td>
                                        <td>{{ number_format(($query->price)-($query->price_online)) }}</td>
                                    </tr>
                                @endif

                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th class="align-middle" scope="row">سفارش</th>
                                <td class="align-middle">
                                    کد سفارش:
                                    000{{ $query->id }} -
                                    تاریخ ثبت سفارش :
                                    {{ new \Hekmatinasser\Verta\Verta($query->updated_at) }}
                                </td>
                            </tr>
{{--                            @if ($query->id <= 19)--}}
{{--                                @php--}}
{{--                                    $address=explode('-',$query->description);--}}
{{--                                @endphp--}}
{{--                            @else--}}
                                @php
                                    $address=explode('|',$query->description);
                                @endphp
{{--                            @endif--}}
                            <tr>
                                <th class="align-middle" scope="row">نام و نام خانوادگی</th>
                                <td class="align-middle">
                                    {{ $address[4] }}
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle" scope="row">نشانی</th>
                                <td class="align-middle">
                                    {{ $address[0] }}،
                                    {{ $address[1] }} -
                                    {{ $address[2] }} -
                                    {{ $address[5] }}
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle" scope="row">اطلاعات تماس</th>
                                <td class="align-middle">
                                    {{ $address[3] }}
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle" scope="row">روش پرداخت</th>
                                <td class="align-middle">
                                    @if(($query->price_online) == ($query->price) || $query->price_online == null)
                                    آنلاین (درگاه پرداخت)
                                    @elseif(($query->price_online) != ($query->price))
                                        پرداخت در محل (10 درصد به صورت آنلاین پرداخت شده)
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle" scope="row">نوع ارسال </th>
                                <td class="align-middle">
                                    @if($query->send_type == 1 )
                                        پیک
                                    @elseif($query->send_type == 3)
                                        باربری
                                    @elseif($query->send_type == 4)
                                        تی باکس
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle" scope="row">کد پیگیری درگاه پرداخت</th>
                                <td class="align-middle">
                                    {{ $query->trans_id }}
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle" scope="row">هزینه حمل کالا</th>
                                @if($query->send_type == 3 || $query->send_type == 4)
                                    <td class="align-middle">
                                        هزینه ارسال به عهده مشتری
                                    </td>

                                @else
                                    <td class="align-middle">
                                        {{ number_format($query->price_send) }}
                                        تومان
                                    </td>
                                @endif
                            </tr>
                            @if($query->post_tracking != '')
                                <tr>
                                    <th class="align-middle" scope="row">کد پیگیری پست</th>
                                    <td class="align-middle">
                                        {{ $query->post_tracking }}
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                </div>
                @include('user.temp.sidebar')
            </div>
        </div>
    </main>
@endsection
