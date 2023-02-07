<?php

namespace Cornatul\Crawler\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class CrawlerController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    final public function index(): Application|Factory|\Illuminate\Contracts\View\View
    {
        return view('crawler::index');
    }
}
