<?php

namespace Bubalubs\Gravity\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bubalubs\Gravity\Page;
use Bubalubs\Gravity\PageField;
use Bubalubs\Gravity\PageContent;
use Bubalubs\Gravity\ImageProcessor;

class PageController extends Controller
{
    public function edit(string $name)
    {
        $page = Page::with('fields')
            ->where('name', $name)
            ->firstOrFail();

        $content = PageContent::getPageContent($name);
        
        $data = [];

        foreach ($content as $key => $value) {
            $data[$key] = $value;
        }

        return view('gravity::edit-page')->with(compact(
            'page',
            'data'
        ));
    }

    public function editFields(string $name)
    {
        $page = Page::with('fields')
            ->where('name', $name)
            ->firstOrFail();

        return view('gravity::manage-page-fields')->with(compact(
            'page'
        ));
    }

    public function createField(string $name, Request $request)
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

    public function deleteField(string $name, int $fieldID)
    {
        PageField::findOrFail($fieldID)->delete();

        return redirect('/admin/pages/' . $name . '/fields')->with('success', 'Successfully deleted field');
    }

    public function delete(int $id)
    {
        $page = Page::findOrFail($id);

        $page->delete();

        return redirect('/admin/pages')->with('success', 'Successfully deleted field');
    }

    public function update(string $name, Request $request)
    {
        $page = Page::where('name', $name)->firstOrFail();

        foreach ($request->except('_token') as $key => $content) {
            $field = PageField::where('name', $key)
                ->where('page_id', $page->id)
                ->firstOrFail();

            if ($field->type == 'image') {
                $file = $request->file($field->name);

                if ($file) {
                    $mimeType = $file->getMimeType();

                    if ($mimeType == 'image/jpeg') {
                        $path = $file->store('public/page-content/' . $page->name);
                        
                        $path = str_replace('public', '', $path);

                        $fullServerPath = public_path('/storage' . $path);

                        $imageProcessor = new ImageProcessor($fullServerPath);
                        $imageProcessor->process();
                    }

                    PageContent::updateContent($page, $field, $path);
                }

            } else {
                PageContent::updateContent($page, $field, $content);
            }
        }

        return redirect('/admin/pages/' . $name)->with('success', 'Successfully updated page');
    }
}
