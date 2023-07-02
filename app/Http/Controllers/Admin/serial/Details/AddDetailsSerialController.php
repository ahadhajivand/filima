<?php

namespace App\Http\Controllers\Admin\serial\Details;

use App\Http\Controllers\Controller;

use App\Models\DetailSerial;
use App\Models\Serial;
use App\Models\SerialActor;
use App\Models\SerialGenre;
use App\Models\SerialLink;
use Illuminate\Http\Request;

class AddDetailsSerialController extends Controller
{
    public function link_index(Request $request)
    {
        $serials = DetailSerial::query();
        $serial= $serials->where('id' , '=' , $request->id)->first();
        $link = $request->link_serial;
        if (is_null($link))
        {
            $link = $serial->id;
        }
        return view('Admin.serials.link.index' , compact('link' , 'serial'));
    }


    public function link_store(Request $request)
    {

            $data = $request->validate([
                'links.*.title_session' => 'required',
                'links.*.title_quality' => 'required',
                'links.*.title_part' => 'required',
                'links.*.link_download' => 'required',
                'links.*.link_serial' => 'required'
            ]);

        collect($data['links'])->each(function ($genre){
            SerialLink::create($genre);
        });
        $id = $request->id_serial;
        return redirect(route('admin.serials.show',$id));

    }


    public function actor_index(Request $request)
    {
        $serials = Serial::query();
        $serial = $serials->where('serial_id' , $request->serial_id)->first();
        $serial_id = $request->serial_id;
        $id_serial = $serial->id;
        return view('Admin.serials.actor.index' , compact('serial' , 'serial_id' , 'id_serial'));
    }


    public function actor_store(Request $request)
    {

        $data = $request->validate([
            'actors.*.title' => 'required',
            'actors.*.serial_id' => 'required'
        ]);
        collect($data['actors'])->each(function ($actor){

            SerialActor::create($actor);
        });
        $id = $request->id_serial;
        return redirect(route('admin.serials.show',$id));
    }
}
