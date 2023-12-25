@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('/Admin') }}" class="pull-left text-white"> برگشت
                            <i class="fa fa-arrow-left"></i>
                        </a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>ای پی ثبت کننده</th>
                                    <th>سیستم عامل ثبت کنند</th>
                                    <th>قیمت پیشنهادی</th>
                                    <th>محصول مورد نظر</th>
                                    <th>آدرس سایت </th>
                                    <th>تاریخ ثبت</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($query as $item)
                                    <tr class="gradeX data{{ $item->id }}">
                                        <td class="align-middle">{{ $item->id }}</td>
                                        <td class="align-middle">{{ $item->ip }}</td>
                                        <td class="align-middle">{{ $item->os }}</td>
                                        <td class="align-middle">{{ number_format($item->price_observed) }}</td>
                                        <td class="align-middle">{{ $item->product->title }}</td>
                                        <td class="align-middle">{{ $item->url_address }}</td>
                                        <td class="align-middle">{{ $item->created_at }}</td>

                                        <td class="align-middle">
                                            @if($item->status==0)
                                                <span class="badge badge-danger p-2">در انتظار</span>
                                            @elseif($item->status==1)
                                                <span class="badge badge-primary p-2">تایید شده</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">

                                            @can(\App\Helper\Helper::getTypePermission('delete'))
                                            <button title="حذف" href="#" class="btn btn-danger btn-sm" id="del{{ $item->id }}" data-url="{{ route('ProductOfferAdmin.destroy',$item->id) }}" onclick="del({{ $item->id }});">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endcan

                                            @if($item->status==0)
                                                <a title="تایید" href="{{ route('ProductOfferAdmin.show' , $item->id) }}" class="btn btn-outline-success btn-sm">
                                                    <i class="fa fa-check-square"></i>
                                                </a>
                                            @endif

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
    </div>
@endsection
