<?php

namespace App\Jobs;

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

class DetailVideo implements ShouldQueue
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
        $all = \App\Models\DetailVideo::query();
        $all->delete();
        $videos = SingleVideo::all();
        foreach ($videos as $video)
        {
            $url = $video->link;
            $response = Http::get($url);
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML($response->body());
            libxml_use_internal_errors(false);
            $finder = new DOMXPath($doc);
            $title = $finder->query("//*[@class='-post-title']/h1");
            $imdb = $finder->query("//*[@class='-rate-number d-flex flex-column']/strong/span");
            $genre_one = $finder->query("/html[1]/body[1]/main[1]/div[1]/div[2]/div[1]/div[1]/article[1]/div[1]/div[2]/div[2]/div[1]/div[3]/span[1]/a[1]");
            $genre_two = $finder->query("/html[1]/body[1]/main[1]/div[1]/div[2]/div[1]/div[1]/article[1]/div[1]/div[2]/div[2]/div[1]/div[3]/span[1]/a[2]");
            $genre_three = $finder->query("/html[1]/body[1]/main[1]/div[1]/div[2]/div[1]/div[1]/article[1]/div[1]/div[2]/div[2]/div[1]/div[3]/span[1]/a[3]");
            $year = $finder->query("//span[@class='pr-item']");
            $country = $finder->query("//span[@class='pr-item']");
            $synopsis = $finder->query("/html[1]/body[1]/main[1]/div[1]/div[2]/div[1]/div[1]/article[1]/div[1]/div[3]/p[1]");
            $language = $finder->query("//strong[contains(text(),'زبان')]");
            $time = $finder->query("//strong[contains(text(),'مدت زمان')]");

            $link_title_one = $finder->query("//strong[normalize-space()='1080p']");
            $link_title_two = $finder->query("//strong[normalize-space()='720p']");
            $link_title_three = $finder->query("//strong[normalize-space()='480p']");
            $link_title_one_one = $finder->query("//strong[normalize-space()='1080']");
            $link_title_two_two = $finder->query("//strong[normalize-space()='720']");
            $link_title_three_three = $finder->query("//strong[normalize-space()='480']");

            $link_downloads = $finder->query('//*[@class ="download-links"]');

            $image = $video->image;


            if ($link_downloads->length == 1)
            {
                if (!is_null($link_downloads->item(0)->lastChild->previousSibling))
                {
                    $link_download_one = $link_downloads->item(0)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_one = "مشخص نشده";}
                $link_download_two = "" ;
                $link_download_three = "";
            }
            elseif($link_downloads->length == 2)
            {
                if (!is_null($link_downloads->item(0)->lastChild->previousSibling))
                {
                    $link_download_one = $link_downloads->item(0)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_one = "مشخص نشده";}
                if (!is_null($link_downloads->item(1)->lastChild->previousSibling))
                {
                    $link_download_two = $link_downloads->item(1)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_two = "مشخص نشده";}
                $link_download_three = "";
            }elseif ($link_downloads->length == 3)
            {
                if (!is_null($link_downloads->item(0)->lastChild->previousSibling))
                {
                    $link_download_one = $link_downloads->item(0)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_one = "مشخص نشده";}
                if (!is_null($link_downloads->item(1)->lastChild->previousSibling))
                {
                    $link_download_two = $link_downloads->item(1)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_two = "مشخص نشده";}
                if (!is_null($link_downloads->item(2)->lastChild->previousSibling))
                {
                    $link_download_three = $link_downloads->item(2)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_three = "مشخص نشده";}
            }elseif($link_downloads->length == 6)
            {
                if (!is_null($link_downloads->item(0)->lastChild->previousSibling))
                {
                    $link_download_one = $link_downloads->item(0)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_one = "مشخص نشده";}
                if (!is_null($link_downloads->item(1)->lastChild->previousSibling))
                {
                    $link_download_two = $link_downloads->item(1)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_two = "مشخص نشده";}
                if (!is_null($link_downloads->item(2)->lastChild->previousSibling))
                {
                    $link_download_three = $link_downloads->item(2)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_three = "مشخص نشده";}

            }elseif($link_downloads->length == 5)
            {
                if (!is_null($link_downloads->item(0)->lastChild->previousSibling))
                {
                    $link_download_one = $link_downloads->item(0)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_one = "مشخص نشده";}
                if (!is_null($link_downloads->item(1)->lastChild->previousSibling))
                {
                    $link_download_two = $link_downloads->item(1)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_two = "مشخص نشده";}
                if (!is_null($link_downloads->item(2)->lastChild->previousSibling))
                {
                    $link_download_three = $link_downloads->item(2)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_three = "مشخص نشده";}
            }
            elseif($link_downloads->length == 4)
            {
                if (!is_null($link_downloads->item(0)->lastChild->previousSibling))
                {
                    $link_download_one = $link_downloads->item(0)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_one = "مشخص نشده";}
                if (!is_null($link_downloads->item(1)->lastChild->previousSibling))
                {
                    $link_download_two = $link_downloads->item(1)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_two = "مشخص نشده";}
                if (!is_null($link_downloads->item(2)->lastChild->previousSibling))
                {
                    $link_download_three = $link_downloads->item(2)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_three = "مشخص نشده";}
            }
            elseif($link_downloads->length == 7)
            {
                if (!is_null($link_downloads->item(0)->lastChild->previousSibling))
                {
                    $link_download_one = $link_downloads->item(0)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_one = "مشخص نشده";}
                if (!is_null($link_downloads->item(1)->lastChild->previousSibling))
                {
                    $link_download_two = $link_downloads->item(1)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_two = "مشخص نشده";}
                if (!is_null($link_downloads->item(2)->lastChild->previousSibling))
                {
                    $link_download_three = $link_downloads->item(2)->lastChild->previousSibling->getAttribute('href');
                }else{$link_download_three = "مشخص نشده";}
            }
            else
            {
                $link_download_one = "" ;
                $link_download_two = "" ;
                $link_download_three = "";
            }

            if ($link_title_one->length != 0)
            {
                $link_title_one = $link_title_one->item(0)->firstChild->data;
            } elseif ($link_title_one_one->length != 0)
                  {
                     $link_title_one = $link_title_one_one->item(0)->firstChild->data;
                  }else{$link_title_one = "";}


            if ($link_title_two->length != 0)
            {
                    $link_title_two = $link_title_two->item(0)->firstChild->data;
            } elseif ($link_title_one_one->length != 0)
                {
                    $link_title_two = $link_title_two_two->item(0)->firstChild->data;

                }else{$link_title_two = "";}


            if ($link_title_three->length != 0)
            {
                $link_title_three = $link_title_three->item(0)->firstChild->data;

            } elseif ($link_title_three_three->length != 0)
             {
                 $link_title_three = $link_title_three_three->item(0)->firstChild->data;

             }  else{$link_title_three = "";}



            if ($time->length != 0)
            {
                $time = $time->item(0)->nextSibling->data;
            }else{$time = "وارد نشده";}

            if ($language->length != 0)
            {
                $language = $language->item(0)->nextSibling->firstChild->data;
            }else{$language = "وارد نشده";}

            if ($synopsis->length != 0)
            {
                $synopsis = $synopsis->item(0)->firstChild->data;
            }else{$synopsis = "وارد نشده";}

            if ($country->length == 2 )
            {
                $country = $country->item(0)->lastChild->lastChild->data;
            }else{ $country = "مشخص نشده";}

            if ($year->length == 2 )
            {
                $year = $year->item(1)->lastChild->lastChild->data;
            }else{ $year = "مشخص نشده";}


            if ($genre_three->length != 0)
            {
                $genre_three = $genre_three->item(0)->firstChild->data;
            }else{$genre_three = "";}


            if ($genre_two->length != 0)
            {
                $genre_two = $genre_two->item(0)->firstChild->data;
            }else{$genre_two = "";}

            if ($genre_one->length != 0)
            {
                $genre_one = $genre_one->item(0)->firstChild->data;
            }else{$genre_one = "";}



            if ($imdb->length != 0)
            {
                $imdb = $imdb->item(0)->firstChild->data;
            }else {$imdb = "وارد نشده";}

            if ($title->length != 0)
            {
                $title = $title->item(0)->firstChild->data;
            }else{$title = "وارد نشده";}

            \App\Models\DetailVideo::create([
                'title' => $title,
                'link_video' => $url,
                'imdb' => $imdb,
                'time' => $time,
                'year' => $country,
                'country' => $year,
                'image' => $image,
                'language' => $language,
                'synopsis' => $synopsis,
                'genre_one' => $genre_one,
                'genre_two' => $genre_two,
                'genre_three' => $genre_three,
                'link_title_one' => $link_title_one,
                'link_title_two' => $link_title_two,
                'link_title_three' => $link_title_three,
                'link_download_one' => $link_download_one,
                'link_download_two' => $link_download_two,
                'link_download_three' => $link_download_three
            ]);

        }
                $films = \App\Models\DetailVideo::all();
        foreach ($films as $film)
        {
            $film->categories()->sync('1');
        }
    }
}
