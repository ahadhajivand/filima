@component('Admin.layouts.content',['title' => 'جزئیات فیلم'])
    @slot('breadcrumb')
        <li class="breadcrumb-item active">جزئیات فیلم </li>
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">خانه</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.films.index')}}" class="btn btn-sm btn-warning">لیست فیلم ها</a></li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">جزپیات فیلم</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <p>در جدول زیر می توانید جزپیات فیلم منتخب را مشاهده کنید.</p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-bold-500">عنوان جزییات</th>
                                    <th class="text-bold-500">شرح</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">
                                        <span>عنوان فیلم</span>
                                    </th>
                                    <td>{{$video->title}}</td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                        <span>امتیاز imdb</span>
                                    </th>
                                    <td>{{$video->imdb}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <span>تصویر شاخص فیلم</span>
                                    </th>
                                    <td>
                                        <img class="w-25" src="{{$video->image}}">
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                        <span>کشور سازنده</span>
                                    </th>
                                    <td>{{$video->country}}</td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                        <span>زبان فیلم</span>
                                    </th>
                                    <td>{{$video->language}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <span>خلاصه فیلم</span>
                                    </th>
                                    <td>{{$video->synopsis}}</td>
                                </tr>


                                <tr>
                                    <th scope="row">
                                        <span>ژانر فیلم</span>
                                    </th>

                                    <td>
                                        {{$video->genre_one}},  {{$video->genre_two}},   {{$video->genre_three}}
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                            <a href="{{route('admin.films.index')}}" class="btn btn-sm btn-danger">بازگشت</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endcomponent
