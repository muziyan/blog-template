<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get("/","Web\WebController@index")->name("index");
Route::get("/article/{article}","Web\WebController@article")->name("article");
Route::post("/search","Web\WebController@search_article")->name("search");


/* admin backstage */
Route::get("/login","Auth\LoginController@index")->name("login.index");
Route::post("/login","Auth\LoginController@login")->name("login");

Route::group(['prefix'=>"admin","middleware"=>"auth"],function (){

    Route::get("/","Admin\HomeController@index")->name("admin.home");
    Route::resource("/user","Admin\UserController");
    Route::resource("/carousel","Admin\CarouselController");
    Route::resource("/section","Admin\SectionController");
    Route::resource("/article","Admin\ArticleController");
    Route::resource("/photo","Admin\PhotosController");

    // logout
    Route::get("/logout","Auth\LoginController@logout")->name("logout");

});



