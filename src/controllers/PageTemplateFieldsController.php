<?php

namespace Bubalubs\Gravity\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bubalubs\Gravity\PageTemplate;
use Bubalubs\Gravity\PageField;
use Bubalubs\Gravity\PageContent;

class PageTemplateFieldsController extends Controller
{
    public function edit(int $id)
    {
        $pageTemplate = PageTemplate::with('fields')
            ->where('id', $id)
            ->firstOrFail();

        return view('gravity::manage-page-template-fields')->with(compact(
            'pageTemplate'
        ));
    }

    public function create(int $id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:60',
            'type' => 'required|in:single-line-text,multi-line-text,image,color,url,checkbox'
        ]);

        $pageTemplate = PageTemplate::with('fields')
            ->where('id', $id)
            ->firstOrFail();

        $data = $request->all();
        
        $data['name'] = Str::slug($data['name'], '-');
        $data['page_id'] = 0;
        $data['page_template_id'] = $pageTemplate->id;
        $data['is_global'] = false;

        PageField::create($data);

        return redirect('/admin/page-templates/' . $pageTemplate->id . '/fields')->with('success', 'Successfully created field');
    }

    public function delete(int $id, int $fieldID)
    {
        PageField::findOrFail($fieldID)->delete();

        $pageTemplate = PageTemplate::with('fields')
            ->where('id', $id)
            ->firstOrFail();

        return redirect('/admin/page-templates/' . $pageTemplate->id . '/fields')->with('success', 'Successfully deleted field');
    }
}
