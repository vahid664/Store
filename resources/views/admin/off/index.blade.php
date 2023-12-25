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
                        @can(\App\Helper\Helper::getTypePermission('create'))
                        <a target="_blank" href="{{ url('Admin/Code/create') }}" class="pull-left btn btn-primary margin-top-n-4 text-white ml-4 px-3 mt-0 pt-1 pb-0">
                            <i class="fa fa-plus"></i>
                            افزودن
                        </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>عنوان</th>
                                    <th>کد</th>
                                    <th>تعداد</th>
                                    <th>استفاده شده</th>
                                    <th>نوع تخفیف</th>
                                    <th>هزینه/درصد</th>
                                    <th>تاریخ شروع/پایان</th>
                                    <th>وضعیت</th>
                                    <th>ثبت کننده</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($query as $item)
                                    <tr class="gradeX data{{ $item->id }}">
                                        <td class="align-middle">{{ $item->id }}</td>
                                        <td class="align-middle">{{ $item->title }}</td>
                                        <td class="align-middle">{{ $item->code }}</td>
                                        <td class="align-middle">{{ $item->count }}</td>
                                        <td class="align-middle">{{ $item->count_use }}</td>
                                        <td class="align-middle">
                                            @if($item->type_off==1)
                                                <span class="badge badge-success p-2">نقدی</span>
                                            @elseif($item->type_off==2)
                                                <span class="badge badge-primary p-2">درصدی</span>
                                            @elseif($item->type_off==3)
                                                <span class="badge badge-warning p-2">درصد بر فاکتور</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            {{ $item->price }} / {{ $item->price_percent }} / {{ $item->price_factor }}
                                        </td>
                                        <td class="align-middle">{{ $item->date_start != '' ? new Verta($item->date_start) : ''}}
                                            / {{ $item->date_end != '' ? new Verta($item->date_end) : '' }}</td>
                                        <td class="align-middle">
                                            @if($item->status==0)
                                                <span class="badge badge-danger p-2">مخفی</span>
                                            @elseif($item->status==1)
                                                <span class="badge badge-primary p-2">فعال</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ $item->user->name }} {{ $item->user->family }}</td>
                                        <td class="align-middle">
                                            @can(\App\Helper\Helper::getTypePermission('delete'))
                                            <button title="حذف" href="#" class="btn btn-danger btn-sm" id="del{{ $item->id }}" data-url="{{ url('Admin/Code/'.$item->id) }}" onclick="del({{ $item->id }});">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endcan
                                            @can(\App\Helper\Helper::getTypePermission('edit'))
                                            <a title="ویرایش" href="{{ url('Admin/Code/'.$item->id.'/edit') }}" class="btn btn-outline-success btn-sm">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            @endcan
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
