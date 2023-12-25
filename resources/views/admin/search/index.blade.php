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
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example2" >
                                <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>تعداد</th>
                                    <th>آخرین ثبت</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($query as $key => $value)
                                    <tr class="gradeX">
                                        <td class="align-middle">{{ $key }}</td>
                                        <td class="align-middle">{{ $value->count() }}</td>
                                        <td class="align-middle">{{ $value[0]->created_at }}</td>
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
