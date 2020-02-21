<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get("/access","WebInfoController@create");
Route::post("/upload","WebInfoController@upload")->name("upload");
Route::get("/update_hit/{id}","Web\WebController@update_hit")->name("update_hit");
