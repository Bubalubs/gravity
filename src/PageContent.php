<?php

namespace Bubalubs\LaravelGravity;

use Illuminate\Database\Eloquent\Model;
use Bubalubs\LaravelGravity\PageField;
use Bubalubs\LaravelGravity\Page;

class PageContent extends Model
{
    protected $table = 'page_content';

    public function field()
    {
        return $this->belongsTo('Bubalubs\LaravelGravity\PageField', 'page_field_id');
    }

    public function page()
    {
        return $this->belongsTo('Bubalubs\LaravelGravity\Page');
    }

    public static function updateContent(Page $page, PageField $field, $content)
    {
        $pageContent = self::where('page_id', $page->id)
            ->where('page_field_id', $field->id)
            ->first();

        if ($pageContent) {
            $pageContent->content = $content;

            return $pageContent->save();
        }

        $pageContent = new self();  

        $pageContent->page_id = $page->id;
        $pageContent->page_field_id = $field->id;
        $pageContent->content = $content;

        return $pageContent->save();
    }

    public static function getContent($pageName, $field)
    {
        $field = PageField::where('name', $field)->firstOrFail();

        $page = Page::where('name', $pageName)->firstOrFail();

        return self::where('page_id', $page->id)
            ->where('page_field_id', $field->id)
            ->first();
    }

    public static function getPageContent($pageName)
    {
        $page = Page::where('name', $pageName)->first();

        if (!$page) {
            return false;
        }

        return self::where('page_id', $page->id)
            ->with('field')
            ->get()
            ->mapWithKeys(function ($pageContent) {
                return [$pageContent['field']['name'] => $pageContent['content']];
            });
    }
}
