@extends('layouts.app')

@section('content')
    <!-- main -->
    <main class="cart-page default">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card col-lg-9 col-md-12 mt-5 section-print">
                    <div class="card-body px-1">
                        <div class="col-12 d-flex align-items-center justify-content-between">
                            <h6>
                                اطلاعات سفارش
                            </h6>
                            <h6>
                                قالی خانه
                            </h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">کد کالا</th>
                                    <th scope="col">عنوان محصول</th>
                                    <th scope="col">قیمت واحد</th>
                                    <th scope="col">تخفیف</th>
                                    <th scope="col">تعداد</th>
                                    <th scope="col">مجموع (تومان)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($query)
                                    @foreach($query->product as $value)
                                        <tr>
                                            <th class="align-middle" scope="row">000{{ $value->product_id }}</th>
                                            <td class="align-middle">
                                                {{ $value->product_details->title }}
                                            </td>
                                            <td class="align-middle">
                                                {{ number_format($value->price) }}
                                            </td>
                                           {{-- <td class="align-middle">
                                                {{ $value->product_details->size_first->title }}
                                            </td>--}}
                                            <td class="align-middle">
                                                @if($value->price_type == 2)
                                                    {{ $value->price_percent }} %
                                                @else
                                                    0
                                                @endif
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
                                    <tr>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                        <td class="border-0"></td>
                                        {{--<td class="border-0"></td>--}}
                                        <td>مجموع (با هزینه ارسال
                                            {{ number_format($query->price_send) }} تومان
                                            )</td>
                                        <td>{{ $query->product->sum('count') }}</td>
                                        <td>{{ number_format($query->price) }}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive mt-3">
                            @if($query)
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
                                    @if ($query->id <= 19)
                                        @php
                                            $address=explode('-',$query->description);
                                        @endphp
                                    @else
                                        @php
                                            $address=explode('|',$query->description);
                                        @endphp
                                    @endif
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
                                            آنلاین (درگاه پرداخت)
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
                                        <td class="align-middle">
                                            {{ number_format($query->price_send) }}
                                            تومان
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @endif
                        </div>
                        <div class="row mt-3 border py-3">
                            <div class="col-md-4 col-4">توضیحات:</div>
                            <div class="col-md-4 col-4">
                                <br>
                                <br>
                                امضا خریدار
                                <br>
                                <br>
                                <br>
                            </div>
                            <div class="col-md-4 col-4">
                                <br>
                                <br>
                                مهر و امضا فروشنده
                                <br>
                                <br>
                                <br>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card col-lg-9 col-md-12">
                    <div class="card-body  min-height">
                        <button class="btn btn-sm btn-success" onclick="print_post()">
                            چاپ فاکتور
                            <i class="fa fa-print"></i>
                        </button>
                        <a href="{{ url('/') }}" class="btn btn-sm btn-info">بازگشت به صفحه اصلی</a>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <!-- main -->
@endsection
@section('js')
    <script src="{{ asset('js/jQuery.print.min.js') }}" type="text/javascript"></script>
    <script>
        function print_post() {
            $('.section-print').print();
            $('.section-print').css('text-align','right');
        }
    </script>
@endsection
