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
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>مشتری</th>
                                    <th>مجموع پرداختی</th>
                                    <th>مرجوعی</th>
                                    <th>شناسه پرداخت</th>
                                    <th>وضعیت پرداخت</th>
                                    <th>وضعیت ارسال</th>
                                    <th>نوع ارسال</th>
                                    <th>تاریخ ثبت</th>
                                    <th>تاریخ ارسال</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($query as $item)
                                    @if(isset($item->user))
                                        <tr class="gradeX data{{ $item->id }} {{ $item->status_check == 1 ? 'bg-info' : '' }}">
                                            <td class="align-middle">{{ $item->id }}</td>
                                            <td class="align-middle">
                                                @if($item->user->name != '')
                                                    {{ $item->user->name  }} {{ $item->user->family }}
                                                @else
                                                    @php $des=explode('|',$item->description); @endphp
                                                    {{ isset($des[4]) ? $des[4] : '' }}
                                                @endif
                                                / {{ $item->user->mobile }}
                                            </td>
                                            <td class="align-middle">
                                                {{ number_format($item->price) }}
                                            </td>
                                            <td class="align-middle">
                                                @if($item->returned->count())
                                                    {{ number_format($item->returned->sum('price')) }}
                                                @endif
                                            </td>
                                            <td class="align-middle" style="max-width: 200px">
                                                {{ $item->trans_id }}
                                            </td>
                                            <td class="align-middle">
                                                @if($item->status==0)
                                                    <span class="badge badge-danger p-2">ناموفق</span>
                                                @elseif($item->status==1)
                                                    <span class="badge badge-primary p-2">موفق</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                @if($item->delivery==0)
                                                    <span class="badge badge-danger p-2">ناموفق</span>
                                                @elseif($item->delivery==1)
                                                    <span class="badge badge-primary p-2">ارسال شده</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                @if($item->peyk != null)
                                                    <span class="badge badge-success p-2">پیک</span>
                                                @else
                                                    <span class="badge badge-warning p-2">پست</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">{{ new Verta($item->created_at) }}</td>
                                            <td class="align-middle">
                                                @if($item->delivery==1)
                                                    {{ new Verta($item->updated_at) }}
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                @if($item->delivery==0 && $item->status==0)
                                                    <a title="تایید پرداخت" href="{{ route('Factor.create',['id' => $item->id]) }}" class="btn btn-outline-success btn-sm">
                                                        <i class="fa fa-money"></i>
                                                    </a>
                                                @endif
                                                @if($item->delivery==0 && $item->status==1)
                                                    <a title="تحویل محصولات" href="{{ url('Admin/Factor/'.$item->id) }}" class="btn btn-outline-success btn-sm">
                                                        <i class="fa fa-check-square"></i>
                                                    </a>
                                                @endif
                                                <a title="مشاهده جزییات و چاپ فاکتور" href="{{ route('Factor.edit',$item->id) }}" class="btn btn-success btn-sm">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                                @can(\App\Helper\Helper::getTypePermission('delete'))
                                                    <button title="حذف" href="#" class="btn btn-danger btn-sm" id="del{{ $item->id }}" data-url="{{ url('Admin/Factor/'.$item->id) }}" onclick="del({{ $item->id }});">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 text-center mt-3">
                            {{ $query->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
