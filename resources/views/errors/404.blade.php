{{--
@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
--}}

@extends('layouts.app')
@section('content')
    <main class="page-404">
        <div class="container text-center">
            <div class="page-404-title">
                <h1>صفحه‌ای که دنبال آن بودید پیدا نشد!</h1>
            </div>
            <div class="page-404-actions">
                <a href="{{ url('/') }}" class="page-404-action page-404-action--primary">بازگشت به صفحه اصلی</a>
            </div>
            <div class="page-404-image">
                <img src="{{ asset('img/404.png') }}">
            </div>
        </div>
    </main>
@endsection
