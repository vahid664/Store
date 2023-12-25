@extends('layouts.app')

@section('content')
    <!-- main -->
    <main class="cart-page default">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card col-lg-9 col-md-12 mt-5 section-print">
                    <div class="card-body px-1 min-height">
                        <div class="col-12 d-flex align-items-center justify-content-between">
                            <h6>
                                اطلاعات سفارش
                            </h6>
                            <h6>
                                فروشگاه اینترنتی قالی خانه
                            </h6>
                        </div>
                        <p class="alert alert-danger col-12 mt-3">
                            {{ session('status_error') }}
                        </p>
                    </div>
                </div>
                <div class="card col-lg-9 col-md-12">
                    <div class="card-body min-height">
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
