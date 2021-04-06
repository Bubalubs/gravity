<?php

namespace Bubalubs\Gravity\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bubalubs\Gravity\PageTemplate;

class PageTemplatesController extends Controller
{
    public function manage()
    {
        $pageTemplates = PageTemplate::all();

        return view('gravity::manage-page-templates')->with(compact(
            'pageTemplates'
        ));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:60',
            'view' => 'required|string'
        ]);

        PageTemplate::create($request->all());

        return redirect('/admin/page-templates')->with('success', 'Successfully created template');
    }

    public function delete(int $id)
    {
        PageTemplate::findOrFail($id)->delete();

        return redirect('/admin/page-templates')->with('success', 'Successfully deleted page template');
    }
}
