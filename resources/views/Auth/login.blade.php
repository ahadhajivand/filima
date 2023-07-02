@extends('Auth.master')
@section('content')


    <!-- sign in -->
    <div dir="rtl" class="sign section--full-bg" data-bg="/home/img/bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- authorization form -->
                        <form method="post" action="{{route('auth.login')}}" class="sign__form">
                            @csrf
                            <a href="/" class="sign__logo">
                                <img src="/home/img/logo.svg" alt="">
                            </a>

                            <div class="sign__group">
                                <input name="phone" value="" type="text" class="sign__input" placeholder="موبایل">
                            </div>

                            @include('layouts.error')

                            <button class="sign__btn" type="submit">ارسال کد</button>



                            <span class="sign__text">حسابی ندارید در سایت ! <a href="{{route('auth.register')}}">ثبت نام کنید !</a></span>

                        </form>
                        <!-- end authorization form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end sign in -->
@endsection
