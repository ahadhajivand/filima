@component('Admin.layouts.content',['title' => 'جزئیات سریال'])
    @slot('breadcrumb')
        <li class="breadcrumb-item active">جزئیات سریال </li>
        <li class="breadcrumb-item"><a href="{{route('admin.')}}">خانه</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.serials.index')}}" class="btn btn-sm btn-warning">لیست سریال ها</a></li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">جزپیات سریال</h4>
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
                        <p>در جدول زیر می توانید جزپیات سریال منتخب را مشاهده کنید.</p>
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
                                        <span>عنوان سریال</span>
                                    </th>
                                    <td>{{$serial->title}}</td>
                                </tr>


                                <tr>
                                    <th scope="row">
                                        <span>امتیاز imdb</span>
                                    </th>
                                    <td>{{$serial->imdb}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <span>تصویر شاخص سریال</span>
                                    </th>
                                    <td>
                                        <img class="w-25" src="{{$serial->image}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <span>رده ی سنی سریال</span>
                                    </th>
                                    <td>{{$serial->age_category}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <span>کشور سازنده</span>
                                    </th>
                                    <td>{{$serial->country}}</td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                        <span>زبان سریال</span>
                                    </th>
                                    <td>{{$serial->language}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <span>خلاصه سریال</span>
                                    </th>
                                    <td>{{$serial->synopsis}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <span>سال تولید سریال</span>
                                    </th>
                                    <td>{{$serial->year}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <span>ژانر سریال </span>
                                    </th>
                                    <td>{{$serial->genre_one}},{{$serial->genre_two}},{{$serial->genre_three}}</td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                        <span>افزودن لینک دانلود سریال</span>
                                    </th>
                                 <td>
                                     <form action="{{route('admin.serial-link-index')}}" method="post">
                                         @csrf
                                         <input type="hidden" value="{{$serial->link_serial}}" name="link_serial">
                                         <input type="hidden" value="{{$serial->id}}" name="id">
                                         <button class="btn btn-sm btn-info" type="submit">افزودن لینک</button>
                                     </form>
                                 </td>
                                </tr>



                                </tbody>
                            </table>
                            <a href="{{route('admin.serials.index')}}" class="btn btn-sm btn-danger">بازگشت</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endcomponent
