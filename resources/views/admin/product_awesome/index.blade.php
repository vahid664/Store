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
                        <a target="_blank" href="{{ url('Admin/ProductAwesome/create') }}" class="pull-left btn btn-primary margin-top-n-4 text-white ml-4 px-3 mt-0 pt-1 pb-0">
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
                                    <th>ردیف</th>
                                    <th>عنوان</th>
                                    <th>محصول</th>
                                    <th>زمان نمایش</th>
                                    <th>پایان نمایش</th>
                                    <th>درصد تخفیف</th>
                                    <th>قیمت</th>
                                    {{--<th>موجودی</th>--}}
                                    <th>ثبت کننده</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($query as $item)
                                    @if($item->product != null)
                                    <tr class="gradeX data{{ $item->id }}">
                                        <td class="align-middle">{{ $item->id }}</td>
                                        <td class="align-middle">{{ $item->title }}</td>
                                        <td class="align-middle">{{ $item->product->title }}</td>
                                        <td class="align-middle">{{ $item->date_start != '' ? new Verta($item->date_start) : '' }}</td>
                                        <td class="align-middle">{{ $item->date_end != '' ? new Verta($item->date_end) : '' }}</td>
                                        <td class="align-middle">{{ $item->price_percent }}</td>
                                        <td class="align-middle">{{ $item->price }}</td>
                                        {{--<td class="align-middle">{{ $item->entity }}</td>--}}
                                       {{-- <td class="align-middle">{{ new Verta($item->updated_at) }}</td>--}}
                                        <td class="align-middle">{{ $item->user->name }} {{ $item->user->family }}</td>
                                        <td class="align-middle">
                                            @can(\App\Helper\Helper::getTypePermission('delete'))
                                            <button title="حذف" href="#" class="btn btn-danger btn-sm" id="del{{ $item->id }}" data-url="{{ url('Admin/ProductAwesome/'.$item->id) }}" onclick="del({{ $item->id }});">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endcan
                                            @can(\App\Helper\Helper::getTypePermission('edit'))
                                            <a title="ویرایش" href="{{ url('Admin/ProductAwesome/'.$item->id.'/edit') }}" class="btn btn-outline-success btn-sm">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            @endcan
                                        </td>
                                    </tr>
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
