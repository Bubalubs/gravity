<?php

namespace Bubalubs\Gravity\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bubalubs\Gravity\Page;
use Bubalubs\Gravity\PageField;
use Bubalubs\Gravity\PageContent;

class PageFieldsController extends Controller
{
    public function edit(string $name)
    {
        $page = Page::with('fields')
            ->where('name', $name)
            ->firstOrFail();

        return view('gravity::manage-page-fields')->with(compact(
            'page'
        ));
    }

    public function create(string $name, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:60',
            'type' => 'required|in:single-line-text,multi-line-text,image,color,url'
        ]);

        $page = Page::with('fields')
            ->where('name', $name)
            ->firstOrFail();

        $data = $request->all();

        $data['name'] = Str::slug($data['name'], '-');
        $data['page_id'] = $page->id;
        $data['is_global'] = false;

        PageField::create($data);

        return redirect('/admin/pages/' . $name . '/fields')->with('success', 'Successfully created field');
    }

    public function delete(string $name, int $fieldID)
    {
        PageField::findOrFail($fieldID)->delete();

        return redirect('/admin/pages/' . $name . '/fields')->with('success', 'Successfully deleted field');
    }
}
