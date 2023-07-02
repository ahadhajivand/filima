@extends('home.master')

@section('content')

    <!-- details -->
    <section class="section section--head section--head-fixed section--gradient section--details-bg">
        <div class="section__bg" data-bg="{{$serial->image}}"></div>
        <div class="container">
            <!-- article -->
            <div class="article">
                <div  class="row">
                    <div class="col-12 col-xl-8">
                        <!-- trailer -->

                            <form action="{{route('interest-serial')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$serial->title}}" name="title">
                                <input type="hidden" value="{{$serial->id}}" name="interestable_id">
                                <input type="hidden" value="{{get_class($serial)}}" name="interestable_type">
                                <button class="article__favorites" type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16,2H8A3,3,0,0,0,5,5V21a1,1,0,0,0,.5.87,1,1,0,0,0,1,0L12,18.69l5.5,3.18A1,1,0,0,0,18,22a1,1,0,0,0,.5-.13A1,1,0,0,0,19,21V5A3,3,0,0,0,16,2Zm1,17.27-4.5-2.6a1,1,0,0,0-1,0L7,19.27V5A1,1,0,0,1,8,4h8a1,1,0,0,1,1,1Z"></path></svg> افزودن به علاقه مندی</button>
                            </form>

                        <!-- end trailer -->

                        <!-- article content -->
                        <div class="article__content">
                            <h1>{{$serial->title}}</h1>

                            <ul class="list">
                                <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z"/></svg> 9.7</li>
                                @foreach($serial->categories as $cate)
                                    @if($cate->title == "سریال")
                                        <li>{{$cate->title}}</li>
                                    @endif
                                @endforeach

                                <li>{{$serial->year}}</li>
                                <li>{{$serial->country}}</li>
                                <li>{{$serial->time}}</li>
                                <li>{{$serial->language}}</li>
                                <li>{{$serial->age_category}}</li>
                                <li>
                                      </li>
                            </ul>


                            <p>{{$serial->synopsis}}</p>

                        </div>
                        <!-- end article content -->
                    </div>

                    <div class="col-12 col-xl-8">

                        <!-- categories -->
                        <div class="categories">
                            <h3 class="categories__title">سبک ها</h3>

                            @if($serial->categories->count() != 0)
                            @foreach($serial->categories as $cate)
                                @if($cate->parent != 0)
                                    <a href="" class="categories__item">{{$cate->title}}</a>
                                    @else
                                        <a href="" class="m-3">{{$serial->genre_one}}</a>
                                        <a href="" class="m-3">{{$serial->genre_two}}</a>
                                        <a href="" class="m-3">{{$serial->genre_three}}</a>
                                    @endif
                            @endforeach
                            @endif

                        </div>
                        <!-- end categories -->

                    </div>
                    @if(auth()->user())
                    @if(auth()->user()->isActive())
                    <div class="col-12 col-xl-8">
                        @foreach($links as $link)
                        <div class="article__actions article__actions--details">
                            <div class="article__download">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21,14a1,1,0,0,0-1,1v4a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V15a1,1,0,0,0-2,0v4a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V15A1,1,0,0,0,21,14Zm-9.71,1.71a1,1,0,0,0,.33.21.94.94,0,0,0,.76,0,1,1,0,0,0,.33-.21l4-4a1,1,0,0,0-1.42-1.42L13,12.59V3a1,1,0,0,0-2,0v9.59l-2.29-2.3a1,1,0,1,0-1.42,1.42Z"></path></svg>
                                فصل {{$link->title_session}} :
                                 {{$link->title_part}} :
                                <a href="{{$link->link_download}}" download="#">{{$link->title_quality}}</a>
                            </div>
                            <!-- add .active class -->
                           </div>
                        @endforeach
                    </div>
                    @else
                        <div class="col-12 col-xl-8">
                        <a href="{{route('profile')}}" class="categories__item">خرید اشتراک</a>
                        </div>
                    @endif
                    @else
                        <div class="col-12 col-xl-8">
                            <a href="{{route('auth.login')}}" class="categories__item">برای دانلود سریال وارد سایت شوید</a>
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-12 col-xl-12">
                        <!-- comments and reviews -->
                        <div class="comments">
                            <!-- tabs -->
                            <div class="tab-content">
                                <!-- comments -->
                                <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                                    <ul class="comments__list">
                                        @foreach($comments as $comment)
                                            <li class="reviews__item">
                                                <div class="reviews__autor">
                                                    <img class="reviews__avatar" src="img/avatar.svg" alt="">
                                                    <span class="reviews__name">{{$comment->title}}</span>
                                                    <span class="reviews__time">{{jdate($comment->create_at)->format('%d, %B، %Y')}}  {{$comment->user->name}} :توسط</span>
                                                    <span class="reviews__rating"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"></svg>   رتبه:  {{$comment->rank}}</span>
                                                </div>
                                                <p class="reviews__text">{{$comment->comment}}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @auth
                                    <form action="{{route('film-comment' , $serial->title)}}" class="reviews__form" method="post">
                                        @csrf
                                        <input type="hidden" name="commentable_id" value="{{$serial->id}}">
                                        <input type="hidden" name="commentable_type" value="{{get_class($serial)}}">
                                        <input type="hidden" name="parent" value="0">
                                        <div class="row">
                                            <div class="col-12 col-md-9 col-lg-10 col-xl-9">
                                                <div class="sign__group">
                                                    <input type="text" name="title" class="sign__input" placeholder="عنوان">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-3 col-lg-2 col-xl-3">
                                                <div class="sign__group">
                                                    <select name="rank" id="select" class="sign__select">
                                                        <option value="0">رتبه بندی</option>
                                                        <option value="10">10</option>
                                                        <option value="9">9</option>
                                                        <option value="8">8</option>
                                                        <option value="7">7</option>
                                                        <option value="6">6</option>
                                                        <option value="5">5</option>
                                                        <option value="4">4</option>
                                                        <option value="3">3</option>
                                                        <option value="2">2</option>
                                                        <option value="1">1</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="sign__group">
                                                    <textarea id="text2" name="comment" class="sign__textarea" placeholder="افزودن نظر"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="sign__btn">ارسال</button>
                                            </div>
                                        </div>
                                    </form>
                                    @endauth
                                </div>
                                <!-- end comments -->
                            </div>
                            <!-- end tabs -->
                        </div>
                        <!-- end comments and reviews -->
                    </div>
                </div>
            </div>
            <!-- end article -->
        </div>
    </section>
    <!-- end details -->

    <!-- similar -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section__title"><a href="">سریال های تلویزیونی مشابه</a></h2>
                </div>

                <div class="col-12">
                    <div class="section__carousel-wrap">
                        <div class="section__carousel owl-carousel" id="similar">
                            @foreach($similars as $similar)
                                @php
                                    $films = $serials->where('id' ,  $similar->similar_id)->all();
                                @endphp
                                @foreach($films as $film)
                                    <div class="card">
                                        <a href="{{route('single_serial' , $film->title)}}" class="card__cover">
                                            <img src="{{$film->image}}" alt="">
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M11 1C16.5228 1 21 5.47716 21 11C21 16.5228 16.5228 21 11 21C5.47716 21 1 16.5228 1 11C1 5.47716 5.47716 1 11 1Z" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0501 11.4669C13.3211 12.2529 11.3371 13.5829 10.3221 14.0099C10.1601 14.0779 9.74711 14.2219 9.65811 14.2239C9.46911 14.2299 9.28711 14.1239 9.19911 13.9539C9.16511 13.8879 9.06511 13.4569 9.03311 13.2649C8.93811 12.6809 8.88911 11.7739 8.89011 10.8619C8.88911 9.90489 8.94211 8.95489 9.04811 8.37689C9.07611 8.22089 9.15811 7.86189 9.18211 7.80389C9.22711 7.69589 9.30911 7.61089 9.40811 7.55789C9.48411 7.51689 9.57111 7.49489 9.65811 7.49789C9.74711 7.49989 10.1091 7.62689 10.2331 7.67589C11.2111 8.05589 13.2801 9.43389 14.0401 10.2439C14.1081 10.3169 14.2951 10.5129 14.3261 10.5529C14.3971 10.6429 14.4321 10.7519 14.4321 10.8619C14.4321 10.9639 14.4011 11.0679 14.3371 11.1549C14.3041 11.1999 14.1131 11.3999 14.0501 11.4669Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </a>
                                        <form action="{{route('interest-serial')}}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$film->title}}" name="title">
                                            <input type="hidden" value="{{$film->id}}" name="interestable_id">
                                            <input type="hidden" value="{{get_class($film)}}" name="interestable_type">
                                        <button class="card__add" type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16,2H8A3,3,0,0,0,5,5V21a1,1,0,0,0,.5.87,1,1,0,0,0,1,0L12,18.69l5.5,3.18A1,1,0,0,0,18,22a1,1,0,0,0,.5-.13A1,1,0,0,0,19,21V5A3,3,0,0,0,16,2Zm1,17.27-4.5-2.6a1,1,0,0,0-1,0L7,19.27V5A1,1,0,0,1,8,4h8a1,1,0,0,1,1,1Z"/></svg></button>
                                        </form>
                                        <span class="card__rating"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z"/></svg> 8.3</span>
                                        <h3 class="card__title"><a href="{{route('single_serial' , $film->title)}}">{{$film->title}}</a></h3>
                                        <ul class="card__list">
                                            <li>رایگان</li>
                                            <li>{{$film->genre_one}}</li>
                                            <li>{{$film->country}}</li>
                                        </ul>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>

                        <button class="section__nav section__nav--cards section__nav--prev" data-nav="#similar" type="button"><svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.25 7.72559L16.25 7.72559" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.2998 1.70124L1.2498 7.72524L7.2998 13.7502" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                        <button class="section__nav section__nav--cards section__nav--next" data-nav="#similar" type="button"><svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.75 7.72559L0.75 7.72559" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9.7002 1.70124L15.7502 7.72524L9.7002 13.7502" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end similar -->

@endsection
