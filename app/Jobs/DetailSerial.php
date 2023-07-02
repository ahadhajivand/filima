<?php

namespace App\Jobs;

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

class DetailSerial implements ShouldQueue
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
        $all = \App\Models\DetailSerial::query();
        $all->delete();
        $serials = SingleSerial::all();
        foreach ($serials as $serial)
        {
            $url = $serial->link ;
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
            $year = $finder->query("//span[contains(text(),'سال انتشار')]");
            $country = $finder->query("//span[contains(text(),'محصول')]");
            $synopsis = $finder->query("/html[1]/body[1]/main[1]/div[1]/div[2]/div[1]/div[1]/article[1]/div[1]/div[3]/p[1]");
            $language = $finder->query("//strong[contains(text(),'زبان')]");
            $time = $finder->query("//strong[contains(text(),'مدت زمان')]");
            $age_category = $finder->query("//strong[contains(text(),'رده سنی')]");



            if ($age_category->length != 0)
            {
                $age_category = $age_category->item(0)->nextSibling->data;
            }else {$age_category = "مشخص نشده";}


            if ($time->length != 0)
            {
                $time = $time->item(0)->nextSibling->data;
            }else{$time = "وارد نشده";}

            if ($year->length != 0 )
            {
                $year = $year->item(0)->nextSibling->lastChild->data;
            }else{ $year = "مشخص نشده";}
            if ($country->length != 0 )
            {
                $country = $country->item(0)->nextSibling->lastChild->data;
            }else{ $country = "مشخص نشده";}

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


            if ($synopsis->length != 0)
            {
                $synopsis = $synopsis->item(0)->firstChild->data;
            }else{$synopsis = "وارد نشده";}


            if ($language->length != 0)
            {
                $language = $language->item(0)->nextSibling->firstChild->data;
            }else{$language = "وارد نشده";}



            \App\Models\DetailSerial::create([
                'title' => $title,
                'link_serial' => $url,
                'imdb' => $imdb,
                'time' => $time,
                'year' => $year,
                'country' => $country,
                'image' => $serial->image,
                'language' => $language,
                'synopsis' => $synopsis,
                'genre_one' => $genre_one,
                'genre_two' => $genre_two,
                'genre_three' => $genre_three,
                'age_category' => $age_category
            ]);

        }
        $films = \App\Models\DetailSerial::all();
        foreach ($films as $film)
        {
            $film->categories()->sync('2');
        }

    }
}
