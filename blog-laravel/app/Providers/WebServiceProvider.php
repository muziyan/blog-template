<?php

namespace App\Providers;

use App\Models\Carousel;
use App\Models\Section;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use function foo\func;


class WebServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer("web.layouts.app",function ($view){
            $sections = Section::all();

            $view->with([
                "sections" => $sections
            ]);
        });
    }
}
