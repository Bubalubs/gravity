<?php

namespace Bubalubs\LaravelGravity;

use Illuminate\Database\Eloquent\Model;
use Bubalubs\LaravelGravity\PageKey;

class PageContent extends Model
{
    protected $table = 'page_content';

    public static function updateContent($page, $key, $content)
    {
        $key = PageKey::where('name', $key)->firstOrFail();

        $field = self::where('page', $page)
            ->where('key_id', $key->id)
            ->first();

        if ($field) {
            $field->content = $content;

            return $field->save();
        }

        $field = new self();

        $field->page = $page;
        $field->key = $key->id;
        $field->content = $content;

        return $field->save();
    }

    public static function getContent($page, $key)
    {
        $key = PageKey::where('name', $key)->firstOrFail();

        return self::where('page', $page)
            ->where('key_id', $key->id)
            ->first();
    }

    public static function getPageContent($page)
    {
        return self::where('page', $page)
            ->get()
            ->mapWithKeys(function ($field) {
                return [$field['key'] => $field['content']];
            });
    }
}
