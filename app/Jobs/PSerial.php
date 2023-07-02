<?php

namespace App\Jobs;

use App\Models\PaginationSerial;
use App\Models\SingleSerial;
use DOMDocument;
use DOMXPath;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class PSerial implements ShouldQueue
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
        $single = SingleSerial::query();
        $single->delete();
        $pagination =PaginationSerial::query();
        $pagination->delete();
        $url = 'https://www.movineh.com/series';
        $response = Http::get($url);
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($response->body());
        libxml_use_internal_errors(false);
        $finder = new DOMXPath($doc);
        $nodes = $finder->query("//*[@class='page-numbers']");
        $nodes = $nodes->item(2)->childNodes;
        foreach ($nodes as $node) {
            $last_page = $node->data;
        }

        for ($i = 1; $i <= $last_page; $i++) {
            PaginationSerial::create([
                'link' => $url . '/' . 'page' . '/' . $i
            ]);
        }

        $serials = PaginationSerial::all();
        foreach ($serials as $serial) {
            $url = $serial->link;
            $response = Http::get($url);
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML($response->body());
            libxml_use_internal_errors(false);
            $finder = new DOMXPath($doc);
            $nodes = $finder->query("//*[@class='imgWrapper position-relative  mm']/a");
            if ($nodes->length != 0) {
                foreach ($nodes as $node) {

                    $link = $node->getAttribute('href');
                    if (!is_null($node->childNodes->item(1))) {
                        $image = $node->childNodes->item(1)->firstChild->attributes->item(2)->value;
                        $title = $node->childNodes->item(1)->firstChild->attributes->item(6)->value;
                    } else {
                        $image = "";
                        $title = "مشخص نشده";
                    }
                    SingleSerial::create([
                        'image' => $image,
                        'title' => $title,
                        'link' => $link
                    ]);
                }
            }
        }
    }

}
