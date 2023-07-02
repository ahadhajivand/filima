<ul>
    @foreach($categories as $category)
        <form action="{{route('admin.categories.destroy', $category->id)}}" method="post" id="category-{{$category->id}}-delete">
            @csrf
            @method('delete')
        </form>
        <li>


            <a href="#" onclick="event.preventDefault(); document.getElementById('category-{{$category->id}}-delete').submit()"><i class="fa fa-trash-o red"></i></a>
            <a href="{{route('admin.categories.edit', $category->id)}}" class=""><i class="fa fa-edit"></i></a>
            <a href="{{route('category-single' , $category->slug)}}" style="color: black" target="_blank">{{$category->title}}</a>

            @if($category->child->count())
                @include('Admin.categories.managechilds' , ['categories' => $category->child])
            @endif
        </li>
    @endforeach

</ul>

