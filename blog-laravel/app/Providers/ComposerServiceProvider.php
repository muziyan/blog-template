<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class ComposerServiceProvider extends ServiceProvider
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
        View::composer("*",function ($view){
            $url_path = explode("/",request()->path());
            $url_path = count($url_path) > 1 ? $url_path[1] : "/";
            $view->with("url_path",$url_path);
        });
    }
}
