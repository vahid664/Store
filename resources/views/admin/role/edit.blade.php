@extends('layouts.app_admin')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-purple">ویرایش
                        <span class="text-warning">{{ $query->name }}</span>
                        <a href="{{ url('Admin/Role') }}" class="float-right text-white">برگشت
                            <i class="fa fa-arrow-left"></i>
                        </a>

                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="alert alert-danger m-per" style="display: none;" role="alert">

                        </div>

                        <form id="form-role" method="post" action="{{ route('Role.update',$query->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="name" class="col-md-3 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        عنوان
                                    </label>
                                    <div class="col-md-9">
                                        <input id="name" type="text" placeholder="مثال : post-list"
                                               class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $query->name }}"
                                               required autocomplete="name" autofocus >
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="permissions" class="col-md-12 col-form-label">
                                        <i class="fa fa-star text-danger"></i>
                                        انتخاب دسترسی ها
                                        <span class="mr-lg-3">
                                            <input type="checkbox" id="check_all" onclick="ch_check();">
                                        </span>
                                    </label>
                                    <div class="col-md-12" style="overflow-x: scroll">
                                        <table class="table table-hover table-bordered table-striped">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th class="align-middle">#
                                                </th>
                                                <th class="align-middle">

                                                    <i class="fa fa-list"></i>
                                                    <span>لیست</span>
                                                </th>
                                                <th class="align-middle">


                                                    <span>فرم افزودن</span>
                                                </th>
                                                <th  class="align-middle">
                                                    <i class="fa fa-plus"></i>
                                                    <span> ذخیره </span>
                                                </th>
                                                <th  class="align-middle"> <i class="fa fa-eye"></i><span> مشاهده </span></th>
                                                <th  class="align-middle">
                                                    <span> فرم ویرایش</span>
                                                </th>
                                                <th  class="align-middle">
                                                    <i class="fa fa-pencil-square-o"></i><span> به روز رسانی </span>
                                                </th>
                                                <th  class="align-middle">
                                                    <i class="fa fa-trash"></i><span> حذف </span>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(\Spatie\Permission\Models\Permission::select('title')->distinct()->get()->pluck('title') as $item)
                                                <tr>
                                                    <td class="align-middle">
                                                        @switch($item)
                                                            @case('user')
                                                            کاربری
                                                            @break
                                                            @case('product')
                                                            محصولات
                                                            @break
                                                            @case('factor')
                                                            فاکتور
                                                            @break
                                                            @case('article')
                                                            مقالات
                                                            @break
                                                            @case('brand')
                                                            برند
                                                            @break
                                                            @case('advertise')
                                                            بنر
                                                            @break
                                                            @case('tag')
                                                            تگ
                                                            @break
                                                            @case('page')
                                                            صفحات ثابت
                                                            @break
                                                            @case('news')
                                                            لیست خبرنامه
                                                            @break
                                                            @case('social')
                                                            شبکه های اجتماعی
                                                            @break
                                                            @case('group')
                                                            گروه بندی
                                                            @break
                                                            @case('role')
                                                            سطوح کاربری
                                                            @break
                                                            @case('permission')
                                                            سطح دسترسی
                                                            @break
                                                            @case('productdetail')
                                                            ویژگی های محصول
                                                            @break
                                                            @case('productawesome')
                                                            محصولات ویژه
                                                            @break
                                                            @case('articlefile')
                                                            فایل های مقالات
                                                            @break
                                                            @case('productfile')
                                                            فایل های محصولات
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    @foreach($permissions as $value)
                                                        @if($item==$value->title)
                                                            <td class="align-middle">
                                                                <div class="d-flex">
                                                                <div><input type="checkbox" class="mt-2" {{ in_array($value->name,$query->permissions()->pluck('name')->toArray()) ? 'checked' : '' }} name="permissions[]" id="{{ $value->name }}" value="{{ $value->id }}"></div>
                                                                    <div class="pt-2 pr-2">
                                                                        @if(strpos($value->name,'insert'))
                                                                                افزودن
                                                                        @elseif(strpos($value->name,'show'))

                                                                                مشاهده
                                                                        @elseif(strpos($value->name,'delete'))
                                                                                حذف
                                                                        @elseif(strpos($value->name,'edit'))
                                                                                ویرایش
                                                                        @elseif(strpos($value->name,'list'))
                                                                                لیست
                                                                        @elseif(strpos($value->name,'report'))
                                                                                گزارش
                                                                        @elseif(strpos($value->name,'accept'))
                                                                            تایید
                                                                        @else
                                                                            {{ $value->name }}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
                                            <a href="{{ url('Admin/Role') }}" class="btn btn-outline-primary w-100">
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

        function ch_check()
        {
            if($("#check_all").is(':checked'))
            {
                $('.table input:checkbox').each(function(){
                    $(this).prop('checked',true);
                })
            }
            else{
                $('.table input:checkbox').each(function(){
                    $(this).prop('checked',false);
                })
            }
        }

        $("#form-role").submit(function(e) {
            if($("#library-insert").is(':checked') || $("#library-delete").is(':checked') || $("#library-edit").is(':checked') || $("#library-list").is(':checked') || $("#library-report").is(':checked'))
            {
                if($("#library-show").is(':checked'))
                {

                }
                else
                {
                    $('.m-per').html('{{ __('user.m1') }}');
                    $('.m-per').css('display','block');
                    $('.alert-success').css('display','none');
                    return false;
                }
            }
            if($("#library-report").is(':checked') || $("#library-delete").is(':checked') || $("#library-edit").is(':checked')){
                if($("#library-show").is(':checked') &&  $("#library-list").is(':checked'))
                {

                }
                else
                {
                    $('.m-per').html('{{__('user.m2')}}');
                    $('.m-per').css('display','block');
                    $('.alert-success').css('display','none');
                    return false;
                }
            }


            //

            if($("#survey-insert").is(':checked') || $("#survey-delete").is(':checked') || $("#survey-edit").is(':checked') || $("#survey-list").is(':checked') || $("#survey-report").is(':checked'))
            {
                if($("#survey-show").is(':checked'))
                {

                }
                else
                {
                    $('.m-per').html('{{__('user.m3')}}');
                    $('.m-per').css('display','block');
                    $('.alert-success').css('display','none');
                    return false;
                }
            }
            if($("#survey-report").is(':checked') || $("#survey-delete").is(':checked') || $("#survey-edit").is(':checked')){
                if($("#survey-show").is(':checked') &&  $("#survey-list").is(':checked'))
                {

                }
                else
                {
                    $('.m-per').html('{{__('user.m4')}}');
                    $('.m-per').css('display','block');
                    $('.alert-success').css('display','none');
                    return false;
                }
            }


            //

            if($("#azmoon-insert").is(':checked') || $("#azmoon-delete").is(':checked') || $("#azmoon-edit").is(':checked') || $("#azmoon-list").is(':checked') || $("#azmoon-report").is(':checked'))
            {
                if($("#azmoon-show").is(':checked'))
                {

                }
                else
                {
                    $('.m-per').html('{{__('user.m5')}}');
                    $('.m-per').css('display','block');
                    $('.alert-success').css('display','none');
                    return false;
                }
            }
            if($("#azmoon-report").is(':checked') || $("#azmoon-delete").is(':checked') || $("#azmoon-edit").is(':checked')){
                if($("#azmoon-show").is(':checked') &&  $("#azmoon-list").is(':checked'))
                {

                }
                else
                {
                    $('.m-per').html('{{__('user.m6')}}');
                    $('.m-per').css('display','block');
                    $('.alert-success').css('display','none');
                    return false;
                }
            }

            //

            if($("#calendar-insert").is(':checked') || $("#calendar-delete").is(':checked') || $("#calendar-edit").is(':checked') || $("#calendar-list").is(':checked') || $("#calendar-report").is(':checked'))
            {
                if($("#calendar-show").is(':checked'))
                {

                }
                else
                {
                    $('.m-per').html('{{__('user.m7')}}');
                    $('.m-per').css('display','block');
                    $('.alert-success').css('display','none');
                    return false;
                }
            }
            if($("#calendar-report").is(':checked') || $("#calendar-delete").is(':checked') || $("#calendar-edit").is(':checked')){
                if($("#calendar-show").is(':checked') &&  $("#calendar-list").is(':checked'))
                {

                }
                else
                {
                    $('.m-per').html('{{__('user.m8')}}');
                    $('.m-per').css('display','block');
                    $('.alert-success').css('display','none');
                    return false;
                }
            }


            //

            if($("#group-insert").is(':checked') || $("#group-delete").is(':checked') || $("#group-edit").is(':checked') || $("#group-list").is(':checked') || $("#group-report").is(':checked'))
            {
                if($("#group-show").is(':checked'))
                {

                }
                else
                {
                    $('.m-per').html('{{__('user.m9')}}');
                    $('.m-per').css('display','block');
                    $('.alert-success').css('display','none');
                    return false;
                }
            }
            if($("#group-report").is(':checked') || $("#group-delete").is(':checked') || $("#group-edit").is(':checked')){
                if($("#group-show").is(':checked') &&  $("#group-list").is(':checked'))
                {

                }
                else
                {
                    $('.m-per').html('{{__('user.m10')}}');
                    $('.m-per').css('display','block');
                    $('.alert-success').css('display','none');
                    return false;
                }
            }

            //

            if($("#post-insert").is(':checked') || $("#post-delete").is(':checked') || $("#post-edit").is(':checked') || $("#post-list").is(':checked') || $("#post-report").is(':checked'))
            {
                if($("#post-show").is(':checked'))
                {

                }
                else
                {
                    $('.m-per').html('{{__('user.m11')}}');
                    $('.m-per').css('display','block');
                    $('.alert-success').css('display','none');
                    return false;
                }
            }
            if($("#post-report").is(':checked') || $("#post-delete").is(':checked') || $("#post-edit").is(':checked')){
                if($("#post-show").is(':checked') &&  $("#post-list").is(':checked'))
                {

                }
                else
                {
                    $('.m-per').html('{{__('user.m12')}}');
                    $('.m-per').css('display','block');
                    $('.alert-success').css('display','none');
                    return false;
                }
            }

            //

            if($("#form-insert").is(':checked') || $("#form-delete").is(':checked') || $("#form-edit").is(':checked') || $("#form-list").is(':checked') || $("#form-report").is(':checked'))
            {
                if($("#form-show").is(':checked'))
                {

                }
                else
                {
                    $('.m-per').html('{{ __('user.m13') }}');
                    $('.m-per').css('display','block');
                    $('.alert-success').css('display','none');
                    return false;
                }
            }
            if($("#form-report").is(':checked') || $("#form-delete").is(':checked') || $("#form-edit").is(':checked')){
                if($("#form-show").is(':checked') &&  $("#form-list").is(':checked'))
                {

                }
                else
                {
                    $('.m-per').html('{{__('user.m14')}}');
                    $('.m-per').css('display','block');
                    $('.alert-success').css('display','none');
                    return false;
                }
            }
        });
    </script>
@endsection
