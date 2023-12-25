@extends('layouts.app')

@section('content')
    <main class="profile-user-page default">
        <div class="container">
            <div class="row">
                <div class="profile-page col-xl-9 col-lg-8 col-md-12 order-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-12">
                                <h1 class="title-tab-content">لیست علاقمندی ها</h1>
                            </div>
                            <div class="content-section default">
                                <div class="row">
                                    @if($query->total() == 0)
                                        <div class="col-12 text-center my-5">
                                            <div class="icon-empty">
                                                <i class="now-ui-icons travel_info"></i>
                                            </div>
                                            <h1 class="text-empty">موردی برای نمایش وجود ندارد!</h1>
                                        </div>
                                    @else
                                        @foreach($query as $item)
                                            <div class="col-md-6 col-sm-12">
                                                <div class="profile-recent-fav-row">
                                                    <a href="#" class="profile-recent-fav-col profile-recent-fav-col-thumb">
                                                        <img src="{{ asset($item->product->picfirst->link) }}"></a>
                                                    <div class="profile-recent-fav-col profile-recent-fav-col-title">
                                                        <a href="#">
                                                            <h4 class="profile-recent-fav-name">
                                                                {{ $item->product->title }}
                                                            </h4>
                                                        </a>
                                                        <div class="profile-recent-fav-price">
                                                            @if($item->product->price_type == 1)
                                                                {{ \App\Helper\Helper::number_latin_to_persian(number_format($item->product->price)) }}
                                                                تومان
                                                            @elseif($item->product->price_type == 2)
                                                                {{ number_format($item->product->price - ($item->product->price*($item->product->price_percent/100))) }}
                                                                تومان
                                                            @else
                                                                <a href="tel:02144542991" class="btn btn-link">
                                                                    تماس تلفنی
                                                                    <i class="fa fa-phone"></i>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="profile-recent-fav-col profile-recent-fav-col-actions">
                                                        <button class="btn-action btn-action-remove"
                                                                onclick="event.preventDefault();
                                                 document.getElementById('delete-favorite').submit();">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <form id="delete-favorite" action="{{ route('favorite.destroy', $item->id) }}" method="POST"  class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                    <div class="col-12 text-left mb-3">
                                                        <a target="_blank" href="{{ route('product.show',$item->product->id.'-'.Illuminate\Support\Str::slug($item->product->title_en)) }}" class="view-product">مشاهده محصول</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pager default text-center">
                        {{ $query->links() }}
                    </div>
                </div>
                @include('user.temp.sidebar')
            </div>
        </div>
    </main>
@endsection
