@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card section-print">
                    <div class="card-body px-1">
                        <div class="col-12 d-flex align-items-center justify-content-between">
                            <h6>
                                اطلاعات سفارش
                            </h6>
                            <div>
                                <img style="max-height: 50px" src="{{ asset('img/logo.png') }}">
                            </div>
                            <h6>
                                فروشگاه قالی خانه
                            </h6>
                        </div>
                        <div class="row">
                            <div class="col-5 text-right pt-3 my-3"></div>
                            <div class="col-7 text-right pt-3 my-3 font-16">
                                <p class="text-right">
                                <span class="font-weight-bold">
                                    آدرس فرستنده :
                                </span>
                                    تهران، خیابان مطهری، خیابان لارستان، کوچه حسینی راد، پلاک 9 واحد 2
                                </p>
                                <p>
                                    تلفن :
                                    88943913
                                </p>
                            </div>
                        </div>

                        @if($query)
                        @php
                            $address=explode('|',$query->description);
                        @endphp
                        <div class="col-12 text-right mb-5 font-16">
                            <p class="text-right mb-0">
                                 <span class="font-weight-bold">
                                    آدرس گیرنده :
                                </span>
                            </p>
                            <div class="row">
                                <div class="col-lg-12 col-xs-12">
                                    آدرس :
                                    {{ $address[0] }}،
                                    {{ $address[1] }}
                                    -
                                    {{ $address[2] }}
                                </div>
                               {{-- <div class="col-lg-8 col-xs-8">
                                    آدرس :
                                    {{ $address[2] }}
                                </div>--}}
                                <div class="col-lg-12 col-xs-12">
                                    کدپستی :
                                    {{ $address[5] }}
                                </div>
                                <div class="col-lg-12 col-xs-12">
                                    نام :
                                    {{ $address[4] }}
                                </div>


                                <div class="col-lg-12 col-xs-12">
                                    تلفن :
                                    {{ $address[3] }}
                                </div>

                            </div>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">کد کالا</th>
                                    <th scope="col">عنوان محصول</th>
                                    <th scope="col">قیمت واحد</th>
                                    {{--<th scope="col">واحد</th>--}}
                                    <th scope="col">تخفیف</th>
                                    <th scope="col">سایز</th>
                                    <th scope="col">رنگ بندی</th>
                                    <th scope="col">تعداد</th>
                                    <th scope="col">مجموع (تومان)</th>
                                </tr>
                                </thead>
                                <tbody class="text-right">
                                @if($query)
                                    @foreach($query->product as $value)
                                        <tr>
                                            <th class="align-middle" scope="row">
                                                <a target="_blank" href="{{route('product.show',$value->product_id)}}">
                                                    000{{ $value->product_id }}
                                                </a>
                                            </th>
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
                                                {{ $value->size }}
                                            </td>
                                            <td class="align-middle">
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
                                    @if($query->gift != null)
                                        @if($query->gift->gift != null)
                                            @if($query->gift->gift->product != null)
                                                <tr>
                                                    <th class="align-middle" scope="row">
                                                        <a target="_blank" href="{{route('product.show',$query->gift->gift->product->id)}}">
                                                            000{{ $query->gift->gift->product->id }}
                                                        </a>
                                                    </th>
                                                    <td class="align-middle">
                                                        {{ $query->gift->gift->product->title }}
                                                    </td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>1</td>
                                                    <td class="text-danger">هدیه</td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endif
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
{{--                                                {{ $query->off->cunt }}--}}
                                            </td>
                                            <td >{{ number_format( (($query->price*100)/(100-$query->off->price_percent)-$query->price) ) }}</td>

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
                            @if($query)
                                <table class="table">
                                    <tbody class="text-right">
                                    <tr>
                                        <th class="align-middle" scope="row">سفارش</th>
                                        <td class="align-middle">
                                            کد سفارش:
                                            000{{ $query->id }} -
                                            تاریخ ثبت سفارش :
                                            {{ new \Hekmatinasser\Verta\Verta($query->created_at) }}
                                        </td>
                                    </tr>
                                   {{-- @php
                                    $address=explode('-',$query->description);
                                    @endphp--}}
                                    <tr>
                                        <th class="align-middle" scope="row">نام و نام خانوادگی</th>
                                        <td class="align-middle">
                                            {{ $address[4] }}
                                        </td>
                                    </tr>
                                   {{-- <tr>
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
                                    </tr>--}}
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
                                        <th class="align-middle" scope="row">کد پیگیری درگاه پرداخت</th>
                                        <td class="align-middle">
                                            {{ $query->trans_id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle" scope="row">نوع ارسال</th>
                                        <td class="align-middle">
                                            @php \Hekmatinasser\Verta\Verta::setStringFormat('%d %B') @endphp

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
                                    @if($query->comment != '')
                                    <tr>
                                        <th class="align-middle" scope="row">توضیحات هنگام خرید</th>
                                        <td class="align-middle text-justify" style="max-width: 700px;">
                                            {{ $query->comment }}
                                        </td>
                                    </tr>
                                    @endif
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
                            @endif
                        </div>
                        <div class="row mx-2 mt-3 border py-3 text-right">
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
                <div class="card">
                    <div class="card-body  min-height">
                        <button class="btn btn-sm btn-success" onclick="print_post()">
                            چاپ فاکتور
                            <i class="fa fa-print"></i>
                        </button>
                        <a href="{{ url('Admin/Factor') }}" class="btn btn-sm btn-info">بازگشت</a>
                    </div>
                </div>
                @if($query->peyk == null)
                    <div class="card">
                        <div class="card-body">
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
                            <p>
                                ثبت کد پیگیری پست
                            </p>
                                <form method="post" action="{{ route('Factor.update',$query->id) }}">
                                    @csrf
                                    @method('PUT')
                                <div class="row">
                                    <div class="col-md-8 form-group">
                                        <label for="post_tracking" class="col-md-3 col-form-label">
                                            <i class="fa fa-star text-danger"></i>
                                            کد رهگیری پست
                                        </label>
                                        <div class="col-md-9">
                                            <input id="post_tracking" type="text" required autocomplete="off"
                                                   class="form-control @error('post_tracking') is-invalid @enderror"
                                                   name="post_tracking"
                                                   value="{{ old('post_tracking') }}">
                                            @error('post_tracking')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            ثبت
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
                <div class="card mt-3">
                    <div class="card-body">
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
                        <p>
                            ثبت مرجوعی کالا
                        </p>
                        @foreach($query->product as $value)
                            <form method="post" action="{{ route('ProductReturned.store') }}">
                                @csrf
                                <input type="hidden" name="factor_id" value="{{ $query->id }}">
                                <div class="row py-2">
                                    <div class="col-md-10 form-group">
                                        <div class="col-md-7">
                                            <input type="hidden" name="product_id" value="{{ $value->product_id }}">
                                            <input type="text" class="form-control" name="name" disabled value="{{ $value->product_details->title }}">
                                        </div>
                                        <div class="col-md-5 d-flex align-items-center">
                                            قیمت
                                            {{$value->count}}
                                            محصول
                                            @if($value->price_type == 2)
                                                <input id="price" type="number" required autocomplete="off"
                                                       class="form-control @error('price') is-invalid @enderror"
                                                       name="price"
                                                       value="{{ ($value->price - ($value->price * ($value->price_percent/100))) * $value->count }}">
                                            @else
                                                <input id="price" type="number" required autocomplete="off"
                                                       class="form-control @error('price') is-invalid @enderror"
                                                       name="price"
                                                       value="{{ $value->price * $value->count }}">
                                            @endif
                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">
                                            ثبت
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endforeach

                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">محصول</th>
                                <th scope="col">قیمت</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\FactorProductReturned::where('factor_id',$query->id)->orderByDesc('id')->get() as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->product->title.'/'.$item->product->title_en }}</td>
                                    <td>{{ number_format($item->price) }} تومن </td>
                                    <td>
                                        @if($item->status == 1)
                                            <span class="badge badge-primary">تایید شده</span>
                                        @else
                                            <span class="badge badge-warning">در انتظار</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('Admin/ProductReturned/destroy/'.$item->id) }}">
                                            <span class="fa fa-2x fa-trash text-danger"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
