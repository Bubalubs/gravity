<?php

namespace Bubalubs\LaravelGravity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Bubalubs\LaravelGravity\PageField;
use Bubalubs\LaravelGravity\Page;

class PageContent extends Model
{
    protected $table = 'page_content';

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($pageContent) {
            if ($pageContent->field->type == 'image') {
                if (Storage::disk('public')->exists($pageContent->content)) {
                    Storage::disk('public')->delete($pageContent->content);
                }
            }

            return true;
        });
    }

    public function field()
    {
        return $this->belongsTo('Bubalubs\LaravelGravity\PageField', 'page_field_id');
    }

    public function page()
    {
        return $this->belongsTo('Bubalubs\LaravelGravity\Page');
    }

    public static function updateContent($page, PageField $field, $content)
    {
        $pageContent = self::where('page_field_id', $field->id)->first();

        if ($pageContent) {
            if ($field->type == "image") {
                if (Storage::disk('public')->exists($pageContent->content)) {
                    Storage::disk('public')->delete($pageContent->content);
                }
            }

            $pageContent->content = $content;

            return $pageContent->save();
        }

        $pageContent = new self();  

        $pageContent->page_id = 0;

        if ($page) {
            $pageContent->page_id = $page->id;
        }

        $pageContent->page_field_id = $field->id;
        $pageContent->content = $content;
        $pageContent->is_global = $field->is_global;

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
                if ($pageContent->field->type == 'image') {
                    return [$pageContent->field->name => asset('/storage' . $pageContent->content)];
                }

                return [$pageContent->field->name => $pageContent->content];
            });
    }

    public static function getGlobalPageContent()
    {
        return self::where('is_global', true)
            ->with('field')
            ->get()
            ->mapWithKeys(function ($pageContent) {
                if ($pageContent->field->type == 'image') {
                    return [$pageContent->field->name => asset('/storage' . $pageContent->content)];
                }

                return [$pageContent->field->name => $pageContent->content];
            });
    }
}
