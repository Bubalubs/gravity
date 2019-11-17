<?php

namespace Bubalubs\LaravelGravity\Controllers;

use Illuminate\Http\Request;
use Bubalubs\LaravelGravity\Page;

class DashboardController extends Controller
{
    public function view()
    {
        $pages = Page::all();

        return view('laravel-gravity::dashboard')->with(compact('pages'));
    }
}
