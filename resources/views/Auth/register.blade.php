@extends('Auth.master')
@section('content')
    <!-- sign in -->
    <div dir="rtl" class="sign section--full-bg" data-bg="/home/img/bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="sign__content">

                        <!-- registration form -->
                        <form method="post" action="{{route('auth.register')}}" class="sign__form">
                            @csrf
                            <a href="/" class="sign__logo">
                                <img src="/home/img/logo.svg" alt="">
                            </a>

                            <div class="sign__group">
                                <input name="name" value="" type="text" class="sign__input" placeholder="نام">
                            </div>

                            <div class="sign__group">
                                <input name="phone" value="" type="text" class="sign__input" placeholder="موبایل">
                            </div>

                                @include('layouts.error')


                            <button class="sign__btn" type="submit">ثبت نام</button>


                            <span class="sign__text">از قبل حساب دارید ? <a href="{{route('auth.login')}}">وارد شوید !</a></span>
                        </form>
                        <!-- registration form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end sign in -->
@endsection
