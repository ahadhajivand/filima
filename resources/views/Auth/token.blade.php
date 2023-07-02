@extends('Auth.master')
@section('content')
    <!-- sign in -->
    <div dir="rtl" class="sign section--full-bg" data-bg="/home/img/bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- authorization form -->
                        <form method="post" action="{{route('auth.token')}}" class="sign__form">
                            @csrf
                            <a href="/" class="sign__logo">
                                <img src="/home/img/logo.svg" alt="">
                            </a>

                            <div class="sign__group">
                                <input name="code" value="" type="text" class="sign__input" placeholder="کد را وارد کنید">
                            </div>

                            <button class="sign__btn" type="submit">تایید کد</button>

                            @include('layouts.error')
                        </form>
                        <!-- end authorization form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end sign in -->
@endsection
