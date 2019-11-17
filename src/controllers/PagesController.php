<?php

namespace Bubalubs\LaravelGravity\Controllers;

use Illuminate\Http\Request;
use Bubalubs\LaravelGravity\Page;

class PagesController extends Controller
{
    public function manage()
    {
        $pages = Page::all();

        return view('laravel-gravity::manage-pages')->with(compact(
            'pages'
        ));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|alpha_dash|max:60'
        ]);

        Page::create($request->all());

        return redirect('/admin/pages');
    }    
}
