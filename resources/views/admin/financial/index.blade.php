@extends('layouts.app_admin')

@section('content')
    @php \Hekmatinasser\Verta\Verta::setStringFormat('%d %B') @endphp
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">گزارش گیری براساس بازه زمانی
                        <a href="{{ url('/Admin') }}" class="pull-left text-white"> برگشت
                            <i class="fa fa-arrow-left"></i>
                        </a>
                    </div>
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
                        <form method="get" enctype="multipart/form-data" action="{{ route('Financial.index') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="start_date" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        از تاریخ
                                    </label>
                                    <div class="col-md-9">
                                        <input id="start_date" type="text"  required autocomplete="off"
                                               class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                               value="{{ old('start_date') }}">
                                        @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="end_date" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        تا تاریخ
                                    </label>
                                    <div class="col-md-9">
                                        <input id="end_date" type="text" required autocomplete="off"
                                               class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                               value="{{ old('end_date') }}">
                                        @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="status" class="col-md-3 col-form-label">خرید</label>

                                    <div class="col-md-9">
                                        <select class="form-control" id="status" name="status">
                                            <option selected value="1">موفق</option>
                                            <option  value="0">ناموفق</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between">
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary w-100">
                                                گزارش
                                            </button>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-6">

                                </div>

                            </div>

                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="widget style1 navy-bg">
                                    <div class="row vertical-align d-flex align-items-center">
                                        <div class="col-7 font-bold">
                                            فروش ناخالص
                                        </div>
                                        <div class="col-4 text-left align-items-center px-0">
                                            <span class="font-bold">
                                                {{ number_format($query_price_all - $query_returned) }}
                                                تومان
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="widget style1 lazur-bg">
                                    <div class="row vertical-align d-flex align-items-center">
                                        <div class="col-7 font-bold">
                                            فروش خالص
                                        </div>
                                        <div class="col-4 text-left align-items-center px-0">
                                            <span class="font-bold">
                                                {{ number_format($query_price_all - $query_price_send - $query_returned) }}
                                                تومان
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="widget style1 red-bg">
                                    <div class="row vertical-align d-flex align-items-center">
                                        <div class="col-7 font-bold">
                                            هزینه ارسال
                                        </div>
                                        <div class="col-4 text-left align-items-center px-0">
                                            <span class="font-bold">
                                                {{ number_format($query_price_send) }}
                                                تومان
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-dark text-white">{{ $title }}
                        <a href="{{ url('/Admin') }}" class="pull-left text-white"> برگشت
                            <i class="fa fa-arrow-left"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-success">گزارش جدولی
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>تاریخ</th>
                                    <th>جمع فروش</th>
                                    <th>جمع هزینه ارسال</th>
                                    <th>فروش خالص</th>
                                    <th>تعداد فاکتور</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr class="gradeX">
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">
                                            <a href="{{ route('Financial.show',str_replace('/','-',$item['time']))}}" target="_blank">
                                                {{ new Verta($item['time']) }}
                                            </a>
                                        </td>
                                        <td class="align-middle">{{ $item['all'] - $item['returned'] }}</td>
                                        <td class="align-middle">{{ $item['send'] }}</td>
                                        <td class="align-middle">{{ $item['all'] - $item['send'] - $item['returned']}}</td>
                                        <td class="align-middle">{{ $item['count'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{ asset('admincssjs/js/Chart.min.js') }}"></script>
    <script>
        $('document').ready(function () {
            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        @foreach($data as $value)
                            '{{ new \Hekmatinasser\Verta\Verta($value['time']) }}',
                        @endforeach
                    ],
                    datasets: [
                        {
                            label: 'مبلغ',
                            backgroundColor:'#b2ffad',
                            borderColor: '#1e4505',
                            data: [
                                @foreach($data as $value)
                                {{ $value['all'] - $value['returned'] }},
                                @endforeach
                            ],
                            borderWidth: 2,
                        },
                        {
                            label: 'تعداد فاکتور',
                            fill: false,
                            backgroundColor:'#3769ff',
                            borderColor: '#0a3bd0',
                            data: [
                                @foreach($data as $value)
                                {{ $value['count'] }},
                                @endforeach
                            ],
                        }
                    ]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'گزارش مالی'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'تاریخ'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'تعداد و مبلغ فاکتور'
                            }
                        }]
                    }
                }
            });
        });

        $("#end_date , #start_date").persianDatepicker({
            formatDate: "YYYY-0M-0D",
            showGregorianDate: true
        });
    </script>
@endsection
