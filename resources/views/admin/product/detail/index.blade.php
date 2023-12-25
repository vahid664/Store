@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('/Admin/Product') }}" class="pull-left text-white"> برگشت
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        @can(\App\Helper\Helper::getTypePermission('create'))
                        <a href="{{ url('Admin/ProductDetail/create?id='.$find->id) }}" class="pull-left btn btn-primary margin-top-n-4 text-white ml-4 px-3 mt-0 pt-1 pb-0">
                            <i class="fa fa-plus"></i>
                            افزودن
                        </a>
                        @endcan
                        <a href="javascript:;" id="sortingTable" data-url="{{ route('SortFree') }}" onclick="sortingTable('product_detail_structeds');"
                           class="pull-left btn btn-warning margin-top-n-4 text-white ml-4 px-3 mt-0 pt-1 pb-0">
                            مرتب کردن
                            <i class="fa fa-save"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>عنوان</th>
                                    <th>متن</th>
                                    <th>نوع</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody class="sortable-list connectList agile-list" id="todoTable">
                                @foreach($query as $item)
                                    <tr id="{{ $item->id }}" class="gradeX data{{ $item->id }} " >
                                        <td class="align-middle">{{ $item->sort }}</td>
                                        <td class="align-middle">{{ $item->title }}</td>
                                        <td class="align-middle">{!! $item->text !!}</td>
                                        <td class="align-middle">
                                           {{ $item->father->title }}
                                        </td>
                                        <td class="align-middle">
                                            @can(\App\Helper\Helper::getTypePermission('delete'))
                                            <button title="حذف" href="#" class="btn btn-danger btn-sm" id="del{{ $item->id }}" data-url="{{ url('Admin/ProductDetail/'.$item->id) }}" onclick="del({{ $item->id }});">
                                                <i class="fa fa-trash"></i>
                                            </button>
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

