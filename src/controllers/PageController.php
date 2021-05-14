<?php

namespace Bubalubs\Gravity\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bubalubs\Gravity\Page;
use Bubalubs\Gravity\PageField;
use Bubalubs\Gravity\PageContent;

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

    public function delete(int $id)
    {
        $page = Page::findOrFail($id);

        $page->delete();

        return redirect('/admin/pages')->with('success', 'Successfully deleted page');
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
                    $media = $page->addMediaFromRequest($field->name)
                        ->withResponsiveImages()
                        ->toMediaCollection($field->name);

                    PageContent::updateContent($page, $field, $media->getUrl());
                }

            } else {
                if ($field->type == 'checkbox') {
                    $content = $content ? 'true' : 'false';
                }

                PageContent::updateContent($page, $field, $content);
            }
        }

        return redirect('/admin/pages/' . $name)->with('success', 'Successfully updated page');
    }

    public function publish(string $name)
    {
        $page = Page::where('name', $name)->firstOrFail();

        $page->update([
            'published' => 1
        ]);

        return redirect('/admin/pages/' . $name)->with('success', 'Successfully published page');
    }

    public function unpublish(string $name)
    {
        $page = Page::where('name', $name)->firstOrFail();

        $page->update([
            'published' => 0
        ]);
        
        return redirect('/admin/pages/' . $name)->with('success', 'Successfully unpublished page, it is now hidden');
    }
}
