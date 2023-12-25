@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-12">
                <div class="card">
                    <div class="card-header bg-primary">مدیریت رنگ ها
                    </div>
                    <div class="card-body">
                        <div id="jstree2">
                            <ul>
                                <li><a onclick="cat(0)">سردسته ها</a></li>
                                @foreach(\App\Color::where('parent',0)->with('child')->orderBy('sort')->get() as $value)
                                    <li>
                                        <a onclick="cat({{ $value->id }})">{{ $value->title }}</a>
                                        @if($value->child()->count())
                                            @include('admin.temp.cat-color',['child' => $value->child])
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-12 text-info mt-5">
                            حتما یکی از رنگ ها باید انتخاب شود، با کلیک، رنگ مورد نظر انتخاب می گردد.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-12">
                <div class="card">
                    <div class="card-header  bg-success">لیست رنگ های دسته انتخابی
                        <a href="{{ url('/Admin') }}" class="pull-left text-white">بازگشت
                            <i class="fa fa-arrow-left"></i>
                        </a>

                        @can(\App\Helper\Helper::getTypePermission('create'))
                        <a href="{{ url('Admin/Color/create') }}" class="pull-left btn btn-primary margin-top-n-4 text-white ml-4 px-3 mt-0 pt-1 pb-0">
                            <i class="fa fa-plus"></i>
                            افزودن
                        </a>
                        @endcan
                        <button id="sorting" data-url="{{ route('SortColor') }}" onclick="sorting();"
                                class="pull-left btn btn-warning margin-top-n-4 text-white ml-4 px-3 mt-0 pt-1 pb-0">
                            مرتب کردن
                            <i class="fa fa-save"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>

        function cat(id)
        {
            var url='{{ url('Admin/Color/') }}' + '/' + id;
            //alert(url);
            $.ajax({
                url: url ,
                type: 'get',
                data: {
                    '_token': $('meta[name=csrf-token]').attr("content"),
                    'id': id,
                },
                success: function (result) {
                    $('.table-responsive').html('');
                    $('.table-responsive').html(result);
                    $('.dataTables-example').DataTable({
                        pageLength: 25,
                        order: [],
                        responsive: true,
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: [
                            { extend: 'copy'},
                            {extend: 'csv'},
                            {extend: 'excel', title: 'ExampleFile'},
                            /* {extend: 'pdf', title: 'ExampleFile'},*/

                            {extend: 'print',
                                customize: function (win){
                                    $(win.document.body).addClass('white-bg');
                                    $(win.document.body).css('font-size', '10px');

                                    $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                                }
                            }
                        ],
                        language: {
                            "search": "جستجو : ",
                            "paginate": {
                                "previous": "قبلی",
                                "next": "بعدی",
                            },
                            "lengthMenu": "نمایش _MENU_ تایی",
                            "zeroRecords": "چیزی یافت نشده",
                            "info": "نمایش صفحه _PAGE_ از _PAGES_",
                            "infoEmpty": "رکوردی یافت نشد",
                            "infoFiltered": "(فیلتر شده از _MAX_ مجموعه رکوردها)"
                        }

                    });
                    var todo;
                    $("#todo").sortable({
                        connectWith: ".connectList",
                        update: function( event, ui ) {
                            todo = $( "#todo" ).sortable( "toArray" );
                            /*$('.output').html("ToDo: " + window.JSON.stringify(todo) + "<br/>");*/
                        }
                    }).disableSelection();
                },
                error: function () {
                    swal("Error!", 'مشکلی پیش آمده است لطفا دقایقی دیگر دوباره امتحان کنید', "Problem");
                }
            });
        }

        $(document).ready(function() {
            $('#jstree2').jstree({
                'core': {
                    'check_callback': true
                },
                'plugins': ['types', 'dnd'],
                'types': {
                    'default': {
                        'icon': 'fa fa-folder'
                    },
                    'html': {
                        'icon': 'fa fa-file-code-o'
                    },
                    'svg': {
                        'icon': 'fa fa-file-picture-o'
                    },
                    'css': {
                        'icon': 'fa fa-file-code-o'
                    },
                    'img': {
                        'icon': 'fa fa-file-image-o'
                    },
                    'js': {
                        'icon': 'fa fa-file-text-o'
                    }

                }
            });
        });

        function sorting() {
            var todo;
            todo = $( "#todo" ).sortable( "toArray" );
            todo=window.JSON.stringify(todo);
            todo=JSON.parse(todo); //string to array
             //alert(todo);
            var url=$('#sorting').attr('data-url');
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    '_token': $('meta[name=csrf-token]').attr("content"),
                    'data': todo,
                },
                success: function (result) {
                    swal("مرتب سازی!", result, "success");
                },
                error: function () {
                    swal("Error!", 'مشکلی پیش آمده است لطفا دقایقی دیگر دوباره امتحان کنید', "Problem");
                }
            });

        }
    </script>
@endsection
