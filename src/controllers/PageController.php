<?php

namespace Bubalubs\LaravelGravity\Controllers;

use Illuminate\Http\Request;
use Bubalubs\LaravelGravity\Page;

class PageController extends Controller
{
    public function edit($page)
    {
        $pages = Page::all();

        $page = Page::with('keys')
            ->where('name', $page)
            ->firstOrFail();

        return view('laravel-gravity::edit-page')->with(compact(
            'pages',
            'page'
        ));
    }
}
