<?php

namespace Bubalubs\LaravelGravity\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
            'name' => 'required|max:60|unique:pages,name|not-in:global'
        ]);

        $data = $request->all();

        $data['name'] = Str::slug($data['name'], '-');

        Page::create($data);

        return redirect('/admin/pages')->with('success', 'Successfully created page');
    }

    public function delete(int $id)
    {
        $page = Page::findOrFail($id);

        $page->delete();

        return redirect('/admin/pages')->with('success', 'Successfully deleted page');
    }
}
