<?php

namespace Bubalubs\Gravity\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bubalubs\Gravity\Page;

class PagesController extends Controller
{
    public function manage()
    {
        $pages = Page::all();

        return view('gravity::manage-pages')->with(compact(
            'pages'
        ));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:60|unique:pages,name|not-in:global',
            'parent_id' => 'nullable|exists:pages,id'
        ]);

        $data = $request->all();

        $data['name'] = Str::slug($data['name'], '-');

        Page::create($data);

        return redirect('/admin/pages')->with('success', 'Successfully created page');
    }

    public function delete(string $name)
    {
        $page = Page::where('name', $name)->firstOrFail();

        $page->delete();

        return redirect('/admin/pages')->with('success', 'Successfully deleted page');
    }

    public function getAllPages()
    {
        $pages = Page::where('parent_id', null)
            ->with('children')
            ->orderBy('order')
            ->get();

        $pagesData = $pages->toArray();

        foreach ($pagesData as $key => $page) {
            $pagesData[$key]['data']['name'] = $page['name'];
            $pagesData[$key]['data']['id'] = $page['id'];

            $pagesData[$key]['children'] = $this->setPageChildrenData($pagesData[$key]);
        }

        return response()->json($pagesData);
    }

    private function setPageChildrenData($pageData)
    {
        foreach ($pageData['children'] as $childKey => $childPageData) {
            $pageData['children'][$childKey]['data']['name'] = $childPageData['name'];
            $pageData['children'][$childKey]['data']['id'] = $childPageData['id'];

            if (count($childPageData['children'])) {
                $pageData['children'][$childKey]['children'] = $this->setPageChildrenData($childPageData);
            }
        }

        return $pageData['children'];
    }

    public function updatePages(Request $request)
    {
        foreach ($request->pages as $key => $pageData) {
            $page = Page::find($pageData['data']['id']);

            $page->order = $key;
            $page->parent_id = null;

            $page->save();

            if (count($pageData['children'])) {
                $this->updatePageChildren($pageData);
            }
        }

        return response()->json([
            'success' => true
        ]);
    }

    private function updatePageChildren($pageData)
    {
        foreach ($pageData['children'] as $key => $childPageData) {
            $childPage = Page::find($childPageData['data']['id']);

            $childPage->order = $key;
            $childPage->parent_id = $pageData['data']['id'];

            $childPage->save();

            if (count($childPageData['children'])) {
                $this->updatePageChildren($childPageData);
            }
        }
    }
}
