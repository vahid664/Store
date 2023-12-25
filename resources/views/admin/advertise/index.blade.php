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
                        <a target="_blank" href="{{ route('Advertise.create') }}" class="pull-left btn btn-primary margin-top-n-4 text-white ml-4 px-3 mt-0 pt-1 pb-0">
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
                                    <th>آدرس صفحه مقصد</th>
                                    <th>تصویر</th>
                                    <th>توضیحات</th>
                                    <th>نمایش در صفحه</th>
                                    <th>مکان در صفحه</th>
                                    <th>وضعیت</th>
                                    <th>نمایش برای دستگاه</th>
                                    <th>نحوه نمایش</th>
                                    <th>نوع تبلیغ</th>
                                    <th>نوع بنر</th>
                                    <th>تاریخ</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($query as $item)
                                    <tr class="gradeX data{{ $item->id }}">
                                        <td class="align-middle">{{ $item->id }}</td>
                                        <td class="align-middle">{{ $item->title }} / {{ $item->title_en }}</td>
                                        <td class="align-middle">{{ $item->url }}</td>
                                        <td class="align-middle">
                                            @if($item->pic != '')
                                                <a target="_blank" title="{{ $item->pic_alt }}" href="{{ asset($item->pic) }}">
                                                    <i class="fa fa-image"></i>
                                                </a>
                                            @else
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            {!! Illuminate\Support\Str::limit($item->description,100) !!}
                                        </td>
                                        <td class="align-middle">
                                            @switch($item->where_page)
                                                @case(1)
                                                    <span class="badge badge-success">صفحه اصلی</span>
                                                @break
                                                @case(2)
                                                    <span class="badge badge-danger">دسته بندی</span>
                                                @break
                                                @case(3)
                                                    <span class="badge badge-primary">برند</span>
                                                @break
                                                @case(4)
                                                    <span class="badge badge-warning">محصول</span>
                                                @break
                                                @case(5)
                                                    <span class="badge badge-info">تگ</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="align-middle">
                                            @switch($item->location)
                                                @case(1)
                                                    <span class="badge badge-success">اسلایدر اصلی</span>
                                                @break
                                                @case(2)
                                                    <span class="badge badge-danger">بالای صفحه</span>
                                                @break
                                                @case(3)
                                                    <span class="badge badge-primary">سمت راست صفحه</span>
                                                @break
                                                @case(4)
                                                    <span class="badge badge-warning">بین محصولات 1</span>
                                                @break
                                                @case(5)
                                                <span class="badge badge-warning">بین محصولات 2</span>
                                                @break
                                                @case(6)
                                                <span class="badge badge-warning">بین محصولات 3</span>
                                                @break
                                                @case(7)
                                                <span class="badge badge-warning">بین محصولات 4</span>
                                                @break
                                                @case(8)
                                                    <span class="badge badge-info">پایان صفحه</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="align-middle">
                                            @if($item->status==0)
                                                <span class="badge badge-danger p-2">مخفی</span>
                                            @elseif($item->status==1)
                                                <span class="badge badge-primary p-2">فعال</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @switch($item->platform_status)
                                                @case(0)
                                                <span class="badge badge-success">همه</span>
                                                @break
                                                @case(1)
                                                <span class="badge badge-danger">فقط pc</span>
                                                @break
                                                @case(2)
                                                <span class="badge badge-primary">فقط موبایل</span>
                                                @break
                                                @case(3)
                                                <span class="badge badge-warning">فقط تبلت</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="align-middle">
                                            @switch($item->type_open)
                                                @case(1)
                                                    <span class="badge badge-success">صفحه جدید</span>
                                                @break
                                                @case(2)
                                                    <span class="badge badge-danger">صفحه فعلی</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="align-middle">
                                            @switch($item->ads_type)
                                                @case(1)
                                                    <span class="badge badge-success">بنر داخلی</span>
                                                @break
                                                @case(2)
                                                    <span class="badge badge-danger">تبلیغ داخلی</span>
                                                @break
                                                @case(3)
                                                    <span class="badge badge-warning">تبلیغ خارجی</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="align-middle">
                                            @switch($item->banner_type)
                                                @case(1)
                                                    <span class="badge badge-success">تصویر</span>
                                                @break
                                                @case(2)
                                                    <span class="badge badge-danger">تصویر و متن</span>
                                                @break
                                                @case(3)
                                                    <span class="badge badge-warning">متن</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="align-middle">{{ $item->date_start != '' ? new Verta($item->date_start) : ''}}
                                            / {{ $item->date_end != '' ? new Verta($item->date_end) : '' }}</td>
                                        <td class="align-middle">
                                            @can(\App\Helper\Helper::getTypePermission('delete'))
                                            <button title="حذف" href="#" class="btn btn-danger btn-sm" id="del{{ $item->id }}" data-url="{{ url('Admin/Advertise/'.$item->id) }}" onclick="del({{ $item->id }});">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endcan
                                            @can(\App\Helper\Helper::getTypePermission('edit'))
                                            <a title="ویرایش" href="{{ url('Admin/Advertise/'.$item->id.'/edit') }}" class="btn btn-outline-success btn-sm">
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
