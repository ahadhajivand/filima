@extends('home.master')

@section('content')
    <!-- head -->
    <section class="section section--head section--head-fixed">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-6">
                    <h1 class="section__title section__title--head">پلن های اشتراک</h1>
                </div>

                <div class="col-12 col-xl-6">
                    <ul class="breadcrumb">
                        <li class="breadcrumb__item"><a href="index.html">صفحه اصلی</a></li>
                        <li class="breadcrumb__item breadcrumb__item--active">پلن های اشتراک</li>
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
                    <p class="section__text section__text--small">با انتخاب این پلن می توانید تا {{$plan->time_month}} ماه به تمامی لینک های دانلود سریال و فیلم دسترسی پیدا کنید</p>
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
                                            <b>{{$plan->title}}</b>
                                            <p>{{number_format($plan->price)}} ت </p>
                                            <span>{{$plan->time_month}}/ ماه</span>
                                        </div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <span class="plans__title">فلیکس تی وی اصل</span>
                                    </td>
                                    <td>
											<span class="plans__status plans__status--green">
												<svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.43994 6.95981L6.77477 12.2924L17.4399 1.62723" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
											</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="plans__title">دسترسی نامحدود به بزرگترین کتابخانه جریانی بدون تبلیغات را دریافت کنید</span>
                                    </td>
                                    <td>
											<span class="plans__status plans__status--green">
												<svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.43994 6.95981L6.77477 12.2924L17.4399 1.62723" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
											</span>
                                    </td>
                                </tr>
                                <tr class="last">
                                    <td>
                                        <span class="plans__title">کانال های تلویزیونی</span>
                                    </td>
                                    <td>
											<span class="plans__status plans__status--red">
												<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.596 1.59982L1.60938 17.5865" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M17.601 17.5961L1.60101 1.5928" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
											</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <form action="{{route('AddToCart' , $plan->id)}}" method="post">
                                            @csrf
                                            <button class="plans__btn" type="submit">افزودن پلن به سبد خرید</button>
                                        </form>
                                    </td>
                                </tr>
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
