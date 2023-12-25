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
                       {{-- <a target="_blank" href="{{ url('Admin/User/create') }}" class="pull-left btn btn-primary margin-top-n-4 text-white ml-4 px-3 mt-0 pt-1 pb-0">
                            <i class="fa fa-plus"></i>
                            افزودن
                        </a>--}}
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">مشتریان</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">کاربران</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive py-3">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                        <tr>
                                            <th>شناسه</th>
                                            <th>نام و فامیلی</th>
                                            <th>موبایل</th>
                                            <th>ایمیل</th>
                                            <th>آدرس</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($query as $item)
                                            <tr class="gradeX data{{ $item->id }}">
                                                <td class="align-middle">{{ $item->id }}</td>
                                                <td class="align-middle">{{ $item->name }} / {{ $item->family }}</td>
                                                <td class="align-middle">
                                                    {{ $item->mobile }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $item->email }}
                                                </td>
                                                <td class="align-middle">
                                                    @if($item->address_first != null)
                                                        {{ $item->address_first->province }}
                                                        -
                                                        {{ $item->address_first->city }} ،
                                                        {{ $item->address_first->address }}
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    @can(\App\Helper\Helper::getTypePermission('delete'))
                                                    <button title="حذف" href="#" class="btn btn-danger btn-sm" id="del{{ $item->id }}" data-url="{{ url('Admin/User/'.$item->id) }}" onclick="del({{ $item->id }});">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    @endcan
                                                    @can(\App\Helper\Helper::getTypePermission('edit'))
                                                     <a title="ویرایش" href="{{ url('Admin/User/'.$item->id.'/edit') }}" class="btn btn-outline-success btn-sm">
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
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="table-responsive py-3">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                        <tr>
                                            <th>شناسه</th>
                                            <th>نام و فامیلی</th>
                                            <th>موبایل</th>
                                            <th>ایمیل</th>
                                            <th>آدرس</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(\App\User::where('level',121)->get() as $item)
                                            <tr class="gradeX data{{ $item->id }}">
                                                <td class="align-middle">{{ $item->id }}</td>
                                                <td class="align-middle">{{ $item->name }} / {{ $item->family }}</td>
                                                <td class="align-middle">
                                                    {{ $item->mobile }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $item->email }}
                                                </td>
                                                <td class="align-middle">
                                                    @if($item->address_first != null)
                                                        {{ $item->address_first->province }}
                                                        -
                                                        {{ $item->address_first->city }} ،
                                                        {{ $item->address_first->address }}
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    @can(\App\Helper\Helper::getTypePermission('delete'))
                                                     <button title="حذف" href="#" class="btn btn-danger btn-sm" id="del{{ $item->id }}" data-url="{{ url('Admin/User/'.$item->id) }}" onclick="del({{ $item->id }});">
                                                         <i class="fa fa-trash"></i>
                                                     </button>
                                                    @endcan
                                                    @can(\App\Helper\Helper::getTypePermission('edit'))
                                                    <a title="ویرایش" href="{{ url('Admin/User/'.$item->id.'/edit') }}" class="btn btn-outline-success btn-sm">
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
        </div>
    </div>
@endsection
