<?php

namespace App\Http\Controllers\Admin\Update;

use App\Http\Controllers\Controller;
use App\Jobs\DetailSerial;
use App\Jobs\DetailVideo;
use App\Jobs\LinkSerial;
use App\Jobs\LinkVideo;
use App\Jobs\PSerial;
use App\Jobs\PVideo;
use App\Jobs\SaveLinkSerial;
use App\Jobs\SaveLinkVideo;
use App\Jobs\Serial;
use App\Jobs\Video;
use Illuminate\Http\Request;

class JobController extends Controller
{


    public function details_video()
    {
        PVideo::dispatch();
        DetailVideo::dispatch();
        return back();
    }


    public function details_serial()
    {
        PSerial::dispatch();
        DetailSerial::dispatch();
        LinkSerial::dispatch();
        return back();
    }




}
