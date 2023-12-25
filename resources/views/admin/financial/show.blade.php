@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>شناسه محصول</th>
                                    <th>محصول</th>
                                    <th>قیمت تمام شده</th>
                                    <th>تعداد</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($query as $item)
                                    @if($item->product->count())
                                        @foreach($item->product as $value)
                                            <tr class="gradeX data{{ $item->id }}">
                                                <td class="align-middle">{{ $value->id }}</td>
                                                <td class="align-middle">
                                                    <a target="_blank" href="{{ route('product.show',$value->product_id) }}">
                                                        {{ $value->product_id }}
                                                    </a>
                                                </td>
                                                <td class="align-middle">{{ $value->product_details->title }}</td>
                                                <td class="align-middle">
                                                    @if($value->price_type == 1)
                                                        {{ number_format($value->price) }}
                                                    @else
                                                        {{ number_format(($value->price - ($value->price * ($value->price_percent/100))) * $value->count) }}
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    {{ $value->count }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
