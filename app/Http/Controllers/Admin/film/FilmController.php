<?php

namespace App\Http\Controllers\Admin\film;

use App\Http\Controllers\Controller;
use App\Models\ActorVideo;
use App\Models\Category;
use App\Models\DetailVideo;
use App\Models\ListLinkPaginationVideo;
use App\Models\Video;
use App\Models\VideoGenre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $film = DetailVideo::query();
        if ($key =\request('table'))
        {
            $film->where('title','like',"%$key%")->orWhere('year','like',"%%$key")->orWhere('country' , 'like' ,"%%$key");
        }
        $films = $film->latest()->paginate(10);


        return  view('Admin.films.all' ,  compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Admin.films.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , DetailVideo $video)
    {
        //        $videos = \App\Models\DetailVideo::all();
//        foreach ($videos as $video)
//        {
//            $video->categories()->sync('1');
//        }

        $data = $request->validate([
            'title' => ['required' , 'unique:detail_videos'] ,
            'image' => ['required'],
            'imdb' => ['required'],
            'country' => ['required'],
            'year' => ['required'],
            'time' => ['required'],
            'language' => ['required'],
            'synopsis' => ['required'],
            'genre_one' => ['required'],
            'genre_two' => ['required'],
            'genre_three' => ['required'],
            'link_title_one' => ['1080p'],
            'link_title_two' => ['720p'],
            'link_title_three' => ['420p'],
            'link_download_one' => ['string'],
            'link_download_two' => ['string'],
            'link_download_three' => ['string'],
            'category'=>['required']
        ]);

        $data ['slug'] = $data['title'];

        if ($request->status == "on")
        {
            $data['status'] = 1;
        }else
        {
            $data['status'] = 0;
        }
        if ($request->new == "on")
        {
            $data['new'] = 1;
        }else
        {
            $data['new'] = 0;
        }

        if ($request->special == "on")
        {
            $data['special'] = 1;
        }else
        {
            $data['special'] = 0;
        }

        $video = DetailVideo::create($data);

//        $video = auth()->user()->videos()->create($data);
        return redirect(route('admin.films.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $videos = DetailVideo::query();
        $video = $videos->where('id' , '=' , $id)->first();
        return view('Admin.films.single-film'  , compact('video'   ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $videos =DetailVideo::all();
        $categories = Category::all();
        $video = $videos->where('id' , '=' , $id)->first();
        return  view('Admin.films.edit' , compact('video' ,'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $videos = DetailVideo::query();
        $video = $videos->where('id' , '=' , $id)->first();
        $data = $request->validate([
            'title' => ['required' ,  Rule::unique('detail_videos')->ignore($video->id)] ,
            'imdb' => ['required'],
            'country' => ['required'],
            'year' => ['required'],
            'time' => ['required'],
            'language' => ['required'],
            'synopsis' => ['required'],
            'image' => ['required'],
            'genre_one' => ['required'],
            'genre_two' => ['required'],
            'genre_three' => ['required'],
            'link_title_one' => ['1080p'],
            'link_title_two' => ['720p'],
            'link_title_three' => ['420p'],
            'link_download_one' => ['string'],
            'link_download_two' => ['string'],
            'link_download_three' => ['string'],
        ]);
        if ($request->status == "on")
        {
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }


        if ($request->new == "on")
        {
            $data['new'] = 1;
        }else{
            $data['new'] = 0;
        }



        if ($request->special == "on")
        {
            $data['special'] = 1;
        }else{
            $data['special'] = 0;
        }
        $data ['slug'] = $data['title'];

        $video->update($data);


        return redirect(route('admin.films.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $video = DetailVideo::all();
        $video = $video->where('id' ,'=' , $id)->first();
        $video->delete();
        return back();
    }
}
