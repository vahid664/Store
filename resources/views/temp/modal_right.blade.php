<div class="modal right fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="style-7">
            <div class="modal-header d-flex align-items-center justify-content-between">
                <h6 class="modal-title">فیلترینگ نتایج</h6>
                <button type="button" class="close ml-0" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-0" >
                <div class="col-12 text-right px-0 mb-5" >
                    @if(count(request()->all()))
                        <div class="box">
                            <div class="box-header">
                                <div class="box-toggle d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapseExample1" role="button"
                                     aria-expanded="true" aria-controls="collapseExample1">
                                    فیلتر های اعمال شده:
                                    <a class="text-danger" href="{{ url()->current() }}">حذف</a>
                                </div>
                            </div>
                            <div class="box-content">
                                <div class="collapse show" id="collapseExample3">
                                    <div class="filter-option ">
                                        @foreach(request()->all() as $key=>$res)
                                            <div class="btn-group btn-group-sm direction-ltr">
                                                @switch($key)
                                                    @case('sort')
                                                    <button onclick="removeFilterUrl('{{$key}}');" type="button"
                                                            class="btn bg-grey"><span class="text-danger fa fa-close"></span></button>
                                                    <button type="button" onclick="removeFilterUrl('{{$key}}');"
                                                            class="btn bg-grey text-dark">مرتب سازی</button>
                                                    @break
                                                    @case('brand')
                                                    <button onclick="removeFilterUrl('{{$key}}');" type="button"
                                                            class="btn bg-grey"><span class="text-danger fa fa-close"></span></button>
                                                    <button type="button" onclick="removeFilterUrl('{{$key}}');"
                                                            class="btn bg-grey text-dark">برند</button>
                                                    @break
                                                    @case('entity')
                                                    <button onclick="removeFilterUrl('{{$key}}');" type="button"
                                                            class="btn bg-grey"><span class="text-danger fa fa-close"></span></button>
                                                    <button type="button" onclick="removeFilterUrl('{{$key}}');"
                                                            class="btn bg-grey text-dark">فقط کالاهای موجود</button>
                                                    @break
                                                    @case('color')
                                                    <button onclick="removeFilterUrl('{{$key}}');" type="button"
                                                            class="btn bg-grey"><span class="text-danger fa fa-close"></span></button>
                                                    <button type="button" onclick="removeFilterUrl('{{$key}}');"
                                                            class="btn bg-grey text-dark">رنگبندی</button>
                                                    @break
                                                    @case('size')
                                                    <button onclick="removeFilterUrl('{{$key}}');" type="button"
                                                            class="btn bg-grey"><span class="text-danger fa fa-close"></span></button>
                                                    <button type="button" onclick="removeFilterUrl('{{$key}}');"
                                                            class="btn bg-grey text-dark">سایزبندی</button>
                                                    @break
                                                    @case('discount')
                                                    <button onclick="removeFilterUrl('{{$key}}');" type="button"
                                                            class="btn bg-grey"><span class="text-danger fa fa-close"></span></button>
                                                    <button type="button" onclick="removeFilterUrl('{{$key}}');"
                                                            class="btn bg-grey text-dark">تخفیف دار</button>
                                                    @break
                                                @endswitch
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="box">
                        <div class="box-header">
                            <div class="box-toggle" data-toggle="collapse" href="#collapseExample2" role="button"
                                 aria-expanded="true" aria-controls="collapseExample2">
                                دسته بندی محصولات
                                <i class="now-ui-icons arrows-1_minimal-down"></i>
                            </div>
                        </div>
                        <div class="box-content">
                            <div class="collapse show" id="collapseExample2">
                                <ul class="filter-option">
                                    @foreach($list_category as $value)
                                        <li class="py-1">
                                            <a href="{{ url(Illuminate\Support\Str::slug($value->title_en)) }}" class="d-flex align-items-center justify-content-start text-black">
                                                <span class="fa fa-angle-left"></span>
                                                <span class="pr-2" for="checkbox{{ $loop->iteration }}">
                                                    {{ $value->title }}
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <div class="box-toggle" data-toggle="collapse" href="#collapseExample3" role="button"
                                 aria-expanded="true" aria-controls="collapseExample3">
                                برند
                                <i class="now-ui-icons arrows-1_minimal-down"></i>
                            </div>
                        </div>
                        <div class="box-content">
                            <div class="collapse show" id="collapseExample3">
                                <div class="filter-option ">
                                    @foreach($brand_list as $brand)
                                        <div class="col-12">
                                            <input onchange="qwe();" id="brand{{ $brand->id }}" name="brand[]" value="{{$brand->id}}" type="checkbox"
                                                {{ isset(request()->brand) ? (in_array($brand->id,explode(',',request()->brand)) ? 'checked' : '')  : '' }}>
                                            <label for="brand{{ $brand->id }}">
                                                {{ $brand->title }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <div class="box-toggle" data-toggle="collapse" href="#collapseExample4" role="button"
                                 aria-expanded="true" aria-controls="collapseExample4">
                                سایز بندی
                                <i class="now-ui-icons arrows-1_minimal-down"></i>
                            </div>
                        </div>
                        <div class="box-content">
                            <div class="collapse show" id="collapseExample4">
                                <div class="filter-option ">
                                    @foreach($sizes as $size)
                                        <div class="col-12">
                                            <input onchange="sizep();" id="size{{ $size->title }}" name="size[]"
                                                   value="{{$size->title}}" type="checkbox"
                                                {{ isset(request()->size) ? (in_array($size->title,explode(',',request()->size)) ? 'checked' : '')  : '' }}>
                                            <label for="size{{ $size->title }}">
                                                {{ $size->title }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <div class="box-toggle" data-toggle="collapse" href="#collapseExample5" role="button"
                                 aria-expanded="true" aria-controls="collapseExample5">
                                رنگبندی
                                <i class="now-ui-icons arrows-1_minimal-down"></i>
                            </div>
                        </div>
                        <div class="box-content">
                            <div class="collapse show" id="collapseExample5">
                                <div class="filter-option ">
                                    @foreach($colors as $color)
                                        <div class="col-12">
                                            <input onchange="colorp();" id="size{{ $color->title }}" name="size[]"
                                                   value="{{$color->title}}" type="checkbox"
                                                {{ isset(request()->color) ? (in_array($color->title,explode(',',request()->color)) ? 'checked' : '')  : '' }}>
                                            <label for="size{{ $color->title }}">
                                                {{ $color->title }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-content">
                            <input type="checkbox" id="entity" name="entity" class="bootstrap-switch"
                                   onchange="{{ isset(request()->entity) ? (request()->entity == 1 ? 'entity(0)' : 'entity(1)') : 'entity(1)' }}"
                                {{ isset(request()->entity) ? (request()->entity == 1 ? 'checked' : '') : '' }} />
                            <label for="">فقط کالاهای موجود</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
