<?php

namespace App\Jobs;

use App\Models\PaginationVideo;
use App\Models\SingleVideo;
use DOMDocument;
use DOMXPath;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class PVideo implements ShouldQueue
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
        $single = SingleVideo::query();
        $single->delete();
        $pagination = PaginationVideo::query();
        $pagination->delete();





        $url = 'https://www.movineh.com/';
        $response = Http::get($url);
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($response->body());
        libxml_use_internal_errors(false);
        $finder = new DOMXPath($doc);
        $nodes = $finder->query("//*[@class='page-numbers']");
        $nodes = $nodes->item(2)->childNodes;
        foreach($nodes as $node)
        {
            $last_page = $node->data;
        }
        for ($i = 1 ; $i <= $last_page ; $i++)
        {
            PaginationVideo::create([
                'link' => $url.'page'.'/'.$i
            ]);
        }



        $videos = PaginationVideo::all();
        foreach ($videos as $video)
        {
            $url = $video->link;
            $response = Http::get($url);
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML($response->body());
            libxml_use_internal_errors(false);
            $finder = new DOMXPath($doc);
            $nodes = $finder->query("//*[@class='imgWrapper position-relative  mm']/a");


            if ($nodes->length != 0)
            {
                foreach ($nodes as $node)
                {
                    $link = $node->getAttribute('href');
                    if (!is_null($node->childNodes->item(0)->attributes->item(6)))
                    {
                        $title = $node->childNodes->item(0)->attributes->item(6)->value;
                    }else{$title = "مشخص نشده";}
                    if (!is_null($node->lastChild->childNodes))
                    {
                        $images = $node->lastChild->childNodes;
                        foreach ($images as $img)
                        {
                            $image = $img->attributes->item(2)->value;
                        }
                    }else{$image = "";}
                    SingleVideo::create([
                        'image' => $image,
                        'title' => $title,
                        'link' => $link
                    ]);
                }
            }

        }
        $films = SingleVideo::query();
        $films->where('link' , 'like' , "%series%")->orWhere('link' , 'like' , "%animation%");
        $films->delete();
    }
}
