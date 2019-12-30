<?php

namespace Bubalubs\Gravity\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bubalubs\Gravity\Page;
use Bubalubs\Gravity\PageField;
use Bubalubs\Gravity\PageContent;
use Bubalubs\Gravity\ImageProcessor;

class GlobalContentFieldsController extends Controller
{
    public function manage()
    {
        $globalContentFields = PageField::where('is_global', true)->get();

        return view('gravity::manage-global-content-fields')->with(compact(
            'globalContentFields'
        ));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:60',
            'type' => 'required|in:single-line-text,multi-line-text,image,color,url'
        ]);

        $data = $request->all();

        $data['name'] = Str::slug($data['name'], '-');
        $data['page_id'] = 0;
        $data['is_global'] = true;

        PageField::create($data);

        return redirect('/admin/global/fields/manage')->with('success', 'Successfully created global content field');
    }

    public function delete(int $fieldID)
    {
        PageField::findOrFail($fieldID)->delete();

        return redirect('/admin/global/fields/manage')->with('success', 'Successfully deleted global content field');
    }
}
