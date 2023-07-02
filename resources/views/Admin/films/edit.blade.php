@component('Admin.layouts.content',['title' => 'ویرایش فیلم'])
    @slot('breadcrumb')
        <li class="breadcrumb-item active">ویرایش فیلم </li>
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">خانه</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.films.index')}}" class="btn btn-sm btn-warning">لیست فیلم ها</a></li>
    @endslot


    @slot('script')

        <script>
            document.addEventListener("DOMContentLoaded", function() {

                document.getElementById('button-image').addEventListener('click', (event) => {
                    event.preventDefault();

                    window.open('/file-manager/fm-button', 'fm', 'width=1000,height=600');
                });
            });

            // set file link
            function fmSetLink($url) {
                document.getElementById('image_label').value = $url;
            }
        </script>
    @endslot


    <section id="basic-form-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card" style="height: 1900px;">
                    <div class="card-header">
                        @include('Admin.layouts.errors')
                        <h4 class="card-title" id="basic-layout-colored-form-control">فرم ویرایش اطلاعات فیلم</h4>
                        <a class="heading-elements-toggle">
                            <i class="la la-ellipsis-v font-medium-3"></i>
                        </a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li>
                                    <a data-action="collapse">
                                        <i class="ft-minus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-action="reload">
                                        <i class="ft-rotate-cw"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-action="expand">
                                        <i class="ft-maximize"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-action="close">
                                        <i class="ft-x"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">

                            <div class="card-text">
                                <p></p>
                            </div>

                            <form class="form" action="{{route('admin.films.update' , $video->id)}}" method="post">
                                @csrf
                                @method('patch')
                                <div class="form-body">

                                    <h4 class="form-section">
                                        <i class="ft-briefcase"></i> اطلاعات فیلم</h4>


                                    <div class="form-group">
                                        <label for="contactinput5">نام فیلم</label>
                                        <input class="form-control border-primary" name="title" type="text" placeholder="نام اوریجینال فیلم" id="contactinput5" value="{{old('title' , $video->title)}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="contactinput5">انتخاب تصویر</label>
                                        <div class="input-group">
                                            <input type="text" id="image_label" class="form-control" name="image" dir="ltr" value="{{$video->image}}">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" id="button-image">انتخاب</button>
                                            </div>
                                        </div>
                                        <hr>
                                        <img class="w-25" src="{{$video->image}}">
                                    </div>


                                    <div class="form-group">
                                        <label for="contactinput5">امتیاز imdb از 10</label>
                                        <input class="form-control border-primary" name="imdb" type="text" placeholder="امتیاز imdb" id="contactinput5" value="{{old('imdb' , $video->imdb)}}">
                                    </div>



                                    <div class="form-group">
                                        <label for="contactinput5"> کشور سازنده</label>
                                        <input class="form-control border-primary" name="country" type="text" placeholder="کشور سازنده" id="contactinput5" value="{{old('country' , $video->country)}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="contactinput5"> سال ساخت </label>
                                        <input class="form-control border-primary" name="year" type="text" placeholder="سال ساخت" id="contactinput5" value="{{old('country' , $video->year)}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="contactinput5"> زمان فیلم  مثال : 43 دقیقه</label>
                                        <input class="form-control border-primary" name="time" type="text" placeholder="زمان فیلم" id="contactinput5" value="{{old('time' , $video->time)}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="contactinput5"> زبان فیلم </label>
                                        <input class="form-control border-primary" name="language" type="text" placeholder="زبان فیلم" id="contactinput5" value="{{old('language' , $video->language)}}">
                                    </div>


                                    <div class="form-group">
                                        <label for="contactinput5"> خلاصه داستان </label>
                                        <textarea name="synopsis" id="description" class="form-control"  cols="30" rows="4" placeholder="خلاصه داستان">{{old('synopsis' , $video->synopsis)}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="contactinput5">ژانر اول فیلم </label>
                                        <input class="form-control border-primary" name="genre_one" type="text" placeholder="  ژانر  فیلم " id="contactinput5" value="{{old('genre_one' , $video->genre_one)}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="contactinput5">ژانر دوم فیلم </label>
                                        <input class="form-control border-primary" name="genre_two" type="text" placeholder="  ژانر  فیلم " id="contactinput5" value="{{old('genre_two' , $video->genre_two)}}">
                                    </div>


                                    <div class="form-group">
                                        <label for="contactinput5">ژانر سوم فیلم </label>
                                        <input class="form-control border-primary" name="genre_three" type="text" placeholder="  ژانر  فیلم " id="contactinput5" value="{{old('genre_three' , $video->genre_three)}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="contactinput5">لینک دانلود فیلم کیفیت(1080p) </label>
                                        <input class="form-control border-primary" name="link_download_one" type="text" placeholder="لینک دانلود فیلم" id="contactinput5" value="{{old('link_download_one' , $video->link_download_one)}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="contactinput5">لینک دانلود فیلم کیفیت(720p) </label>
                                        <input class="form-control border-primary" name="link_download_two" type="text" placeholder=" لینک دانلود فیلم " id="contactinput5" value="{{old('link_download_two' , $video->link_download_two)}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="contactinput5">لینک دانلود فیلم کیفیت(480p) </label>
                                        <input class="form-control border-primary" name="link_download_three" type="text" placeholder="  لینک دانلود فیلم " id="contactinput5" value="{{old('link_download_three' , $video->link_download_three)}}">
                                    </div>



                                    <div class="form-group mt-1">
                                        <input type="checkbox" name="status" id="switcheryColor4" class="switchery" data-color="success" data-secondary-color="success" checked="" data-switchery="true" style="display: none;">
                                        <label for="switcheryColor4" class="card-title ml-1">فیلم فعال باشد</label>
                                    </div>

                                        <div class="form-group mt-1">
                                            <input type="checkbox" name="new" id="switcheryColor4" class="switchery" data-color="success" data-secondary-color="success" checked="" data-switchery="true" style="display: none;">
                                            <label for="switcheryColor4" class="card-title ml-1">فیلم جدید </label>
                                        </div>

                                        <div class="form-group mt-1">
                                            <input type="checkbox" name="special" id="switcheryColor4" class="switchery" data-color="success" data-secondary-color="success" checked="" data-switchery="true" style="display: none;">
                                            <label for="switcheryColor4" class="card-title ml-1">فیلم ویژه </label>
                                        </div>


                                </div>

                                <div class="form-actions right ">
                                    <a href="{{route('admin.films.index')}}" type="button" class="btn btn-danger mr-1">
                                        <i class="ft-x"></i> لغو
                                    </a>
                                    <button type="submit" class="btn btn-primary ">
                                        <i class="la la-check-square-o"></i> ذخیره
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endcomponent
