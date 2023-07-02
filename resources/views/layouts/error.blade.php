@if($errors->any())
    <div class="alert alert-danger" style="background:red; border-radius: 13px ; padding: 5px">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
