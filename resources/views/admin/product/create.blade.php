@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">{{ $title }}
                        <a href="{{ url('Admin/Product') }}" class="pull-left text-white">
                            برگشت
                            <i class="fa fa-arrow-left"></i>
                        </a>

                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" enctype="multipart/form-data" action="{{ route('Product.store') }}">
                            @csrf

                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label for="title_en" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان لاتین
                                    </label>
                                    <div class="col-md-9">
                                        <input id="title_en" type="text" placeholder="example:Elit" maxlength="100"
                                               class="form-control input-char-count text-left latin @error('title_en') is-invalid @enderror" name="title_en" value="{{ old('title_en') }}"
                                               required  title=" نام برند به لاتین و فقط برای ادمین قابل نمایش می باشد.">
                                        @error('title_en')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-6 form-group">
                                    <label for="title" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان فارسی
                                    </label>
                                    <div class="col-md-9">
                                        <input id="title" type="text" placeholder="مثال : الیت" maxlength="100"
                                               class="form-control input-char-count @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="title_page" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان صفحه
                                    </label>

                                    <div class="col-md-9">
                                        <input id="title_page" type="text" title="مقدار دهی الزامی" maxlength="100"
                                               class="form-control input-char-count {{ $errors->has('title_page') ? ' is-invalid' : '' }}"
                                               name="title_page" value="{{ old('title_page') }}"
                                               required autocomplete="title_page">
                                        @if ($errors->has('title_page'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title_page') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                               {{-- <div class="col-md-6 form-group">
                                    <label for="index" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        پین شده</label>
                                    <div class="col-md-9">
                                        <select name="index" id="index" class="form-control @error('index') is-invalid @enderror" required>
                                            <option value="0">هیچکدام</option>
                                            <option value="1">اسلایدر اصلی</option>
                                            <option value="2">صفحه اصلی</option>
                                        </select>
                                        @error('index')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>--}}
                                <div class="col-md-6 form-group">
                                    <label for="shoulder" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        شانه</label>
                                    <div class="col-md-9">
                                        <select name="shoulder" id="shoulder" class="form-control @error('shoulder') is-invalid @enderror" required>
                                            <option value="0">ندارد</option>
                                            <option value="500">500</option>
                                            <option value="700">700</option>
                                            <option value="1000">1000</option>
                                            <option value="1200">1200</option>
                                            <option value="1500">1500</option>
                                        </select>
                                        @error('shoulder')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="price_type" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        نوع قیمت</label>
                                    <div class="col-md-9">
                                        <select name="price_type" id="price_type" class="form-control @error('price_type') is-invalid @enderror" required>
                                            <option value="1">قطعی</option>
                                            <option value="2">تخفیف دار</option>
                                            <option value="3">تلفنی</option>
                                        </select>
                                        @error('price_type')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6 form-group">
                                    <label for="price" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        قیمت (تومان)
                                    </label>
                                    <div class="col-md-9">
                                        <input id="price" type="number"
                                               class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price',0) }}" required >
                                        @error('price')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="price_self_buy" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        قیمت تمام شده (تومان)
                                    </label>
                                    <div class="col-md-9">
                                        <input id="price_self_buy" type="number"
                                               class="form-control @error('price_self_buy') is-invalid @enderror" name="price_self_buy" value="{{ old('price_self_buy',0) }}" required>
                                        @error('price_self_buy')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="price_percent" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        درصد تخفیف
                                    </label>
                                    <div class="col-md-9">
                                        <input id="price_percent" type="number"
                                               class="form-control @error('price_percent') is-invalid @enderror" name="price_percent" value="{{ old('price_percent',0) }}" required >
                                        @error('price_percent')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="entity" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        موجودی
                                    </label>
                                    <div class="col-md-9">
                                        <input id="entity" type="number"
                                               class="form-control @error('entity') is-invalid @enderror" name="entity" value="{{ old('entity',1) }}" required >
                                        @error('entity')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{--<div class="col-md-6 form-group">
                                    <label for="brand_id" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        محصول قبلی </label>
                                    <div class="col-md-9">
                                        <select name="brand_id" id="brand_id" data-live-search="true"
                                                class="selectpicker form-control @error('brand_id') is-invalid @enderror" required>
                                            <option value="">انتخاب</option>
                                            @foreach(\App\Brand::active()->get() as $value)
                                                @if(in_array($value->id,old('brand_id')))
                                                    <option selected value="{{ $value->id }}">{{ $value->title }}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                @endif
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
                                    <label for="brand_id" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        محصول بعدی </label>
                                    <div class="col-md-9">
                                        <select name="brand_id" id="brand_id" data-live-search="true"
                                                class="selectpicker form-control @error('brand_id') is-invalid @enderror" required>
                                            <option value="">انتخاب</option>
                                            @foreach(\App\Brand::active()->get() as $value)
                                                @if(in_array($value->id,old('brand_id')))
                                                    <option selected value="{{ $value->id }}">{{ $value->title }}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>--}}


                                <div class="col-md-6 form-group">
                                    <label for="color" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        رنگبندی</label>

                                    <div class="col-md-9">
                                        <select name="color[]" id="color" data-live-search="true" data-hide-disabled="true" multiple data-actions-box="true"
                                                class="selectpicker form-control @error('color') is-invalid @enderror">

                                            @foreach(\App\Color::where('parent',0)->with('child')->orderby('sort')->get() as $value)
                                                {{-- @if(old('color') != '' && in_array($value->id,old('color')))
                                                     <option selected value="{{ $value->id }}">{{ $value->title }}</option>
                                                 @else
                                                     <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                 @endif--}}
                                                <optgroup label="{{ $value->title }}">
                                                    @if($value->child->count())
                                                        @foreach($value->child as $item)
                                                            @if(old('color') != '' && in_array($item->id,old('color')))
                                                                <option selected value="{{ $item->id }}">{{ $item->title }} / {{ $item->title_factory }}</option>
                                                            @else
                                                                <option value="{{ $item->id }}">{{ $item->title }} / {{ $item->title_factory }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </optgroup>
                                            @endforeach
                                        </select>
                                        @error('color')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="size" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        سایزبندی</label>

                                    <div class="col-md-9">
                                        <select name="size[]" id="size" data-live-search="true" data-hide-disabled="true" multiple data-actions-box="true"
                                                class="selectpicker form-control @error('size') is-invalid @enderror">
                                            @foreach(\App\Size::where('parent',0)->with('child')->get() as $value)
                                                <optgroup label="{{ $value->title }}">
                                                    @if($value->child->count())
                                                        @foreach($value->child as $item)
                                                            @if(old('size') != '' && in_array($item->title,old('size')))
                                                                <option selected value="{{ $item->title }}">{{ $item->title }}</option>
                                                            @else
                                                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </optgroup>

                                            @endforeach
                                        </select>
                                        @error('size')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6 form-group">
                                    <label for="category_id" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        دسته بندی</label>

                                    <div class="col-md-9">
                                        <select name="category_id[]" id="category_id" data-live-search="true" data-hide-disabled="true" multiple data-actions-box="true"
                                                class="selectpicker form-control @error('category_id') is-invalid @enderror" required>
                                            @foreach(\App\Category::active()->where('parent',1)->with('childern_all')->get() as $value)
                                                @if(old('category_id') != '' && in_array($value->id,old('category_id')))
                                                    <option selected value="{{ $value->id }}">{{ $value->title }}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                @endif
                                                @if($value->childern_all->count())
                                                    @php $i=2; @endphp
                                                    @include('admin.category.cat',['child' => $value->childern_all ,'i' => $i])
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
                                        <i class="fa fa-star text-danger"></i>
                                        برند </label>
                                    <div class="col-md-9">
                                        <select name="brand_id" id="brand_id" data-live-search="true"
                                                class="selectpicker form-control @error('brand_id') is-invalid @enderror" required>
                                            <option value="">انتخاب</option>
                                            @foreach(\App\Brand::active()->get() as $value)
                                                <option {{ old('brand_id') == $value->id ? 'selected' : ''}} value="{{ $value->id }}">{{ $value->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                        <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="keywords" class="col-md-12 col-form-label">
                                        تگ های محصول
                                    </label>
                                    <div class="col-md-12">
                                        <select class="js-example-basic-multiple form-control @error('tags') is-invalid @enderror"
                                                name="tags[]" id="tags" multiple="multiple">
                                            @foreach($tag as $value)
                                                @if(old('tags') != null && in_array($value->id,old('tags')))
                                                    <option selected value="{{ $value->id }}">{{ $value->title }} / {{ $value->title_en }}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->title }} / {{ $value->title_en }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('tags')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="keywords" class="col-md-12 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        کلمات کلیدی
                                    </label>
                                    <div class="col-md-12">
                                        <input id="keywords" type="text" pattern=".{3,70}" maxlength="70"
                                               class="form-control input-char-count @error('keywords') is-invalid @enderror"
                                               name="keywords" value="{{ old('keywords') }}">
                                        @error('keywords')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="description" class="col-md-12 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        توضیحات کلمات کلیدی
                                    </label>
                                    <div class="col-md-12">
                                        <input id="description" type="text" pattern=".{3,170}" maxlength="170"
                                               class="form-control input-char-count @error('description') is-invalid @enderror"
                                               name="description" value="{{ old('description') }}">
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="short_text" class="col-md-12 col-form-label">
                                        متن کوتاه
                                    </label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('short_text') is-invalid @enderror" rows="3" id="short_text" name="short_text"
                                                  placeholder="غیرضروری">{{ old('short_text') }}</textarea>
                                        @error('short_text')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-12 form-group">
                                    <label for="long_text" class="col-md-12 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        توضیحات
                                    </label>
                                    <div class="col-md-12">
                                        <textarea class="form-control @error('long_text') is-invalid @enderror" rows="5" id="long_text" name="long_text" required
                                                  placeholder="توضیحات محصول">{{ old('long_text') }}</textarea>
                                        @error('long_text')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="origin" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        نوع</label>
                                    <div class="col-md-9">
                                        <select name="origin" id="origin" class="form-control @error('origin') is-invalid @enderror" required>
                                            <option value="0">غیراصل</option>
                                            <option selected value="1">اصل</option>
                                        </select>
                                        @error('origin')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="deliver" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        مدل تحویل</label>
                                    <div class="col-md-9">
                                        <select name="deliver" id="deliver" class="form-control @error('deliver') is-invalid @enderror" required>
                                            <option value="1">فوری</option>
                                            <option value="2">زماندار</option>
                                        </select>
                                        @error('deliver')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="warranty" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        گارانتی</label>
                                    <div class="col-md-9">
                                        <select name="warranty" id="warranty" class="form-control @error('warranty') is-invalid @enderror" required>
                                            <option value="1">دارد</option>
                                            <option value="0">ندارد</option>
                                        </select>
                                        @error('warranty')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="status" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        وضعیت</label>
                                    <div class="col-md-9">
                                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                            <option value="1">موجود</option>
                                            <option value="2">ناموجود</option>
                                            <option value="0">مخفی</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                                <div class="col-12 mb-4">
                                    <div class="d-flex justify-content-between">
                                        <div><h3>تصاویر</h3></div>
                                        <div class="pr-lg-3">
                                            <button type="button" onclick="add_row();" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
                                            <button type="button" onclick="del_row();" class="btn btn-danger btn-sm mr-1"><i class="fa fa-minus"></i></button>
                                        </div>

                                    </div>
                                </div>

                                <div class="row col-12 row-file">
                                    <div class="col-md-6 form-group">
                                        <label for="title_file" class="col-md-3 col-form-label">
                                            عنوان</label>
                                        <div class="col-md-9">
                                            <input id="title_file" type="text" class="form-control @error('title_file') is-invalid @enderror" name="title_file[]">
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="files" class="col-md-3 col-form-label">
                                            فایل تصویر</label>
                                        <div class="col-md-9">
                                            <input id="files" type="file" class="form-control @error('files') is-invalid @enderror" name="files[]">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between">
                                        <div class="col-md-6">
                                            @can(\App\Helper\Helper::getTypePermission('store'))
                                                <button type="submit" class="btn btn-primary w-100">
                                                    ثبت
                                                </button>
                                            @endcan
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ url('Admin/Product') }}" class="btn btn-outline-primary w-100">
                                                انصراف
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>

        CKEDITOR.replace('long_text', {
            language: 'fa',
            filebrowserImageBrowseUrl: '{{asset('/laravel-filemanager?type=Images')}}',
            filebrowserImageUploadUrl: '{{asset('/laravel-filemanager/upload?type=Images&_token=')}}',
            filebrowserBrowseUrl: '{{asset('/laravel-filemanager?type=Files')}}',
            filebrowserUploadUrl: '{{asset('/laravel-filemanager/upload?type=Files&_token=')}}'
        });

        CKEDITOR.replace('short_text', {
            language: 'fa',
            filebrowserImageBrowseUrl: '{{asset('/laravel-filemanager?type=Images')}}',
            filebrowserImageUploadUrl: '{{asset('/laravel-filemanager/upload?type=Images&_token=')}}',
            filebrowserBrowseUrl: '{{asset('/laravel-filemanager?type=Files')}}',
            filebrowserUploadUrl: '{{asset('/laravel-filemanager/upload?type=Files&_token=')}}'
        });

        function add_row() {
            $('.row-file').append('<div class="col-md-6 form-group">'+
                '<label for="title_file" class="col-md-3 col-form-label">عنوان</label>'+
                '<div class="col-md-9">'+
                '<input id="title_file" type="text" class="form-control" name="title_file[]">'+
                '</div>'+
                '</div>'+
                '<div class="col-md-6 form-group">'+
                '<label for="files" class="col-md-3 col-form-label">فایل تصویر</label>'+
                '<div class="col-md-9">'+
                '<input id="files" type="file" class="form-control" name="files[]"></div></div>');
        }

        function del_row() {
            $('.row-file .form-group:last').remove();
            $('.row-file .form-group:last').remove();
        }

    </script>
@endsection
