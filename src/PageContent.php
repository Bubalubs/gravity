<?php

namespace Bubalubs\Gravity;

use Illuminate\Database\Eloquent\Model;
use Bubalubs\Gravity\PageField;
use Bubalubs\Gravity\Page;

class PageContent extends Model
{
    protected $table = 'page_content';

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($pageContent) {
            if ($pageContent->field->type == 'image') {
                if ($pageContent->page && $pageContent->name) {
                    $media = $pageContent->page->getMedia($pageContent->name);

                    if ($media[0]) {
                        $media[0]->delete();
                    }
                }
            }

            return true;
        });
    }

    public function field()
    {
        return $this->belongsTo('Bubalubs\Gravity\PageField', 'page_field_id');
    }

    public function page()
    {
        return $this->belongsTo('Bubalubs\Gravity\Page');
    }

    public static function updateContent($page, PageField $field, $content)
    {
        $pageContent = self::where('page_field_id', $field->id)->first();

        if ($pageContent) {
            if ($field->type == "image") {
                if ($page) {
                    $media = $page->getMedia($field->name);

                    if ($media[0]) {
                        $media[0]->delete();
                    }
                }
            }

            $pageContent->content = PageContent::sanitize($content);

            return $pageContent->save();
        }

        $pageContent = new self();  

        $pageContent->page_id = 0;

        if ($page) {
            $pageContent->page_id = $page->id;
        }

        $pageContent->page_field_id = $field->id;
        $pageContent->content = PageContent::sanitize($content);
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
            $pageNameParts = explode('.', $pageName);

            $page = Page::where('name', end($pageNameParts))->first();
        }

        if (!$page) {
            return false;
        }

        return self::where('page_id', $page->id)
            ->with('field')
            ->get()
            ->mapWithKeys(function ($pageContent) use ($page) {
                if ($pageContent->field->type == 'image') {
                    return [$pageContent->field->name => $page->getMedia($pageContent->field->name)[0]];
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
                    return [$pageContent->field->name => asset($pageContent->content)];
                }

                return [$pageContent->field->name => $pageContent->content];
            });
    }

    public static function sanitize(string $str = null): string
    {
        return str_replace('\'', '&apos;', $str);
    }
}
