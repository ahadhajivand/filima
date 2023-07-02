<?php

namespace App\Jobs;

use App\Models\SerialLink;
use DOMDocument;
use DOMXPath;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class LinkSerial implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lin = SerialLink::query();
        $lin->delete();
        $serials = \App\Models\DetailSerial::all();

        foreach ($serials as $serial)
        {
            $url = $serial->link_serial;
            $response = Http::get($url);
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML($response->body());
            libxml_use_internal_errors(false);
            $finder = new DOMXPath($doc);

            $links_box = $finder->query("//*[@class='dl-season-links']");
            foreach ($links_box as $box)
            {
                $title_session = $box->childNodes->item(1)->childNodes->item(1)->childNodes->item(3)->childNodes->item(1)->childNodes->item(0)->data;
                $title_quality =$box->childNodes->item(1)->childNodes->item(1)->childNodes->item(5)->childNodes->item(1)->childNodes->item(0)->data;
                $part = $box->childNodes->item(3)->childNodes->item(1)->childNodes;
                $count = $part->length;
                for ($i = 0 ; $i < $count ; $i++)
                {
                    if ($i%2 != 0)
                    {
                        if ($part->item($i)->childNodes->length != 0)
                        {
                            if ($part->item($i)->childNodes->item(1)->childNodes->length != 0)
                            {
                                if ($part->item($i)->childNodes->item(1)->childNodes->length < 3)
                                {
                                    $title_part = "وارد نشده";
                                }else{$title_part = $part->item($i)->childNodes->item(1)->childNodes->item(1)->childNodes->item(0)->data;}
                            }else{$title_part = "وارد نشده";}
                        }else{$title_part = "وارد نشده";}
                        if ($part->item($i)->childNodes->length != 0)
                        {
                            if ($part->item($i)->childNodes->item(3)->childNodes->length != 0)
                            {

                                if ($part->item($i)->childNodes->item(3)->childNodes->length == 3)
                                {
                                    $link_download = $part->item($i)->childNodes->item(3)->childNodes->item(1)->getAttribute('href');
                                }elseif($part->item($i)->childNodes->item(3)->childNodes->length < 3)
                                {
                                    $link_download = "وارد نشده";
                                }else
                                {$link_download = $part->item($i)->childNodes->item(3)->childNodes->item(3)->getAttribute('href');}

                            }else{$link_download = "وارد نشده";}
                        }else{$link_download = "وارد نشده";}

                        SerialLink::create([
                            'link_serial' => $url,
                            'title_session' => $title_session,
                            'title_quality' => $title_quality,
                            'title_part' => $title_part,
                            'link_download' => $link_download
                        ]);

                    }
                }
            }

        }
    }
}
