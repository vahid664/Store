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
                        <a target="_blank" href="{{ url('Admin/Article/create') }}" class="pull-left btn btn-primary margin-top-n-4 text-white ml-4 px-3 mt-0 pt-1 pb-0">
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
                                    <th>بازدید</th>
                                    <th>پین شده</th>
                                    <th>وضعیت</th>
                                    <th>دسته بندی</th>
                                    <th>تعداد تصویر</th>
                                    <th>آخرین بروز رسانی</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($query as $item)
                                    <tr class="gradeX data{{ $item->id }}">
                                        <td class="align-middle">{{ $item->id }}</td>
                                        <td class="align-middle">{{ $item->title }} / {{ $item->title_en }}</td>
                                        <td class="align-middle">{{ $item->visit }}</td>
                                        <td class="align-middle text-center">
                                            @if($item->index==1)
                                                <span class="badge badge-success p-2">صفحه مقالات</span>
                                            @else
                                                <span class="badge badge-danger p-2">هیچکدام</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($item->status==0)
                                                <span class="badge badge-danger p-2">مخفی</span>
                                            @else
                                                <span class="badge badge-primary p-2">فعال</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            {{$item->category->title}}
                                        </td>
                                        <td class="align-middle">{{ $item->pics->count() }}</td>
                                        <td class="align-middle">{{ new Verta($item->updated_at) }}</td>
                                        <td class="align-middle">
                                            @can(\App\Helper\Helper::getTypePermission('delete'))
                                            <button title="حذف" href="#" class="btn btn-danger btn-sm" id="del{{ $item->id }}" data-url="{{ url('Admin/Article/'.$item->id) }}" onclick="del({{ $item->id }});">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endcan
                                            @can(\App\Helper\Helper::getTypePermission('edit'))
                                            <a title="ویرایش" href="{{ url('Admin/Article/'.$item->id.'/edit') }}" class="btn btn-outline-success btn-sm">
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

<script>
    var seen = "<a href='{{ url("/home/proceeding_text/") }}'"+value['id']+">"+
        "<button class='btn btn-info'>مشاهده متن جلسه</button></a>";
</script>
