<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @isset($title)
        <title>{{ $title }}</title>
    @else
        <title>{{ config('app.name', 'Laravel') }}</title>
    @endisset
    <link href="{{ asset('admincssjs/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admincssjs/css/plugins/bootstrap-rtl/bootstrap-rtl.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admincssjs/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('admincssjs/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ asset('admincssjs/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

    <link href="{{ asset('admincssjs/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('admincssjs/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admincssjs/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('admincssjs/css/plugins/jsTree/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admincssjs/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('admincssjs/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admincssjs/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admincssjs/css/persianDatepicker-default.css') }}" rel="stylesheet">
    <link href="{{ asset('admincssjs/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admincssjs/css/jquery-input-char-count-bootstrap3.min.css') }}" rel="stylesheet">
   {{-- <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
</head>
<body class="rtls">
<div id="wrapper">
    @include('admin.temp.sidebar')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top mb-0" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    {{--<form role="search" class="navbar-form-custom" action="#">
                        <div class="form-group">
                            <input type="text" placeholder="جستجو ..." class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>--}}
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li style="padding: 20px">
                        <span class="m-r-sm text-muted welcome-message"><a target="_blank" href="{{ url('/') }}">صفحه اصلی سایت</a></span>
                    </li>


                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> خروج
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                </ul>

            </nav>
        </div>

        @yield('content')
        <div class="Loading">
            <img src="{{ asset('img/load.GIF') }}" >
        </div>
        <div class="footer">
            <div class="float-right">
                System developer <strong><a target="_blank" href="http://jobteam.ir">jobteam</a> </strong>
                {{-- Behzad Mirzazadeh --}}
            </div>
            <div>
                <strong>Copyright</strong> jobteam &copy; 2019-2025
            </div>
        </div>
    </div>

</div>
    <!-- Mainly scripts -->
    <script src="{{ asset('admincssjs/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('admincssjs/js/popper.min.js') }}"></script>
    <script src="{{ asset('admincssjs/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admincssjs/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('admincssjs/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Flot -->
    <script src="{{ asset('admincssjs/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('admincssjs/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('admincssjs/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('admincssjs/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('admincssjs/js/plugins/flot/jquery.flot.pie.js') }}"></script>

    <!-- Peity -->
    <script src="{{ asset('admincssjs/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('admincssjs/js/plugins/touchpunch/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('admincssjs/js/demo/peity-demo.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('admincssjs/js/inspinia.js') }}"></script>
    <script src="{{ asset('admincssjs/js/plugins/pace/pace.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('admincssjs/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- GITTER -->
    <script src="{{ asset('admincssjs/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ asset('admincssjs/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{ asset('admincssjs/js/demo/sparkline-demo.js') }}"></script>

    <!-- ChartJS-->
    <script src="{{ asset('admincssjs/js/plugins/chartJs/Chart.min.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ asset('admincssjs/js/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('admincssjs/js/plugins/jsTree/jstree.min.js') }}"></script>
    <script src="{{ asset('admincssjs/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admincssjs/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admincssjs/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('admincssjs/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admincssjs/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('admincssjs/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admincssjs/js/persianDatepicker.min.js') }}"></script>
    <script src="{{ asset('admincssjs/js/select2.min.js') }}"></script>
    <script src="{{ asset('admincssjs/js/jquery-input-char-count.js') }}"></script>
    @yield('js')

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        function PicColorChange(a) {
            $('.Loading').css('display','block');
            $.ajax({
                url: '{{ route('PicColor.store') }}',
                type: 'POST',
                data: {
                    '_token': $('meta[name=csrf-token]').attr("content"),
                    'data': a,
                },
                success: function (result) {
                    $('.Loading').css('display','none');
                },
                error: function () {
                    swal("Error!", 'مشکلی پیش آمده است لطفا دقایقی دیگر دوباره امتحان کنید', "Problem");
                }
            });
        }

        function PriceProduct(id,value,name) {
            $('.Loading').css('display','block');
            $.ajax({
                url: '{{ route('ProductUpdate.store') }}',
                type: 'POST',
                data: {
                    '_token': $('meta[name=csrf-token]').attr("content"),
                    'id': id,
                    'value': value,
                    'name': name,
                },
                success: function (result) {
                    $('.Loading').css('display','none');
                    //swal("مرتب سازی!", result, "success");
                },
                error: function () {
                    swal("Error!", 'مشکلی پیش آمده است لطفا دقایقی دیگر دوباره امتحان کنید', "Problem");
                }
            });
        }

        function del(a) {
            //alert($('#del' + a).attr('data-url'));
            swal({
                title: "مطمئن هستید؟",
                text: "پس از حذف امکان بازگشت دوباره وجود ندارد",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#D0D0D0",
                confirmButtonText: "بله",
                cancelButtonText: "خیر",
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: $('#del' + a).attr('data-url'),
                    type: 'POST',
                    data: {
                        '_token': $('meta[name=csrf-token]').attr("content"),
                        '_method': 'DELETE',
                        'id': a,
                    },
                    success: function (result) {
                        $('.data' + a).remove();
                        //alert('dsd');
                        swal("حذف شد!", result, "success", {
                            button: "تایید",
                        });

                    },
                    error: function () {
                        swal("Error!", 'مشکلی پیش آمده است لطفا دقایقی دیگر دوباره امتحان کنید', "Problem");
                    }
                });
                //swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });

        }
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                ordering: false,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

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
            $('.dataTables-example2').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

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


        });
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                dir: "rtl",
                placeholder: "تگ های مرتبط با محصول را انتخاب کنید",
            });
			$('.metismenu').find('a').each(function() {
                if($(this).attr('href') == window.location)
                {
                    $('.metismenu a[href="' + window.location + '"]').parents('li').addClass('active');
                    $('.metismenu a[href="' + window.location + '"]').parents('ul').addClass('collapse in');
                    $('#side-menu').removeClass('collapse in');
                }
            });
            $("#peyk").on('submit',(function(e) {
                $('.Loading').css('display','block');
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'), // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData:false,        // To send DOMDocument or non processed data file it is set to false
                    success: function(data)   // A function to be called if request succeeds
                    {
                        $('.Loading').css('display','none');
                    }
                });
            }));
        });

		var todoTable;
        $("#todoTable").sortable({
            connectWith: ".connectList",
            update: function( event, ui ) {
                todoTable = $( "#todoTable" ).sortable( "toArray" );
            }
        }).disableSelection();
        function sortingTable(table) {
            var todoTable;
            todoTable = $( "#todoTable" ).sortable( "toArray" );
            todoTable=window.JSON.stringify(todoTable);
            todoTable=JSON.parse(todoTable); //string to array
            var url=$('#sortingTable').attr('data-url');
            console.log(todoTable);
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    '_token': $('meta[name=csrf-token]').attr("content"),
                    'data': todoTable,
                    'table': table
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
</body>
</html>
