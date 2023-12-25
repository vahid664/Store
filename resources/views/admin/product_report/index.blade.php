@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        گزارش گیری پیشرفته
                    </div>
                    <div class="card-body">
                        <form method="get" action="{{ route('ProductReport.index') }}">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="title" class="col-md-3 col-form-label">
                                        عنوان
                                    </label>
                                    <div class="col-md-9">
                                        <input id="title" type="text" placeholder="کرم"
                                               class="form-control @error('title') is-invalid @enderror"
                                               name="title" value="{{ $data['title'] != '' ? $data['title'] : '' }}" >
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="price_type" class="col-md-3 col-form-label">
                                        نوع قیمت</label>
                                    <div class="col-md-9">
                                        <select name="price_type" id="price_type" class="form-control @error('price_type') is-invalid @enderror">
                                            <option value="">انتخاب</option>
                                            <option {{ $data['price_type'] != '' ? ($data['price_type'] == 1 ? 'selected' : '') : '' }} value="1">قطعی</option>
                                            <option {{ $data['price_type'] != '' ? ($data['price_type'] == 2 ? 'selected' : '') : '' }} value="2">تخفیف دار</option>
                                            <option {{ $data['price_type'] != '' ? ($data['price_type'] == 3 ? 'selected' : '') : '' }} value="3">تلفنی</option>
                                        </select>
                                        @error('price_type')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="price_first" class="col-md-3 col-form-label">
                                        از قیمت (تومان)
                                    </label>
                                    <div class="col-md-9">
                                        <input id="price_first" type="number"
                                               class="form-control @error('price_first') is-invalid @enderror"
                                               name="price_first" value="{{ $data['price_first'] != '' ? $data['price_first'] : '' }}" >
                                        @error('price_first')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="price_end" class="col-md-3 col-form-label">
                                        تا قیمت (تومان)
                                    </label>
                                    <div class="col-md-9">
                                        <input id="price_end" type="number"
                                               class="form-control @error('price_end') is-invalid @enderror"
                                               name="price_end" value="{{ $data['price_end'] != '' ? $data['price_end'] : '' }}" >
                                        @error('price_end')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="percent_first" class="col-md-3 col-form-label">
                                        درصد تخفیف از
                                    </label>
                                    <div class="col-md-9">
                                        <input id="percent_first" type="number"
                                               class="form-control @error('percent_first') is-invalid @enderror"
                                               name="percent_first" value="{{ $data['percent_first'] != '' ? $data['percent_first'] : '' }}" >
                                        @error('percent_first')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="percent_end" class="col-md-3 col-form-label">
                                        درصد تخفیف تا
                                    </label>
                                    <div class="col-md-9">
                                        <input id="percent_end" type="number"
                                               class="form-control @error('percent_end') is-invalid @enderror"
                                               name="percent_end" value="{{ $data['percent_end'] != '' ? $data['percent_end'] : '' }}" >
                                        @error('percent_end')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="entity" class="col-md-3 col-form-label">
                                        موجودی
                                    </label>
                                    <div class="col-md-9">
                                        <input id="entity" type="number"
                                               class="form-control @error('entity') is-invalid @enderror"
                                               name="entity" value="{{ $data['entity'] != '' ? $data['entity'] : '' }}" >
                                        @error('entity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="category_id" class="col-md-3 col-form-label">
                                        دسته بندی</label>
                                    <div class="col-md-9">
                                        <select name="category_id[]" id="category_id"
                                                data-live-search="true" data-hide-disabled="true" multiple data-actions-box="true"
                                                class="selectpicker form-control @error('category_id') is-invalid @enderror" >
                                            @foreach(\App\Category::active()->where('parent',1)->with('childern_all')->get() as $value)
                                                @if(isset($data['category_id']) && in_array($value->id,$data['category_id']))
                                                    <option selected value="{{ $value->id }}">{{ $value->title }}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                @endif
                                                @if($value->childern_all->count())
                                                    @php $i=2; @endphp
                                                    @include('admin.category.cat_report',['child' => $value->childern_all ,'i' => $i,'data' => $data])
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="brand_id" class="col-md-3 col-form-label">
                                        برند </label>
                                    <div class="col-md-9">
                                        <select name="brand_id" id="brand_id" data-live-search="true"
                                                class="selectpicker form-control @error('brand_id') is-invalid @enderror">
                                            <option value="">انتخاب</option>
                                            @foreach(\App\Brand::active()->get() as $value)
                                                <option {{  $data['brand_id'] != '' ? ($data['brand_id'] == $value->id ? 'selected' : '') : ''}} value="{{ $value->id }}">{{ $value->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="status" class="col-md-3 col-form-label">
                                        وضعیت</label>
                                    <div class="col-md-9">
                                        <select name="status" id="status"
                                            class="form-control @error('status') is-invalid @enderror">
                                            <option value="">انتخاب</option>
                                            <option {{ $data['status'] != '' ? ($data['status'] == 1 ? 'selected' : '') : '' }} value="1">موجود</option>
                                            <option {{ $data['status'] != '' ? ($data['status'] == 2 ? 'selected' : '') : '' }} value="2">ناموجود</option>
                                            <option {{ $data['status'] != '' ? ($data['status'] == 0 ? 'selected' : '') : '' }} value="0">مخفی</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="date" class="col-md-3 col-form-label">
                                        تاریخ</label>
                                    <div class="col-md-9">
                                        <select name="date" id="date"
                                                class="form-control @error('date') is-invalid @enderror">
                                            <option value="">انتخاب</option>
                                            <option {{ $data['date'] != '' ? ($data['date'] == 'created_at' ? 'selected' : '') : '' }} value="created_at">ثبت</option>
                                            <option {{ $data['date'] != '' ? ($data['date'] == 'updated_at' ? 'selected' : '') : '' }} value="updated_at">به روزرسانی</option>
                                        </select>
                                        @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="date_start" class="col-md-3 col-form-label">
                                        از تاریخ
                                    </label>
                                    <div class="col-md-9">
                                        <input id="date_start" type="text" autocomplete="off"
                                               class="form-control @error('date_start') is-invalid @enderror" name="date_start"
                                               value="{{ $data['date_start'] != '' ? $data['date_start'] : '' }}">
                                        @error('date_start')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="date_end" class="col-md-3 col-form-label">
                                        تا تاریخ
                                    </label>
                                    <div class="col-md-9">
                                        <input id="date_end" type="text" autocomplete="off"
                                               class="form-control @error('date_end') is-invalid @enderror" name="date_end"
                                               value="{{ $data['date_end'] != '' ? $data['date_end'] : '' }}">
                                        @error('date_end')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between">
                                        <div class="col-md-6">
                                            @can(\App\Helper\Helper::getTypePermission('index'))
                                                <button type="submit" class="btn btn-primary w-100">
                                                    گزارش
                                                </button>
                                            @endcan
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
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
                                    <th>نوع قیمت</th>
                                    <th>قیمت (ریال)</th>
                                    <th>درصد تخفیف</th>
                                    <th>بازدید</th>
                                    {{-- <th>پین شده</th>--}}
                                    <th>وضعیت</th>
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
                                        <td class="align-middle">{{ $item->title }} / {{ $item->title_en }}</td>
                                        <td class="align-middle">{{ $item->entity }}</td>
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
                                        <td class="align-middle">
                                            @if($item->price_type==1)
                                                <span class="badge badge-success p-2">قطعی</span>
                                            @elseif($item->price_type==2)
                                                <span class="badge badge-danger p-2">تخفیف دار</span>
                                            @else
                                                <span class="badge badge-warning p-2">تلفنی</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
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
                                        <td class="align-middle text-center">
                                            @if($item->status==0)
                                                <span class="badge badge-danger p-2">مخفی</span>
                                            @elseif($item->status==1)
                                                <span class="badge badge-primary p-2">موجود</span>
                                            @elseif($item->status==2)
                                                <span class="badge badge-warning p-2">ناموجود</span>
                                            @endif
                                        </td>
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
@section('js')
    <script>
        $("#date_start ,#date_end").persianDatepicker({
            formatDate: "YYYY/0M/0D",
            showGregorianDate: true
        });
    </script>
@endsection
