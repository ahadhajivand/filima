@extends('home.master')


@section('content')


        <!-- home -->
        <div class="home">
            <div class="home__carousel owl-carousel" id="flixtv-hero">
                @foreach($specialserials as $special)
                <div class="home__card">
                    <a href="{{route('single_serial' , $special->title)}}">
                        <img src="{{$special->image}}" alt="">
                    </a>
                    <div>
                        <h2>{{$special->title}}</h2>
                        <ul>
                            <li>رایگان</li>
                            <li>{{$special->genre_one}}</li>
                            <li>{{$special->country}}</li>
                        </ul>
                    </div>
                    <form action="{{route('interest-serial')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$special->title}}" name="title">
                        <input type="hidden" value="{{$special->id}}" name="interestable_id">
                        <input type="hidden" value="{{get_class($special)}}" name="interestable_type">
                        <button class="home__add" type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16,2H8A3,3,0,0,0,5,5V21a1,1,0,0,0,.5.87,1,1,0,0,0,1,0L12,18.69l5.5,3.18A1,1,0,0,0,18,22a1,1,0,0,0,.5-.13A1,1,0,0,0,19,21V5A3,3,0,0,0,16,2Zm1,17.27-4.5-2.6a1,1,0,0,0-1,0L7,19.27V5A1,1,0,0,1,8,4h8a1,1,0,0,1,1,1Z"/></svg></button>
                    </form>
                    <span class="home__rating"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z"/></svg> 9.1</span>
                </div>
                @endforeach
            </div>

            <button class="home__nav home__nav--prev" data-nav="#flixtv-hero" type="button"></button>
            <button class="home__nav home__nav--next" data-nav="#flixtv-hero" type="button"></button>
        </div>
        <!-- end home -->



        <!-- catalog -->
        <div class="catalog">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="catalog__nav">
                            <div class="catalog__select-wrap">
                                    <select class="catalog__select"  onChange="window.location.href='genre/films/' + this.options[this.selectedIndex].value">
                                        <option value="All genres">همه سبک ها</option>
                                        <option value="اکشن">اکشن</option>
                                        <option value="انیمیشن">انیمیشن</option>
                                        <option value="درام">درام</option>
                                        <option value="کمدی">کمدی</option>
                                        <option value="علمی">علمی</option>
                                        <option value="علمی-تخیلی">علمی-تخیلی</option>
                                        <option value="وسترن">وسترن</option>
                                        <option value="هیجان انگیز">هیجان انگیز</option>
                                        <option value="مستند">مستند</option>
                                        <option value="خانوادگی">خانوادگی</option>
                                        <option value="فانتزی">فانتزی</option>
                                        <option value="ترسناک">ترسناک</option>
                                        <option value="ورزشی">ورزشی</option>
                                        <option value="کوتاه">کوتاه</option>
                                        <option value="عاشقانه">عاشقانه</option>
                                    </select>

                                <select class="catalog__select"  onChange="window.location.href='year/films/' + this.options[this.selectedIndex].value">
                                    <option value="All the years">همه سال ها</option>
                                    <option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                </select>
                            </div>

                            <div class="slider-radio">
                                <input type="radio" name="grade" id="featured" checked="checked"><label for="featured"><a
                                        href="{{route('films')}}">فیلم</a></label>
                            </div>
                        </div>

                        <div class="row row--grid">
                            @foreach($videos as $video)
                            <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                                <div class="card">
                                    <a href="{{route('single_film' , $video->title)}}" class="card__cover">
                                        <img src="{{$video->image}}" alt="">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M11 1C16.5228 1 21 5.47716 21 11C21 16.5228 16.5228 21 11 21C5.47716 21 1 16.5228 1 11C1 5.47716 5.47716 1 11 1Z" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0501 11.4669C13.3211 12.2529 11.3371 13.5829 10.3221 14.0099C10.1601 14.0779 9.74711 14.2219 9.65811 14.2239C9.46911 14.2299 9.28711 14.1239 9.19911 13.9539C9.16511 13.8879 9.06511 13.4569 9.03311 13.2649C8.93811 12.6809 8.88911 11.7739 8.89011 10.8619C8.88911 9.90489 8.94211 8.95489 9.04811 8.37689C9.07611 8.22089 9.15811 7.86189 9.18211 7.80389C9.22711 7.69589 9.30911 7.61089 9.40811 7.55789C9.48411 7.51689 9.57111 7.49489 9.65811 7.49789C9.74711 7.49989 10.1091 7.62689 10.2331 7.67589C11.2111 8.05589 13.2801 9.43389 14.0401 10.2439C14.1081 10.3169 14.2951 10.5129 14.3261 10.5529C14.3971 10.6429 14.4321 10.7519 14.4321 10.8619C14.4321 10.9639 14.4011 11.0679 14.3371 11.1549C14.3041 11.1999 14.1131 11.3999 14.0501 11.4669Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </a>
                                    <form action="{{route('interest-film')}}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{$special->title}}" name="title">
                                        <input type="hidden" value="{{$special->id}}" name="interestable_id">
                                        <input type="hidden" value="{{get_class($special)}}" name="interestable_type">
                                        <button class="card__add" type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16,2H8A3,3,0,0,0,5,5V21a1,1,0,0,0,.5.87,1,1,0,0,0,1,0L12,18.69l5.5,3.18A1,1,0,0,0,18,22a1,1,0,0,0,.5-.13A1,1,0,0,0,19,21V5A3,3,0,0,0,16,2Zm1,17.27-4.5-2.6a1,1,0,0,0-1,0L7,19.27V5A1,1,0,0,1,8,4h8a1,1,0,0,1,1,1Z"/></svg></button>
                                    </form>
                                    <span class="card__rating"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z"/></svg> 8.3</span>
                                    <h3 class="card__title"><a href="{{route('single_film' , $video->title)}}">{{$video->title}}</a></h3>
                                    <ul class="card__list">
                                        <li>رایگان</li>
                                        <li>{{$video->country}}</li>
                                        <li>{{$video->year}}</li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <a class="catalog__more" href="{{route('films')}}">نمایش بیشتر</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end catalog -->


        <!-- subscriptions -->
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="section__title">ویژه ترین فیلم ها</h2>
                    </div>

                    <div class="col-12">
                        <div class="section__carousel-wrap">
                            <div class="section__carousel owl-carousel" id="subscriptions">

                                @foreach($specialvideos as $special)
                                <div class="card">
                                    <a href="{{route('single_film' , $special->title)}}" class="card__cover">
                                        <img src="{{$special->image}}" alt="">
                                        <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.1615 8.05308C13.1615 9.79908 11.7455 11.2141 9.9995 11.2141C8.2535 11.2141 6.8385 9.79908 6.8385 8.05308C6.8385 6.30608 8.2535 4.89108 9.9995 4.89108C11.7455 4.89108 13.1615 6.30608 13.1615 8.05308Z" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M9.998 15.3549C13.806 15.3549 17.289 12.6169 19.25 8.05289C17.289 3.48888 13.806 0.750885 9.998 0.750885H10.002C6.194 0.750885 2.711 3.48888 0.75 8.05289C2.711 12.6169 6.194 15.3549 10.002 15.3549H9.998Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </a>
                                    <form action="{{route('interest-film')}}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{$special->title}}" name="title">
                                        <input type="hidden" value="{{$special->id}}" name="interestable_id">
                                        <input type="hidden" value="{{get_class($special)}}" name="interestable_type">
                                        <button class="card__add" type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16,2H8A3,3,0,0,0,5,5V21a1,1,0,0,0,.5.87,1,1,0,0,0,1,0L12,18.69l5.5,3.18A1,1,0,0,0,18,22a1,1,0,0,0,.5-.13A1,1,0,0,0,19,21V5A3,3,0,0,0,16,2Zm1,17.27-4.5-2.6a1,1,0,0,0-1,0L7,19.27V5A1,1,0,0,1,8,4h8a1,1,0,0,1,1,1Z"/></svg></button>
                                    </form>
                                    <h3 class="card__title card__title--subs"><a href="{{route('single_film' , $special->title)}}"> {{$special->title}} </a></h3>
                                    <ul class="card__list card__list--subs">
                                        <li>{{$special->genre_one}}</li>
                                    </ul>
                                </div>
                                @endforeach


                            </div>

                            <button class="section__nav section__nav--cards section__nav--prev" data-nav="#subscriptions" type="button"><svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.25 7.72559L16.25 7.72559" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.2998 1.70124L1.2498 7.72524L7.2998 13.7502" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                            <button class="section__nav section__nav--cards section__nav--next" data-nav="#subscriptions" type="button"><svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.75 7.72559L0.75 7.72559" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9.7002 1.70124L15.7502 7.72524L9.7002 13.7502" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end subscriptions -->

        <!-- catalog -->
        <div class="catalog">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="catalog__nav">
                            <div class="catalog__select-wrap">
                                <select class="catalog__select" onChange="window.location.href='genre/serials/' + this.options[this.selectedIndex].value">
                                    <option value="All genres">همه سبک ها</option>
                                    <option value="اکشن">اکشن</option>
                                    <option value="انیمیشن">انیمیشن</option>
                                    <option value="درام">درام</option>
                                    <option value="کمدی">کمدی</option>
                                    <option value="علمی">علمی</option>
                                    <option value="علمی-تخیلی">علمی-تخیلی</option>
                                    <option value="وسترن">وسترن</option>
                                    <option value="هیجان انگیز">هیجان انگیز</option>
                                    <option value="مستند">مستند</option>
                                    <option value="خانوادگی">خانوادگی</option>
                                    <option value="فانتزی">فانتزی</option>
                                    <option value="ترسناک">ترسناک</option>
                                    <option value="ورزشی">ورزشی</option>
                                    <option value="کوتاه">کوتاه</option>
                                    <option value="عاشقانه">عاشقانه</option>
                                </select>

                                <select class="catalog__select"  onChange="window.location.href='year/serials/' + this.options[this.selectedIndex].value">
                                    <option value="All the years">همه سال ها</option>
                                    <option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                </select>

                            </div>

                            <div class="slider-radio">
                                <input type="radio" name="grade" id="featured" checked="checked"><label for="featured"><a
                                        href="{{route('serials')}}">سریال</a></label>
                            </div>
                        </div>

                        <div class="row row--grid">


                            @foreach($serials as $serial)
                            <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                                <div class="card">
                                    <a href="{{route('single_serial' , $serial->title)}}" class="card__cover">
                                        <img src="{{$serial->image}}" alt="">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M11 1C16.5228 1 21 5.47716 21 11C21 16.5228 16.5228 21 11 21C5.47716 21 1 16.5228 1 11C1 5.47716 5.47716 1 11 1Z" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0501 11.4669C13.3211 12.2529 11.3371 13.5829 10.3221 14.0099C10.1601 14.0779 9.74711 14.2219 9.65811 14.2239C9.46911 14.2299 9.28711 14.1239 9.19911 13.9539C9.16511 13.8879 9.06511 13.4569 9.03311 13.2649C8.93811 12.6809 8.88911 11.7739 8.89011 10.8619C8.88911 9.90489 8.94211 8.95489 9.04811 8.37689C9.07611 8.22089 9.15811 7.86189 9.18211 7.80389C9.22711 7.69589 9.30911 7.61089 9.40811 7.55789C9.48411 7.51689 9.57111 7.49489 9.65811 7.49789C9.74711 7.49989 10.1091 7.62689 10.2331 7.67589C11.2111 8.05589 13.2801 9.43389 14.0401 10.2439C14.1081 10.3169 14.2951 10.5129 14.3261 10.5529C14.3971 10.6429 14.4321 10.7519 14.4321 10.8619C14.4321 10.9639 14.4011 11.0679 14.3371 11.1549C14.3041 11.1999 14.1131 11.3999 14.0501 11.4669Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </a>
                                    <form action="{{route('interest-serial')}}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{$special->title}}" name="title">
                                        <input type="hidden" value="{{$special->id}}" name="interestable_id">
                                        <input type="hidden" value="{{get_class($special)}}" name="interestable_type">
                                        <button class="card__add" type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16,2H8A3,3,0,0,0,5,5V21a1,1,0,0,0,.5.87,1,1,0,0,0,1,0L12,18.69l5.5,3.18A1,1,0,0,0,18,22a1,1,0,0,0,.5-.13A1,1,0,0,0,19,21V5A3,3,0,0,0,16,2Zm1,17.27-4.5-2.6a1,1,0,0,0-1,0L7,19.27V5A1,1,0,0,1,8,4h8a1,1,0,0,1,1,1Z"/></svg></button>
                                    </form>
                                    <span class="card__rating"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z"/></svg> 7.0</span>
                                    <h3 class="card__title"><a href="{{route('single_serial' , $serial->title)}}">{{$serial->title}}</a></h3>
                                    <ul class="card__list">
                                        <li>رایگان</li>
                                        <li>{{$serial->genre_one}}</li>
                                        <li>{{$serial->year}}</li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <a class="catalog__more" href="{{route('serials')}}">نمایش بیشتر</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end catalog -->


        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="section__title"><b>سریال </b>ویژه ترین ها </h2>
                        <p class="section__text"> ویژه ترین سریال ها را از این قسمت دنبال کنید</p>
                    </div>

                    <div class="col-12">
                        <div class="section__carousel-wrap">
                            <div class="section__interview owl-carousel owl-loaded" id="flixtv">
                                <div class="owl-stage-outer owl-height" style="height: 311.703px;">
                                    <div class="owl-stage" style="transform: translate3d(-2280px, 0px, 0px); transition: all 1.8s ease 0s; width: 4560px;">
                                        @foreach($specialserials as $special)
                                        <div class="owl-item cloned" style="width: 350px; margin-right: 30px;"><div class="interview">
                                                <a href="{{route('single_serial' , $special->title)}}" class="interview__cover">
                                                    <img src="{{$special->image}}" alt="">
                                                    <span>
										<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M11 1C16.5228 1 21 5.47716 21 11C21 16.5228 16.5228 21 11 21C5.47716 21 1 16.5228 1 11C1 5.47716 5.47716 1 11 1Z" stroke-linecap="round" stroke-linejoin="round"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0501 11.4669C13.3211 12.2529 11.3371 13.5829 10.3221 14.0099C10.1601 14.0779 9.74711 14.2219 9.65811 14.2239C9.46911 14.2299 9.28711 14.1239 9.19911 13.9539C9.16511 13.8879 9.06511 13.4569 9.03311 13.2649C8.93811 12.6809 8.88911 11.7739 8.89011 10.8619C8.88911 9.90489 8.94211 8.95489 9.04811 8.37689C9.07611 8.22089 9.15811 7.86189 9.18211 7.80389C9.22711 7.69589 9.30911 7.61089 9.40811 7.55789C9.48411 7.51689 9.57111 7.49489 9.65811 7.49789C9.74711 7.49989 10.1091 7.62689 10.2331 7.67589C11.2111 8.05589 13.2801 9.43389 14.0401 10.2439C14.1081 10.3169 14.2951 10.5129 14.3261 10.5529C14.3971 10.6429 14.4321 10.7519 14.4321 10.8619C14.4321 10.9639 14.4011 11.0679 14.3371 11.1549C14.3041 11.1999 14.1131 11.3999 14.0501 11.4669Z" stroke-linecap="round" stroke-linejoin="round"></path></svg> {{$special->time}}
									</span>
                                                </a>
                                                <h3 class="interview__title"><a href="{{route('single_serial' , $special->title)}}">{{$special->title}}</a></h3>
                                            </div></div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots disabled"></div></div>

                            <button class="section__nav section__nav--interview section__nav--prev" data-nav="#flixtv" type="button"><svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.25 7.72559L16.25 7.72559" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M7.2998 1.70124L1.2498 7.72524L7.2998 13.7502" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></button>
                            <button class="section__nav section__nav--interview section__nav--next" data-nav="#flixtv" type="button"><svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.75 7.72559L0.75 7.72559" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M9.7002 1.70124L15.7502 7.72524L9.7002 13.7502" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- plan -->
        <section class="section section--pb0 section--gradient">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="section__title">پلن های اشتراک</h2>
                        <p class="section__text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ.</p>
                    </div>
                </div>

                <div dir="rtl" class="row">
                    @foreach($plans as $plan)
                    <div class="col-12 col-md-6 col-xl-4 order-md-2 order-xl-1">

                        <div class="plan {{isBest($plan->title)}}">
                            <h3 class="plan__title">{{$plan->title}}</h3>
                            <ul class="plan__list">
                                <li class="green"><svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.43994 6.95981L6.77477 12.2924L17.4399 1.62723" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> فلیکس تی وی اصل</li>
                                <li class="green"><svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.43994 6.95981L6.77477 12.2924L17.4399 1.62723" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> جا به جایی بین پلن یا لغو در هر زمان</li>
                                <li class="red"><svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.596 1.59982L1.60938 17.5865" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M17.601 17.5961L1.60101 1.5928" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> +65 پخش زنده برتر</li>
                                <li class="red"><svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.596 1.59982L1.60938 17.5865" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M17.601 17.5961L1.60101 1.5928" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> کانال های تلویزیونی</li>
                            </ul>
                            <span class="plan__price">{{number_format($plan->price)}} ت <span>/  {{$plan->time_month}} ماهه </span></span>
                            @if(auth()->user())
                                <a class="plan__btn" href="{{route('single-plan' , $plan->id)}}">انتخاب پلن</a>
                            @else
                                <a class="plan__btn" href="{{route('auth.login')}}">ورود به سایت</a>
                            @endif
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- end plan -->


@endsection
