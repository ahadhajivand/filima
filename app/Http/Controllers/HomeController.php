<?php

namespace App\Http\Controllers;


use App\Jobs\DetailSerial;
use App\Jobs\DetailVideo;
use App\Jobs\LinkSerial;
use App\Jobs\PSerial;
use App\Jobs\PVideo;
use App\Models\Category;
use App\Models\Plan;
use App\Models\SerialLink;
use App\Models\SimilarSerial;
use App\Models\SimilarVideo;
use App\Models\SingleSerial;
use App\Models\SingleVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{

    public function single_film(\App\Models\DetailVideo $video , Request $request)
    {
        $similars = SimilarVideo::query();
        $videos = \App\Models\DetailVideo::all();
        $video = $videos->where('title' , '=' ,$request->title)->first();
        $similars = $similars->where('similarable_id' , $video->id)->get()->all();
        $comments = $video->comments()->get();
        $comments = $comments->where('approve' , 1)->all();
        return view('home.films.single' , compact('video' , 'comments' , 'similars' , 'videos'));
    }

    public function single_serial(\App\Models\DetailSerial $serial , Request $request)
    {
        $similars = SimilarSerial::query();
        $serials = \App\Models\DetailSerial::all();
        $serial = $serials->where('title' , '=' ,$request->title)->first();
        $similars = $similars->where('similarable_id' , $serial->id)->get()->all();
        $links = SerialLink::query();
        $comments = $serial->comments()->get();
        $comments = $comments->where('approve' , 1)->all();
        if (is_null($serial->link_serial))
        {
            if ( $links = $links->where('link_serial' , 'like' , $serial->id)->get()->all())
            {
                return view('home.serials.single' , compact('serial' , 'similars', 'serials' , 'links' , 'comments'));
            }
            //        alert()->success('لطفا لینک سریال را اضافه کنید','موفق آمیز')->persistent('متشکرم');
            return back();
        }
        $links = $links->where('link_serial' , 'like' , $serial->link_serial)->get()->all();
        return view('home.serials.single' , compact('serial' , 'similars' ,  'serials' , 'links' , 'comments'));
    }

    public function categoryList(Request $request)
    {
        $categories =Category::query();
        $category = $categories->where('parent' , 0)->where('slug' , 'like' , $request->slug)->first();

       if ($category->title == "فیلم")
       {
           $videos = \App\Models\DetailVideo::query();
           $videos = $videos->latest()->paginate(18);
           return view('home.films.all' , compact('videos'));
       }
        if ($category->title == "سریال")
        {
            $serials = \App\Models\DetailSerial::query();
            $serials = $serials->latest()->paginate(18);
            return view('home.serials.all' , compact('serials'));
        }
    }

    public function comment(Request $request)
    {

        $data = $request->validate([
            'commentable_id' => 'required',
            'commentable_type' => 'required',
            'comment' => 'required',
            'title' => 'required',
            'parent' => 'required',
            'rank' => 'required'
        ]);

        auth()->user()->comments()->create($data);
//        alert()->success('نظر شما با موفقیت ثبت شد.', 'موفق امیز')->persistent('متشکرم');
        return back();
    }

    public function films()
    {
        $videos = \App\Models\DetailVideo::query();
        $videos = $videos->latest()->paginate(18);
        return view('home.films.all' , compact('videos'));
    }

    public function serials()
    {
        $serials = \App\Models\DetailSerial::query();
        $serials = $serials->latest()->paginate(18);
        return view('home.serials.all' , compact('serials'));
    }



    public function search()
    {
        $videos = \App\Models\DetailVideo::query();

        if ($key = \request('search')) {
            $videos->where('title', 'like', "%$key%");
        }
        $list_films = $videos->paginate(3);

        $serials = \App\Models\DetailSerial::query();

        if ($key = \request('search')) {
            $serials->where('title', 'like', "%$key%");
        }
        $list_serials= $serials->paginate(3);

        return view('home.search.result-search', compact('list_films' , 'list_serials' , 'key'));
    }

    public function searchGenreFilm(Request $request)
    {
           $genre = \App\Models\DetailVideo::query();
           $genre = $genre->where('genre_one' , $request->genre)->orWhere('genre_two' , $request->genre)->orWhere('genre_three' , $request->genre);
           $genres = $genre->paginate(18);
           return view('home.categories.films.genre.index' , compact('genres'));
    }

    public function searchYearFilm(Request $request)
    {
        $genre = \App\Models\DetailVideo::query();
        $genre = $genre->where('year' , $request->year);
        $genres = $genre->paginate(18);
        return view('home.categories.films.genre.index' , compact('genres'));
    }

    public function searchGenreSerial(Request $request)
    {
        $genre = \App\Models\DetailSerial::query();
        $genre = $genre->where('genre_one' , $request->genre)->orWhere('genre_two' , $request->genre)->orWhere('genre_three' , $request->genre);
        $genres = $genre->paginate(18);
        return view('home.categories.serials.genre.index' , compact('genres'));
    }

    public function searchYearSerial(Request $request)
    {
        $genre = \App\Models\DetailSerial::query();
        $genre = $genre->where('year' , $request->year);
        $genres = $genre->paginate(18);
        return view('home.categories.serials.genre.index' , compact('genres'));
    }


    public function singleCategory(Category $category , Request $request)
    {
        $category = Category::query();
        $category = $category->where('slug' , 'like' , $request->slug)->first();



        if ($category->title == "فیلم" or $category->parent == 1)
        {
            $videos = \App\Models\DetailVideo::query();
            $videos = $videos->where('genre_one' , 'like' , $category->slug)->orWhere('genre_two' , 'like' , $category->slug)->orWhere('genre_three' , 'like' , $category->slug)->get()->all();
           return view('home.categories.film' , compact('videos'));
        }
        if ($category->title == "سریال" or $category->parent == 2)
        {
            $serials = \App\Models\DetailSerial::query();
            $serials = $serials->where('genre_one' , 'like' , $category->slug)->orWhere('genre_two' , 'like' , $category->slug)->orWhere('genre_three' , 'like' , $category->slug)->get()->all();
            return view('home.categories.serial' , compact('serials'));
        }



    }

    public function single_plan(Plan $plan)
    {
        return view('home.plan.index' , compact('plan'));
    }


}
