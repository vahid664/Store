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
                            <a target="_blank" href="{{ url('Admin/Product/create') }}" class="pull-left btn btn-primary margin-top-n-4 text-white ml-4 px-3 mt-0 pt-1 pb-0">
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
                                    <th>موجودی</th>
                                    {{-- <th>نوع</th>
                                     <th>مدل تحویل</th>
                                     <th>گارانتی</th>--}}
                                    {{--<th>نوع قیمت</th>--}}
                                    <th>قیمت (تومان)</th>
                                    <th>درصد تخفیف</th>
                                    <th>بازدید</th>
                                    {{-- <th>پین شده</th>--}}
                                    {{--<th>وضعیت</th>--}}
                                    <th>دسته بندی</th>
                                    <th>برند</th>
                                    <th>تعداد تصویر</th>
                                    <th>آخرین بروز رسانی</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($query as $item)
                                    <tr class="gradeX data{{ $item->id }}">
                                        <td class="align-middle">{{ $item->id }}</td>
                                        <td class="align-middle">{{ $item->title }} / {{ $item->title_en }} / {{ $item->title_page }}</td>
                                        <td class="align-middle">
                                            @if($item->status==0)
                                                <span class="badge badge-danger p-2">مخفی</span>
                                            @elseif($item->status==1)
                                                <span class="badge badge-primary p-2">موجود</span>
                                            @elseif($item->status==2)
                                                <span class="badge badge-warning p-2">ناموجود</span>
                                            @endif
                                            {{ $item->entity }}
                                            {{--<input type="number" onfocusout="PriceProduct('{{$item->id}}',this.value,'entity')" value="{{ $item->entity }}">--}}
                                        </td>
                                        {{--<td class="align-middle">
                                            @if($item->origin==1)
                                                <span class="badge badge-success p-2">اصل</span>
                                            @else
                                                <span class="badge badge-danger p-2">غیر اصل</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if($item->deliver==1)
                                                <span class="badge badge-success p-2">فوری</span>
                                            @elseif($item->deliver==2)
                                                <span class="badge badge-danger p-2">زماندار</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if($item->warranty==1)
                                                <span class="badge badge-success p-2">دارد</span>
                                            @else
                                                <span class="badge badge-danger p-2">ندارد</span>
                                            @endif
                                        </td>--}}
                                        {{--<td class="align-middle">
                                            @if($item->price_type==1)
                                                <span class="badge badge-success p-2">قطعی</span>
                                            @elseif($item->price_type==2)
                                                <span class="badge badge-danger p-2">تخفیف دار</span>
                                            @else
                                                <span class="badge badge-warning p-2">تلفنی</span>
                                            @endif
                                        </td>--}}
                                        <td class="align-middle">
                                            @if($item->price_type==1)
                                                <span class="badge badge-success p-2">قطعی</span>
                                            @elseif($item->price_type==2)
                                                <span class="badge badge-danger p-2">تخفیف دار</span>
                                            @else
                                                <span class="badge badge-warning p-2">تلفنی</span>
                                            @endif
                                            <input type="number" onfocusout="PriceProduct('{{$item->id}}',this.value,'price')" value="{{ $item->price }}">
                                        </td>
                                        <td class="align-middle">{{ $item->price_percent }}</td>
                                        <td class="align-middle">{{ $item->visit }}</td>
                                        {{--<td class="align-middle text-center">
                                            @if($item->index==1)
                                                <span class="badge badge-success p-2">اسلایدر</span>
                                            @elseif($item->index==2)
                                                <span class="badge badge-primary p-2">صفحه اصلی</span>
                                            @elseif($item->index==0)
                                                <span class="badge badge-danger p-2">هیچکدام</span>
                                            @endif
                                        </td>--}}
                                        {{--<td class="align-middle text-center">
                                            @if($item->status==0)
                                                <span class="badge badge-danger p-2">مخفی</span>
                                            @elseif($item->status==1)
                                                <span class="badge badge-primary p-2">موجود</span>
                                            @elseif($item->status==2)
                                                <span class="badge badge-warning p-2">ناموجود</span>
                                            @endif
                                        </td>--}}
                                        <td class="align-middle">
                                            @foreach($item->category_rel as $value)
                                                {{ isset($value->category) ? $value->category->title : 'بهزاد' }} ,
                                            @endforeach
                                        </td>
                                        <td class="align-middle">{{ $item->brands->title }}</td>
                                        <td class="align-middle">{{ $item->pics->count() }}</td>
                                        <td class="align-middle">{{ new Verta($item->updated_at) }}</td>
                                        <td class="align-middle">
                                            @can(\App\Helper\Helper::getTypePermission('delete'))
                                                <button title="حذف" href="#" class="btn btn-danger btn-sm" id="del{{ $item->id }}" data-url="{{ url('Admin/Product/'.$item->id) }}" onclick="del({{ $item->id }});">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endcan
                                            @can(\App\Helper\Helper::getTypePermission('edit'))
                                                <a title="ویرایش" href="{{ url('Admin/Product/'.$item->id.'/edit') }}" class="btn btn-outline-success btn-sm">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                            @endcan
                                            @can(\App\Helper\Helper::getTypePermission('show'))
                                                <a title="مشخصات محصول" href="{{ route('ProductDetail.index',['id' => $item->id]) }}" class="btn btn-outline-primary btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can(\App\Helper\Helper::getTypePermission('show'))
                                                <a title="faq" href="{{ route('Faq.show',[$item->id,'model=Product']) }}"
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="fa fa-comment"></i>
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


