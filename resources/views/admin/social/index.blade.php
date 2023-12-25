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
                        <a target="_blank" href="{{ url('Admin/Social/create') }}" class="pull-left btn btn-primary margin-top-n-4 text-white ml-4 px-3 mt-0 pt-1 pb-0">
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
                                    <th>تصویر</th>
                                    <th>توضیحات</th>
                                    <th>نوع</th>
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
                                        <td class="align-middle">
                                            @if($item->pic != '')
                                                <a target="_blank" href="{{ asset($item->pic) }}">
                                                    <i class="fa fa-image"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            {!! Illuminate\Support\Str::limit($item->text,100) !!}
                                        </td>
                                        <td class="align-middle">
                                            @if($item->status==0)
                                                <span class="badge badge-danger p-2">مخفی</span>
                                            @elseif($item->status==1)
                                                <span class="badge badge-primary p-2">فعال</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @switch($item->type)
                                                @case(1)
                                                <span class="badge badge-info p-2">آدرس</span>
                                                @break
                                                @case(2)
                                                <span class="badge badge-info p-2">موبایل</span>
                                                @break
                                                @case(3)
                                                <span class="badge badge-info p-2">تلفن</span>
                                                @break
                                                @case(4)
                                                <span class="badge badge-info p-2">تلگرام</span>
                                                @break
                                                @case(5)
                                                <span class="badge badge-info p-2">اینستاگرام</span>
                                                @break
                                                @case(6)
                                                <span class="badge badge-info p-2">فیسبوک</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="align-middle">{{ $item->user->name }} {{ $item->user->family }}</td>
                                        <td class="align-middle">
                                            @can(\App\Helper\Helper::getTypePermission('delete'))
                                            <button title="حذف" href="#" class="btn btn-danger btn-sm" id="del{{ $item->id }}" data-url="{{ url('Admin/Social/'.$item->id) }}" onclick="del({{ $item->id }});">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endcan
                                            @can(\App\Helper\Helper::getTypePermission('edit'))
                                            <a title="ویرایش" href="{{ url('Admin/Social/'.$item->id.'/edit') }}" class="btn btn-outline-success btn-sm">
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
