<?php

namespace Bubalubs\LaravelGravity\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bubalubs\LaravelGravity\Page;
use Bubalubs\LaravelGravity\PageField;
use Bubalubs\LaravelGravity\PageContent;
use Bubalubs\LaravelGravity\ImageProcessor;

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

        return view('laravel-gravity::edit-global-content')->with(compact(
            'globalPageFields',
            'data'
        ));
    }

    public function manageFields()
    {
        $globalContentFields = PageField::where('is_global', true)->get();

        return view('laravel-gravity::manage-global-content-fields')->with(compact(
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
                    $mimeType = $file->getMimeType();

                    if ($mimeType == 'image/jpeg') {
                        $path = $file->store('public/page-content/global');
                        
                        $path = str_replace('public', '', $path);

                        $fullServerPath = public_path('/storage' . $path);

                        $imageProcessor = new ImageProcessor($fullServerPath);
                        $imageProcessor->process();
                    }

                    PageContent::updateContent(null, $field, $path);
                }

            } else {
                PageContent::updateContent(null, $field, $content);
            }
        }

        return redirect('/admin/global')->with('success', 'Successfully updated global content');
    }
}
