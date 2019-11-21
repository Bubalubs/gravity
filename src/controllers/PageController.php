<?php

namespace Bubalubs\LaravelGravity\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bubalubs\LaravelGravity\Page;
use Bubalubs\LaravelGravity\PageField;
use Bubalubs\LaravelGravity\PageContent;
use Bubalubs\LaravelGravity\ImageProcessor;

class PageController extends Controller
{
    public function edit($name)
    {
        $pages = Page::all();

        $page = Page::with('fields')
            ->where('name', $name)
            ->firstOrFail();

        $content = PageContent::getPageContent($name);
        
        $data = [];

        foreach ($content as $key => $value) {
            $data[$key] = $value;
        }

        return view('laravel-gravity::edit-page')->with(compact(
            'pages',
            'page',
            'data'
        ));
    }

    public function editFields($name)
    {
        $pages = Page::all();

        $page = Page::with('fields')
            ->where('name', $name)
            ->firstOrFail();

        return view('laravel-gravity::manage-page-fields')->with(compact(
            'pages',
            'page'
        ));
    }

    public function createField($name, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:60|unique:page_fields,name',
            'type' => 'required|in:single-line-text,multi-line-text,image,color'
        ]);

        $page = Page::with('fields')
            ->where('name', $name)
            ->firstOrFail();

        $data = $request->all();

        $data['name'] = Str::slug($data['name'], '-');
        $data['page_id'] = $page->id;

        PageField::create($data);

        return redirect('/admin/pages/' . $name . '/fields')->with('success', 'Successfully created field');
    }

    public function deleteField($name, $fieldID)
    {
        PageField::findOrFail($fieldID)->delete();

        return redirect('/admin/pages/' . $name . '/fields')->with('success', 'Successfully deleted field');
    }

    public function delete($id)
    {
        $page = Page::findOrFail($id);

        $page->delete();

        return redirect('/admin/pages')->with('success', 'Successfully deleted field');
    }

    public function update($name, Request $request)
    {
        $page = Page::where('name', $name)->firstOrFail();

        foreach ($request->except('_token') as $key => $content) {
            $field = PageField::where('name', $key)->firstOrFail();

            if ($field->type == 'image') {
                $file = $request->file($field->name);

                if ($file) {
                    $mimeType = $file->getMimeType();

                    if ($mimeType == 'image/jpeg') {
                        $path = $file->store('public/page-content/' . $page->name);
                        
                        $imageProcessor = new ImageProcessor(str_replace('public/', '', $path));
                        $imageProcessor->process();
                    }

                    PageContent::updateContent($page, $field, $path);
                }

            } else {
                PageContent::updateContent($page, $field, $content);
            }
        }

        return redirect('/admin/pages/' . $name);
    }
}
