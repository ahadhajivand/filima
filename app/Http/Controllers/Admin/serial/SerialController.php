<?php

namespace App\Http\Controllers\Admin\serial;

use App\Http\Controllers\Controller;
use App\Models\ActorVideo;
use App\Models\Category;
use App\Models\DetailSerial;
use App\Models\ListLinkPaginationSerial;
use App\Models\Serial;
use App\Models\SerialActor;
use App\Models\SerialGenre;
use App\Models\Video;
use App\Models\VideoGenre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SerialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serials = DetailSerial::query();
        if ($key =\request('table'))
        {
            $serials->where('title','like',"%$key%")->orWhere('country','like',"%%$key");
        }
        $serials = $serials->latest()->paginate(10);
        return view('Admin.serials.all' , compact('serials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('Admin.serials.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required' , 'unique:Detail_serials'] ,
            'imdb' => ['required'],
            'age_category' => ['required'],
            'country' => ['required'],
            'time' => ['required'],
            'language' => ['required'],
            'genre_one' => ['required'],
            'genre_two' => ['required'],
            'genre_three' => ['required'],
            'synopsis' => ['required'],
            'year'=> ['required'] ,
            'image' => ['required'],
            'category' => ['required']
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


        $serial =  DetailSerial::create($data);
        return redirect(route('admin.serials.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $serials = DetailSerial::query();
        $serial= $serials->where('id' , '=' , $id)->first();
        return view('Admin.serials.single-serial', compact('serial' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $serials = DetailSerial::all();
        $serial = $serials->where('id' , '=' , $id)->first();
        return  view('Admin.serials.edit' , compact('serial' , 'categories'));
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
        $serials = DetailSerial::query();
        $serial = $serials->where('id' , '=' , $id)->first();
        $data = $request->validate([
            'title' => ['required' ,  Rule::unique('detail_serials')->ignore($serial->id)] ,
            'imdb' => ['required'],
            'age_category' => ['required'],
            'country' => ['required'],
            'time' => ['required'],
            'language' => ['required'],
            'genre_one' => ['required'],
            'genre_two' => ['required'],
            'genre_three' => ['required'],
            'synopsis' => ['required'],
            'year'=> ['required'] ,
            'image' => ['required'] ,

        ]);

        $data ['slug'] = $data['title'];

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


        $serial->update($data);

        return redirect(route('admin.serials.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serial = DetailSerial::all();
        $serial = $serial->where('id' ,'=' , $id)->first();
        $serial->delete();
        return back();
    }
}
