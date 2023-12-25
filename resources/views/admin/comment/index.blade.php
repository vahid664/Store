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
                        <a target="_blank" href="{{ route('CommentAdmin.create') }}" class="pull-left btn btn-primary margin-top-n-4 text-white ml-4 px-3 mt-0 pt-1 pb-0">
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
                                    <th>ثبت کننده</th>
                                    <th>عنوان</th>
                                    <th>متن</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ ثبت</th>
                                    <th>بهترین جواب</th>
                                    <th>نوع</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($query as $item)
                                    <tr class="gradeX data{{ $item->id }}">
                                        <td class="align-middle">{{ $item->id }}</td>
                                        <td class="align-middle">{{ $item->user->full_name }}</td>
                                        <td class="align-middle">{{ $item->title }}</td>
                                        <td class="align-middle">{{ $item->text }}</td>
                                        <td class="align-middle">
                                            @if($item->status==0)
                                                <span class="badge p-2 bg-warning">در انتظار</span>
                                            @else
                                                <span class="badge p-2 bg-primary">تایید شده</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ $item->created_at }}</td>
                                        <td class="align-middle">
                                            @if($item->accept==1)
                                                <span class="badge p-2 bg-success">
                                                    <i class="fa fa-check"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if($item->commentable_type=='App\Product')
                                                <a target="_blank" href="{{route('product.show',$item->commentable_id)}}">
                                                    محصول
                                                </a>
                                            @else
                                                <a target="_blank" href="{{route('Blog.show',$item->commentable_id)}}">
                                                    محصول
                                                </a>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @can(\App\Helper\Helper::getTypePermission('delete'))
                                                <button title="حذف" href="#" class="btn btn-danger btn-sm" id="del{{ $item->id }}" data-url="{{ route('CommentAdmin.destroy',$item->id) }}" onclick="del({{ $item->id }});">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endcan
                                            @can(\App\Helper\Helper::getTypePermission('edit'))
                                                <a title="ویرایش" href="{{ route('CommentAdmin.edit',$item->id) }}" class="btn btn-outline-success btn-sm">
                                                    <i class="fa fa-pencil"></i>
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
