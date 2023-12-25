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
                        <a target="_blank" href="{{ url('Admin/Brand/create') }}" class="pull-left btn btn-primary margin-top-n-4 text-white ml-4 px-3 mt-0 pt-1 pb-0">
                            <i class="fa fa-plus"></i>
                            افزودن
                        </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>عنوان</th>
                                    <th>تصویر</th>
                                    <th>توضیحات</th>
                                    <th>کلمات کلیدی</th>
                                    <th>توضیحات کلمات کلیدی</th>
                                    <th>وضعیت</th>
                                    <th>آخرین بروز رسانی</th>
                                    <th>ثبت کننده</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($query as $item)
                                    <tr class="gradeX data{{ $item->id }}">
                                        <td class="align-middle">{{ $item->id }}</td>
                                        <td class="align-middle">{{ $item->title }} / {{ $item->title_en }}</td>
                                        <td class="align-middle">
                                            @if($item->pic != '')
                                                <a target="_blank" href="{{ asset($item->pic) }}">
                                                    <i class="fa fa-image"></i>
                                                </a>
                                            @else
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            {!! Illuminate\Support\Str::limit($item->text,100) !!}
                                        </td>
                                        <td class="align-middle">
                                            {{ $item->keywords }}
                                        </td>
                                        <td class="align-middle">
                                           {{ $item->description }}
                                        </td>
                                        <td class="align-middle">
                                            @if($item->status==0)
                                                <span class="badge badge-danger p-2">مخفی</span>
                                            @elseif($item->status==1)
                                                <span class="badge badge-primary p-2">فعال</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ new Verta($item->updated_at) }}</td>
                                        <td class="align-middle">{{ $item->user->name }} {{ $item->user->family }}</td>
                                        <td class="align-middle">
                                            @can(\App\Helper\Helper::getTypePermission('delete'))
                                            <button title="حذف" href="#" class="btn btn-danger btn-sm" id="del{{ $item->id }}" data-url="{{ url('Admin/Brand/'.$item->id) }}" onclick="del({{ $item->id }});">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endcan
                                            @can(\App\Helper\Helper::getTypePermission('edit'))
                                            <a title="ویرایش" href="{{ url('Admin/Brand/'.$item->id.'/edit') }}" class="btn btn-outline-success btn-sm">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            @endcan
                                            @can(\App\Helper\Helper::getTypePermission('edit'))
                                                <a title="کپی" href="{{ route('CopyProduct.index',['data' => 'brand','id'=> $item->id]) }}" class="btn btn-success btn-sm">
                                                    <i class="fa fa-copy"></i>
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
