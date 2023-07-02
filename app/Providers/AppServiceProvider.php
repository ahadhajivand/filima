<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\DetailSerial;
use App\Models\DetailVideo;
use App\Models\Plan;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        View::share('categories' , Category::where('parent',0)->get());
        View::share('videos' , DetailVideo::where('new' , 1)->get());
        View::share('serials' , DetailSerial::where('new' , 1)->get());
        View::share('specialvideos' , DetailVideo::where('special' , 1)->get());
        View::share('specialserials' , DetailSerial::where('special' , 1)->get());
        View::share('plans' , Plan::all());
    }
}
