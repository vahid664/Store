@extends('layouts.app')

@section('content')
    <main class="profile-user-page default">
        <div class="container">
            <div class="row">
                <div class="profile-page bg-white col-xl-9 col-lg-8 col-md-12 order-2 mt-2">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active py-1 px-3" id="home-tab"
                               href="{{ url('order?view=on-delivery') }}"
                               role="tab" aria-controls="home" aria-selected="true">
                                درحال پردازش
                                <span class="badge badge-info">
                                    {{ count($query->where('status',1)->where('delivery',0)) }}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  py-1 px-3" id="profile-tab"
                               href="{{ url('order?view=delivered') }}"
                               role="tab" aria-controls="profile" aria-selected="false">
                                ارسال شده
                                <span class="badge badge-success">
                                    {{ count($query->where('status',1)->where('delivery',1)) }}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-1 px-3" id="contact-tab"
                               href="{{ url('order?view=unsuccessful') }}"
                               role="tab" aria-controls="contact" aria-selected="false">
                                پرداخت ناموفق
                                <span class="badge badge-danger">
                                    {{ count($query->where('status',0)) }}
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active p-2"
                             id="home" role="tabpanel" aria-labelledby="home-tab">
                            @foreach($query->where('status',1)->where('delivery',0) as $value)
                                <div class="card border rounded mb-1">
                                    <div class="card-body min-height">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                {{ new \Hekmatinasser\Verta\Verta($value->created_at) }}
                                                -
                                                000{{ $value->id }}
                                                -
                                                درحال پردازش
                                            </div>
                                            <a class="text-info" href="{{ route('order.show',$value->id) }}">
                                                مشاهده سفارش
                                                <span class="fa fa-angle-left"></span>
                                            </a>
                                        </div>
                                        <p class="mb-0 pt-3">
                                            مبلغ کل :
                                            {{ $value->price }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                    </div>
                </div>
                @include('user.temp.sidebar')
            </div>
        </div>
    </main>
@endsection
