<?php

namespace App\Http\Controllers\Admin\film;

use App\Http\Controllers\Controller;

use App\Models\DetailVideo;
use App\Models\Similar;
use App\Models\SimilarVideo;
use App\Models\Video;
use Illuminate\Http\Request;

class SimilarControoler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(DetailVideo $film)
    {

        $videos = DetailVideo::all();
        $similars = SimilarVideo::query();
        return view('Admin.films.related.create', compact('film' , 'videos' , 'similars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (isset($request->similar_id))
        {

        $data = $request->validate([
            'similarable_type' => 'required',
            'similarable_id' => 'required' ,
            'similar_id' => 'array'
        ]);
        $videos = DetailVideo::find($data['similar_id']);
        foreach ($videos as $key =>$rel)
        {

            $sims = SimilarVideo::all();
            foreach ($sims as $sim)
            {
                if ($sim->similarable_id == $request->similarable_id)
                {
                    if ($sim->similar_id == $rel->id)
                    {
                        //alert()->success('محصول مرتبط قبلا اضافه شده است','موفق آمیز')->persistent('متشکرم');
                        return back();
                    }
                }
            }
            auth()->user()->similars_video()->create([
                'similarable_type' => get_class($rel),
                'similarable_id' => $request->similarable_id ,
                'similar_id' => $rel->id
            ]);
        }
        //alert()->success('محصول مرتبط  مورد نظر با موفقیت اضافه شد','موفق آمیز')->persistent('متشکرم');
        return redirect(route('admin.films.index'));
            }
        //alert()->success('لطفا فیلد مورد نظر را تکمیل کنید','موفق آمیز')->persistent('متشکرم');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $film , Similar $similar)
    {
        $similars = Similar::query();

        $similars = $similars->where('similarable_id' , $film->id)->get()->all();
        $FILMS = Product::all();
        return view('Admin.products.related.edit' , compact('FILMS' , 'similar' , 'similars' , 'film'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {


        $similar_id = Similar::where('similarable_id' , $product->id);

        $similar_id->delete();


        $data = $request->validate([
            'similarable_type' => 'required',
            'similarable_id' => 'required' ,
            'similar_id' => 'array'
        ]);
        $products_id = Product::find($data['similar_id']);
        foreach ($products_id as $key =>$rel)
        {

            auth()->user()->similars()->create([
                'similarable_type' => get_class($rel),
                'similarable_id' => $request->similarable_id ,
                'similar_id' => $rel->id
            ]);

        }

//        alert()->success('محصول مرتبط  مورد نظر با موفقیت اضافه شد','موفق آمیز')->persistent('متشکرم');

        return redirect(route('admin.products.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
