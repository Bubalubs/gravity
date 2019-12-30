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
