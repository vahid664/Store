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
                        <form method="post" enctype="multipart/form-data" action="{{ route('Product.update',$query->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label for="title_en" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان لاتین
                                    </label>
                                    <div class="col-md-9">
                                        <input id="title_en" type="text" placeholder="example:Elit" maxlength="100"
                                               class="form-control input-char-count text-left latin @error('title_en') is-invalid @enderror"
                                               name="title_en" value="{{ $query->title_en }}"
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
                                               class="form-control input-char-count @error('title') is-invalid @enderror" name="title"
                                               value="{{ $query->title }}" required>
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
                                               name="title_page" value="{{ $query->title_page }}"
                                               required autocomplete="title_page">
                                        @if ($errors->has('title_page'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title_page') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{--<div class="col-md-6 form-group">
                                    <label for="index" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        پین شده</label>
                                    <div class="col-md-9">
                                        <select name="index" id="index" class="form-control @error('index') is-invalid @enderror" required>
                                            <option {{ $query->index == 0 ? 'selected' : '' }} value="0">هیچکدام</option>
                                            <option {{ $query->index == 1 ? 'selected' : '' }} value="1">اسلایدر اصلی</option>
                                            <option {{ $query->index == 2 ? 'selected' : '' }} value="2">صفحه اصلی</option>
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
                                            <option {{ $query->shoulder == 0 ? 'selected' : '' }} value="0">ندارد</option>
                                            <option {{ $query->shoulder == 500 ? 'selected' : '' }} value="500">500</option>
                                            <option {{ $query->shoulder == 700 ? 'selected' : '' }} value="700">700</option>
                                            <option {{ $query->shoulder == 1000 ? 'selected' : '' }} value="1000">1000</option>
                                            <option {{ $query->shoulder == 1200 ? 'selected' : '' }} value="1200">1200</option>
                                            <option {{ $query->shoulder == 1500 ? 'selected' : '' }} value="1500">1500</option>
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
                                            <option {{ $query->price_type == 1 ? 'selected' : '' }} value="1">قطعی</option>
                                            <option {{ $query->price_type == 2 ? 'selected' : '' }} value="2">تخفیف دار</option>
                                            <option {{ $query->price_type == 3 ? 'selected' : '' }} value="3">تلفنی</option>
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
                                               class="form-control @error('price') is-invalid @enderror" name="price"
                                               value="{{ $query->price }}" required >
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
                                               class="form-control @error('price_self_buy') is-invalid @enderror"
                                               name="price_self_buy" value="{{ $query->price_self_buy }}" required>
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
                                               class="form-control @error('price_percent') is-invalid @enderror"
                                               name="price_percent" value="{{ $query->price_percent }}" required >
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
                                               class="form-control @error('entity') is-invalid @enderror" name="entity"
                                               value="{{ $query->entity }}" required >
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
                                            {{--  @foreach(\App\Color::all() as $value)
                                                  @if($query->color->count() && in_array($value->title,$query->color->pluck('title')->toArray()))
                                                      <option selected value="{{ $value->id }}">{{ $value->title }}</option>
                                                  @else
                                                      <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                  @endif
                                              @endforeach--}}
                                            @foreach(\App\Color::where('parent',0)->with('child')->orderby('sort')->get() as $value)
                                                <optgroup label="{{ $value->title }}">
                                                    @if($value->child->count())
                                                        @foreach($value->child as $item)
                                                            @if(in_array($item->title,$query->color->pluck('title')->toArray()))
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
                                                            @if($query->size->count() != '' && in_array($item->title,$query->size->pluck('title')->toArray()))
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
                                                {{--@if($query->category_rel->count() != '' && in_array($value->id,$query->category_rel->pluck('category_id')->toArray()))
                                                    <option selected value="{{ $value->id }}">{{ $value->title }}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                @endif--}}
                                                @if(in_array($value->id,$query->category_rel->pluck('category_id')->toArray()))
                                                    <option selected value="{{ $value->id }}">{{ $value->title }}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                @endif
                                                @if($value->childern_all->count())
                                                    @php $i=2; @endphp
                                                    @include('admin.category.cat_edit',['child' => $value->childern_all ,'i' => $i])
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
                                                <option {{ $query->brand_id == $value->id ? 'selected' : ''}} value="{{ $value->id }}">{{ $value->title }}</option>
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
                                                name="tags[]" id="tags" multiple="multiple" >
                                            @foreach($tag as $value)
                                                @if(in_array($value->id,$query->tag_rel->pluck('tag')->pluck('id')->toArray()))
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
                                               name="keywords" value="{{ $query->keywords }}">
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
                                               name="description" value="{{ $query->description }}">
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
                                                  placeholder="غیرضروری">{{ $query->short_text }}</textarea>
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
                                                  placeholder="توضیحات محصول">{{ $query->long_text }}</textarea>
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
                                            <option {{ $query->origin == 0 ? 'selected' : '' }} value="0">غیراصل</option>
                                            <option {{ $query->origin == 1 ? 'selected' : '' }} value="1">اصل</option>
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
                                            <option {{ $query->deliver == 1 ? 'selected' : '' }} value="1">فوری</option>
                                            <option {{ $query->deliver == 2 ? 'selected' : '' }} value="2">زماندار</option>
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
                                            <option {{ $query->warranty == 1 ? 'selected' : '' }} value="1">دارد</option>
                                            <option {{ $query->warranty == 0 ? 'selected' : '' }} value="0">ندارد</option>
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
                                            <option {{ $query->status == 1 ? 'selected' : '' }} value="1">موجود</option>
                                            <option {{ $query->status == 2 ? 'selected' : '' }} value="2">ناموجود</option>
                                            <option {{ $query->status == 0 ? 'selected' : '' }} value="0">مخفی</option>
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

                                <div class="col-md-12 form-group"><hr></div>
                                <div class="col-md-12 form-group">
                                    <h3 class="text-danger">تصاویر پیوستی</h3>
                                    <table class="table border">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">عنوان</th>
                                            <th scope="col">رنگبندی</th>
                                            <th scope="col">مشاهده</th>
                                            <th scope="col">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody class="sortable-list connectList agile-list" id="todoTable">
                                        @if($query->pics->count())
                                            @foreach($query->pics as $item)
                                                <tr id="{{ $item->id }}">
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $item->title }}</td>
                                                    <td>
                                                        <select id="PicColor" class="form-control" onchange="PicColorChange(this.value);">
                                                            <option value="{{ $item->id }}|0">انتخاب رنگ برای تصویر</option>
                                                            @if($query->color->count())
                                                                @foreach($query->color as $value)
                                                                    @if($value->pic != '')
                                                                        @if($value->pic->color_id == $value->id && $value->pic->pic_id == $item->id)
                                                                            <option selected value="{{ $item->id }}|{{$value->id}}">{{ $value->title }}/{{$value->title_factory}}</option>
                                                                            {{-- @else
                                                                                 <option value="{{ $item->id }}|{{$value->id}}">{{ $value->title }}/{{$value->title_factory}}</option>--}}
                                                                        @endif
                                                                    @else
                                                                        <option value="{{ $item->id }}|{{$value->id}}">{{ $value->title }}/{{$value->title_factory}}</option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </td>
                                                    <td><a target="_blank" href="{{ asset($item->link) }}"><i class="fa fa-2x fa-image"></i> </a></td>
                                                    <td>
                                                        <a href="{{ url('Admin/ProductFile/destroy/'.$item->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between">
                                        <div class="col-md-6">
                                            @can(\App\Helper\Helper::getTypePermission('update'))
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
                                    <div class="d-flex justify-content-between">
                                        <div class="col-md-6">
                                            <a href="javascript:;" id="sortingTable" data-url="{{ route('SortFree') }}" onclick="sortingTable('product_pics');"
                                               class="btn btn-warning margin-top-n-4 text-white ml-4 px-3 mt-0 pt-1 pb-0">
                                                مرتب کردن
                                                <i class="fa fa-save"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">سایز</th>
                        <th scope="col">قیمت</th>
                        <th scope="col">درصد تخفیف</th>
                        <th scope="col">قیمت نهایی</th>
                        <th scope="col">موجودی</th>
                        <th scope="col">استعلام</th>
                        <th scope="col">رنگبندی</th>
                        <th scope="col">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($query->size as $val)
                            <tr class="{{ $val->status == 1 ? 'bg-table-row' : '' }}">
                                <form method="post" action="{{ route('ProductSize.store') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $val->id }}">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <select class="form-control" name="title" id="title">
                                            @foreach(\App\Size::where('parent','<>',0)->get() as $size)
                                                @if($size->title == $val->title)
                                                    <option selected value="{{ $size->title }}">{{ $size->title }}</option>
                                                @else
                                                    <option value="{{ $size->title }}">{{ $size->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input class="form-control" name="price" type="number" value="{{ $val->price }}"></td>
                                    <td><input class="form-control" name="price_discount" type="number" value="{{ $val->price_discount }}"></td>
                                    <td>{{ $val->price - ($val->price_discount*$val->price/100) }}</td>
                                    <td><input class="form-control" name="entity" type="number" value="{{ $val->entity }}"></td>


                                    <td>
                                        <select name="position" id="position" class="form-control  @error('position') is-invalid @enderror" required>
                                            <option {{ $val->position == 0 ? 'selected' : '' }} value="0">آماده ارسال</option>
                                            <option {{ $val->position == 1 ? 'selected' : '' }} value="1">سفارش جفت</option>
                                            <option {{ $val->position == 2 ? 'selected' : '' }} value="2">بین 7 الی 15 روز</option>
                                            <option {{ $val->position == 3 ? 'selected' : '' }} value="3">استعلام گرفته شود</option>
                                        </select>
                                    </td>



                                    <td>
                                        <select name="colors[]" class="form-control max-height-multi-select" multiple>
                                            @foreach($query->color as $value)
                                                @if($val->colors != '' && count(json_decode($val->colors)) && in_array($value->id,json_decode($val->colors)))
                                                    <option selected value="{{$value->id}}">{{ $value->title }}/{{$value->title_factory}}</option>
                                                @else
                                                    <option value="{{$value->id}}">{{ $value->title }}/{{$value->title_factory}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-success" type="submit">ثبت</button>
                                        @if($val->status == 0)
                                        <a href="{{ route('ProductSize.show',$val->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-check-square"></i>
                                        </a>
                                        @endif
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
