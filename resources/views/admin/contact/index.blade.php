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
                        <a target="_blank" href="{{ route('Contact.create') }}" class="pull-left btn btn-primary margin-top-n-4 text-white ml-4 px-3 mt-0 pt-1 pb-0">
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
                                    <th>نام</th>
                                    <th>موبایل</th>
                                    <th>توضیحات</th>
                                    <th>وضعیت</th>
                                    <th>آخرین بروز رسانی</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($query as $item)
                                    <tr class="gradeX data{{ $item->id }}">
                                        <td class="align-middle">{{ $item->id }}</td>
                                        <td class="align-middle">{{ $item->name }}</td>
                                        <td class="align-middle">{{ $item->mobile }}</td>
                                        <td class="align-middle">
                                            {{ $item->comment }}
                                        </td>
                                        <td class="align-middle">
                                            @if($item->status==0)
                                                <span class="badge badge-danger p-2">در انتظار</span>
                                            @elseif($item->status==1)
                                                <span class="badge badge-primary p-2">تایید شده</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ new Verta($item->updated_at) }}</td>
                                        <td class="align-middle">
                                            @if($item->status==0)
                                                <a title="تایید" href="{{ url('Admin/Contact/'.$item->id) }}" class="btn btn-outline-success btn-sm">
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
