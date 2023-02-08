<?php

//Generate a route to the package


use Illuminate\Support\Facades\Route;

Route::get("crawler", "Cornatul\Crawler\Http\Controllers\CrawlerController@index")->name("crawler.index");
Route::get("crawler/create", "Cornatul\Crawler\Http\Controllers\CrawlerController@create")->name("crawler.create");
