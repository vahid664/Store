@extends('layouts.app')

@section('content')
    <!-- main -->
    <main class="cart default">
        <div class="container text-center">
            <div class="cart-empty">
                <div class="cart-empty-icon">
                    <i class="now-ui-icons shopping_basket"></i>
                </div>
                <div class="cart-empty-title">سبد خرید شما خالیست!</div>
                @guest
                    <div class="parent-btn">
                        <a href="{{ url('login') }}" class="dk-btn dk-btn-success">
                            به حساب کاربری خود وارد شوید
                            <i class="fa fa-sign-in"></i>
                        </a>
                    </div>
                    <div class="cart-empty-url">
                        <span>کاربر جدید هستید؟</span>
                        <a href="{{ url('register') }}">ثبت نام در قالی خانه</a>
                    </div>
                @endguest
            </div>
        </div>
    </main>
    <!-- main -->
@endsection
