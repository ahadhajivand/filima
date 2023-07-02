@extends('home.master')

@section('content')
    <!-- head -->
    <section class="section section--head section--head-fixed">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-6">
                    <h1 class="section__title section__title--head">سبد خرید</h1>
                </div>

                <div class="col-12 col-xl-6">
                    <ul class="breadcrumb">
                        <li class="breadcrumb__item"><a href="index.html">صفحه اصلی</a></li>
                        <li class="breadcrumb__item breadcrumb__item--active">سبد خرید اشتراک</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- end head -->

    <!-- features -->
    <div class="section section--pb0">
        <div class="container">
            <div class="row">
                <!-- section text -->
                <div class="col-12">
                    <p class="section__text section__text--small">با انتخاب این پلن می توانید تا  ماه به تمامی لینک های دانلود سریال و فیلم دسترسی پیدا کنید</p>
                </div>
                <!-- end section text -->
            </div>

        </div>
    </div>
    <!-- end features -->

    <!-- plan -->
    <div class="section section--pb0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="plans plans--mt0">
                        <div class="table-responsive">
                            <table class="plans__table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>
                                        <div class="plans__head">
                                        </div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($carts->count() != 0)
                                @foreach($carts as $cart)
                                    @php
                                    $plan = $cart['plan']
                                    @endphp
                                <tr>
                                    <td>
                                        <span class="plans__title">عنوان پلن</span>
                                    </td>
                                    <td>
											<span class="plans__title">
                                                {{$plan->title}}
											</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="plans__title"> مدت زمان پنل به ماه:</span>
                                    </td>
                                    <td>
											<span class="plans__title">
                                                {{$plan->time_month}}
											</span>
                                    </td>
                                </tr>
                                <tr>
                                        <td>
                                            <span class="plans__title">قیمت پلن</span>
                                        </td>
                                        <td>
											<span class="plans__title">
                                                {{number_format($plan->price)}} ریال
											</span>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td>
                                        <form action="{{route('delete' , $plan->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="plans__btn" type="submit">حذف پلن </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{route('profile.vip' , $plan->time_month)}}" method="post">
                                            @csrf
                                            <button class="plans__btn" type="submit">پرداخت</button>
                                        </form>
{{--                                        <form action="{{route('cart-payment')}}" method="post">--}}
{{--                                            @csrf--}}
{{--                                            <button class="plans__btn" type="submit">پرداخت</button>--}}
{{--                                        </form>--}}

                                    </td>
                                </tr>
                                @else
                                    <tr>
                                        <td>
                                            <span class="plans__title">  سبد خرید خالی می باشد برای خرید اشتراک به پروفایلتان بروید</span>
                                        </td>
                                        <td>
                                            <a href="{{route('profile')}}" class="plans__btn">برو به پروفایل</a>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end plan -->


@endsection
