<?php

namespace Bubalubs\Gravity\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bubalubs\Gravity\Page;
use Bubalubs\Gravity\PageField;
use Bubalubs\Gravity\PageContent;
use Bubalubs\Gravity\ImageProcessor;

class GlobalContentController extends Controller
{
    public function edit()
    {
        $globalPageFields = PageField::where('is_global', true)->get();

        $content = PageContent::getGlobalPageContent();
        
        $data = [];

        foreach ($content as $key => $value) {
            $data[$key] = $value;
        }

        return view('gravity::edit-global-content')->with(compact(
            'globalPageFields',
            'data'
        ));
    }

    public function manageFields()
    {
        $globalContentFields = PageField::where('is_global', true)->get();

        return view('gravity::manage-global-content-fields')->with(compact(
            'globalContentFields'
        ));
    }

    public function createField(Request $request)
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

    public function deleteField(int $fieldID)
    {
        PageField::findOrFail($fieldID)->delete();

        return redirect('/admin/global/fields/manage')->with('success', 'Successfully deleted global content field');
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token') as $key => $content) {
            $field = PageField::where('name', $key)
                ->where('is_global', true)
                ->firstOrFail();

            if ($field->type == 'image') {
                $file = $request->file($field->name);

                if ($file) {
                    dd('Cannot add images to global fields yet');

                    $result = $page->addMediaFromRequest($field->name)
                        ->withResponsiveImages()
                        ->toMediaCollection($field->name);

                    PageContent::updateContent(null, $field, $media->getUrl());
                }

            } else {
                PageContent::updateContent(null, $field, $content);
            }
        }

        return redirect('/admin/global')->with('success', 'Successfully updated global content');
    }
}
